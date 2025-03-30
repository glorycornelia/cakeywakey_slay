<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function pay(Order $order)
    {
        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Prepare transaction details
        $params = [
            'transaction_details' => [
                'order_id' => $order->order_id . '-' . time(),
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'email' => auth()->user()->email,
                'first_name' => auth()->user()->name,
                'phone' => auth()->user()->phone,
            ],
        ];

        // Create a payment record
        Payment::create([
            'order_id' => $order->order_id,
            'amount' => $order->total_price,
            'status' => 'pending',
            'user_id' => auth()->id()
        ]);
        try{
            // Generate the Snap token and retrieve QR code URL
            $snapToken = Snap::getSnapToken($params);

            return view('cart.payment', compact('snapToken', 'order'));
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function callback(Request $request)
    {
        // Retrieve callback data from Midtrans
        $data = $request->all();

        // Extract order ID from the callback
        $orderId = explode('-', $data['order_id'])[0];  // Remove timestamp
        $order = Order::where('order_id', $orderId)->firstOrFail();

        // Retrieve the related payment record
        $payment = Payment::where('order_id', $order->order_id)->firstOrFail();

        // Update payment and order statuses based on transaction status
        if ($data['transaction_status'] === 'settlement') {
            $payment->update([
                'payment_date' => now(),
                'payment_method' => $data['payment_type'],
                'status' => 'done',
            ]);

            $order->update([
                'status' => 'done',
            ]);

            // Redirect to the home page
            return redirect('/home')->with('success', 'Payment successful! Your order has been processed.');
        } elseif ($data['transaction_status'] === 'pending') {
            $payment->update(['status' => 'pending']);
            return redirect('/home')->with('info', 'Payment is pending. Please check your payment status later.');
        } elseif (in_array($data['transaction_status'], ['deny', 'cancel', 'expire'])) {
            $payment->update(['status' => 'failed']);
            return redirect('/home')->with('error', 'Payment failed or was canceled.');
        } else {
            return redirect('/home')->with('error', 'Unknown transaction status.');
        }
    }
}
