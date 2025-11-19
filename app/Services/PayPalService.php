<?php
// app/Services/PayPalService.php
// app/Services/PayPalService.php

namespace App\Services;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use Illuminate\Support\Facades\Log;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;

class PayPalService
{
    private $client;

    public function __construct()
    {
        $paypalConfig = config('services.paypal');

        $environment = new SandboxEnvironment($paypalConfig['client_id'], $paypalConfig['secret']);
        $this->client = new PayPalHttpClient($environment);
    }

    public function createPayment($total, $currency)
    {
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "amount" => [
                    "currency_code" => $currency,
                    "value" => $total
                ]
            ]],
            "application_context" => [
                "cancel_url" => route('paypal.cancel'),
                "return_url" => route('paypal.payment_success')
            ]
        ];

        try {
            $response = $this->client->execute($request);
            Log::info('PayPal payment created successfully', ['response' => $response]);
            return $response;
        } catch (\Exception $ex) {
            Log::error('PayPal payment creation failed', ['error' => $ex->getMessage()]);
            return redirect()->route('paypal.error');
        }
    }

    public function capturePayment($orderId)
    {
        $request = new OrdersCaptureRequest($orderId);
        $request->prefer('return=representation');

        try {
            $response = $this->client->execute($request);
            Log::info('PayPal payment captured successfully', ['response' => $response]);
            return $response;
        } catch (\Exception $ex) {
            Log::error('PayPal payment capture failed', ['error' => $ex->getMessage()]);
            return null;
        }
    }

    public function getPaymentStatus($orderId)
    {
        $request = new OrdersGetRequest($orderId);

        try {
            $response = $this->client->execute($request);
            Log::info('PayPal payment status retrieved successfully', ['response' => $response]);
            return $response->result;
        } catch (\Exception $ex) {
            Log::error('PayPal payment status retrieval failed', ['error' => $ex->getMessage()]);
            return null;
        }
    }
}
