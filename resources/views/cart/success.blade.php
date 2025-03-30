@extends('template')

@section('content')
<div class="container mt-5">
    <h2>Payment Successful</h2>
    <p>Thank you for your payment! Your order is being processed.</p>
    <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
</div>
@endsection
