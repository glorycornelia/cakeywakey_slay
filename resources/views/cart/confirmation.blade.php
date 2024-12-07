@extends('template')

@section('content')

<div class="container mt-5">
    <div class="alert alert-success">
        <h4>Order Confirmation</h4>
        <p>Thank you for your purchase! Your order has been placed successfully.</p>

        <!-- Order Details -->
        <div class="order-details mt-3">
            <h5>Order Details:</h5>
            <ul>
                <li><strong>Order ID:</strong> {{ $order->order_id }}</li>
                <li><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</li>
                <li><strong>Status:</strong> {{ ucfirst($order->status) }}</li>
            </ul>
        </div>

        <!-- Payment Button -->
        @if($order->status === 'pending')
            <div class="mt-3">
                <a href="{{ route('payment.pay', $order->order_id) }}" class="btn btn-success">
                    Proceed to Pay with Midtrans
                </a>
            </div>
        @endif
    </div>

    <!-- Back to Home -->
    <a href="{{ route('home') }}" class="btn btn-primary mt-3">Back to Home</a>
</div>

@endsection