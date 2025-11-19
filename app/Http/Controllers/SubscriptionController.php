<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Subscriptions List';

        if ($request->ajax()) {
            $data = Subscription::query();

            return DataTables::of($data)
                ->addColumn('details', function ($row) {
                    // Decode JSON-encoded details field
                    $details = json_decode($row->details, true);

                    // If details is decoded successfully and it's an array, implode it
                    if (is_array($details)) {
                        return implode(", ", $details);
                    } else {
                        return '-';
                    }
                })
                ->addColumn('action', function ($row) {
                    $buttons = '<div class="d-flex align-items-center list-action">';
                    $buttons .= '<a href="' . route('subscription.show', ['subscription' => $row->id]) . '" class="badge bg-info mr-2" data-toggle="tooltip" data-placement="top" title="View"><i class="ri-eye-line mr-0"></i></a>';
                    $buttons .= '<a href="' . route('subscription.edit', ['subscription' => $row->id]) . '" class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="ri-pencil-line mr-0"></i></a>';
                    $buttons .= '<button class="badge badge-warning mr-2 delete-user border-0" data-id="' . $row->id . '" data-model="subscription" data-toggle="modal" data-target="#deleteSubscriptionModal"><i class="ri-delete-bin-line mr-0"></i></button>';
                    $buttons .= '</div>';
                    return $buttons;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('subscriptions.index', compact('title'));
    }

    public function create()
    {
        $title = "Create Subscription";
        return view('subscriptions.create', compact('title'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'price' => 'required|numeric',
    //         'details' => 'nullable',
    //         'duration' => 'required',
    //     ]);

    //     $data = $request->all();


    //     if ($request->has('details')) {
    //         $details = $request->details;
    //         $data['details'] = json_encode($details);
    //     }

    //     Subscription::create($data);

    //     return redirect()->route('subscription.index')->with('success', 'Subscription created successfully.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'details' => 'nullable',
            'duration' => 'required',
        ]);

        $data = $request->all();

        // if ($request->has('details')) {
        //     $details = $request->details;
        //     $data['details'] = json_encode($details);
        // }

        $subscription = Subscription::create($data);

        // Return JSON instead of redirect
        return response()->json([
            'status' => 'success',
            'message' => 'Subscription created successfully.',
            'subscription' => $subscription
        ]);
    }


    public function show(Request $request, Subscription $subscription)
    {
        // If request expects JSON (from frontend), return JSON
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'subscription' => $subscription
            ]);
        }

        // Otherwise return Blade view (for web admin panel)
        $title = "Subscription Details";
        return view('subscriptions.show', compact('subscription', 'title'));
    }

    public function edit(Subscription $subscription)
    {
        $title = "Edit Subscription";
        return view('subscriptions.edit', compact('subscription', 'title'));
    }
//   Update the specified resource in storage.
    public function update(Request $request, Subscription $subscription)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'details' => 'nullable',
            'duration' => 'required',
        ]);

        $data = $request->all();

        // if ($request->has('details')) {
        //     $details = $request->details;
        //     $data['details'] = json_encode($details);
        // }

        $subscription->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Subscriptions updated successfully'
        ]);
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return response()->json([
            'status' => 'success', 
            'message' => 'Subscription deleted successfully.'
        ]);
    }

    // API method to get all subscriptions
    public function getAllSubscriptions()
    {
        $subscriptions = Subscription::all();
        
        return response()->json([
            'status' => 'success',
            'subscriptions' => $subscriptions,
            'message' => 'Subscriptions fetched successfully'
        ]);
    }

    public function loginAndRedirect($encodedUserId)
    {
        // Decode the user_id
        $user_id = base64_decode($encodedUserId);

        // Find the user by ID
        $user = User::findOrFail($user_id);

        // Log in the user
        Auth::login($user);
        $subscriptions = Subscription::all();
        // Redirect to the desired page
        return view('subscription_show', ['user_id' => $user_id, 'subscriptions' => $subscriptions]);
    }

    public function cancel()
    {
        return 'Payment cancelled.';
    }

    public function error()
    {
        return view('payment_error');
    }
}
