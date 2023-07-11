<?php

namespace App\Http\Controllers;

use App\Services\SenangpayService;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{


    protected $senangpayService;

    public function __construct(SenangpayService $senangpayService)
    {
        $this->senangpayService = $senangpayService;
    }

    public function checkout(Request $request)
    {
        $orderId  = '168881797626';
        $returnUrl = url('callback'); // Replace with the actual return URL in your application

        $recurringId = '168882336849';
        return redirect()->away("https://sandbox.senangpay.my/payment/recurring/$recurringId");
        $hash = hash('sha256', env('SENANGPAY_SECRET_KEY') . $recurringId . $orderId);
        $orderDetails = [
            'order_id' => $orderId,
            'recurring_id' => $recurringId,
            'hash' => $hash,
            'name' => 'Customer Name', // Optional
            'email' => 'customer@example.com', // Optional
            'phone' => '1234567890', // Optional
        ];
        $data = [
            'name' => 'Recurring Product',
            'price' => '10.00',
            'code' => 'RECURRING_PROD',
            'description' => 'Recurring product description',
            'sst' => 6,
            'display_address' => 1,
            'recurring_type' => 'SUBSCRIPTION',
            'frequency' => 1, // Monthly
            'billing_day' => 0, // First date as billing day
            'hash' => hash('sha256', 'YOUR_SECRET_KEY' . 'Recurring Product' . '10.00' . 'RECURRING_PROD'),
            'customer_overwrite_price' => 1,
            'customer_set_date' => 1,
            'start_payment' => 1,
            'return_url' => $returnUrl
        ];
        // return $response = $this->senangpayService->senangPay('post', 'https://api.senangpay.my/recurring/product/create', $data);
        return $response = $this->senangpayService->senangPay('post', 'https://api.sandbox.senangpay.my/recurring/payment/' . env('SENANGPAY_MERCHANT_ID'), $orderDetails);

        // Redirect the user to Senangpay payment page
        // return redirect($response);
    }
    public function callback(Request $request)
    {
        // Handle the Senangpay callback response
        // You can access the payment status and other details from the $request object
        // return $request;
        User::create(['name' => json_encode($request), 'email' => 'ali'.rand(12,2314).'@gmail.com', 'password' => 123123]);
        if ($request->status == 'SUCCESS') {
            // Payment is successful, update your database or perform any other necessary actions
            return 123;
        } else {
            // Payment is unsuccessful or canceled

            return 'eeror';
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
