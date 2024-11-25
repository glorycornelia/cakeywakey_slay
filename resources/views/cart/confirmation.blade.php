@extends('template')

@section('content')

<div class="container mt-5">
    <div class="alert alert-success">
        <h4>Order Confirmation</h4>
        <p>Thank you for your purchase! Your order has been placed successfully.</p>
    </div>
    <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
</div>

@endsection
