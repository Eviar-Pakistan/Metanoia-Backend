<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\PayPalService;
use App\Models\Transaction;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PayPalController extends Controller
{
    protected $paypalService;

    public function __construct(PayPalService $paypalService)
    {
        $this->paypalService = $paypalService;
    }

    public function pay(Request $request)
    {
        $id = $request->input('id');
        if ($id) {
            $plan = Subscription::find($id);
            if ($plan) {
                $user = Auth::user();
                $user->subscription_id = $plan->id;
                $user->save();
            }
        }
        $subscription_id = Auth::user()->subscription_id;
        $plan = Subscription::find($subscription_id);
        $response = $this->paypalService->createPayment($plan->price, 'USD');

        if ($response) {

            $approvalUrl = null;
            foreach ($response->result->links as $link) {
                if ($link->rel == 'approve') {
                    $approvalUrl = $link->href;
                    break;
                }
            }
            if ($approvalUrl) {
                return redirect($approvalUrl);
            }
        }
        return redirect()->route('paypal.error')->with('message', 'Error creating PayPal payment.');
    }



    public function payment_success(Request $request)
    {
        $orderId = $request->query('token');

        if (!$orderId) {
            \Log::info('orderId not found : ' . $orderId);
            return redirect()->route('paypal.error')->with('message', 'Order ID not found.');
        }

        // Capture the payment
        $response = $this->paypalService->capturePayment($orderId);

        if (!$response) {
            \Log::info('reponse issue : ' . $response);
            return response()->json(['error' => 'Payment capture failed.'], 500);
        }

        $status = $response->result->status;

        if ($status === 'COMPLETED') {
            $transactionData = [
                'payment_id' => $response->result->id,
                'payer_id' => $response->result->payer->payer_id,
                'amount' => $response->result->purchase_units[0]->payments->captures[0]->amount->value,
                'currency' => $response->result->purchase_units[0]->payments->captures[0]->amount->currency_code,
                'payment_status' => $response->result->status,
                'user_id' => session('user_id'),
            ];

            Transaction::create($transactionData);
            $user = Auth::user();
            $subscription = Subscription::find($user->subscription_id);

            if ($subscription) {
                // Get the number of subscription days
                $days = $subscription->duration;

                // Add the subscription days to the current date
                $endDate = Carbon::now()->addDays($days);

                // Format the date in d-m-Y format
                $formattedEndDate = $endDate->format('Y-m-d');

                $user->subscription_date = $formattedEndDate;
                $user->save();
            }
            return view('payment_success');
        }

        \Log::error('PayPal payment capture incomplete', ['status' => $status]);
        return response()->json(['error' => 'Payment failed.'], 500);
    }
}
