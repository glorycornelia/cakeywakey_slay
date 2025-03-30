@extends('template')

@section('content')

<div class="container mt-5">
    <h2>Complete Your Payment</h2>

    <p>Please click the button below to proceed with the payment via Midtrans:</p>

    <button id="pay-button" class="btn btn-success">Pay Now</button>

    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            snap.pay("{{ $snapToken }}", {
                onSuccess: function (result) {
                    console.log(result);
                    // Redirect or update payment status
                    window.location.href = '{{ route("cart.success") }}';
                },
                onPending: function (result) {
                    console.log(result);
                },
                onError: function (result) {
                    console.log(result);
                }
            });
        };
    </script>
</div>

@endsection