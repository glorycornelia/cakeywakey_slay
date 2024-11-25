@extends('template')

@section('content')

<!-- Cart Page Section -->
<div class="cart-page container">
    <h2>Your Cart</h2>

    <!-- Display Cart Items -->
    <form action="{{ route('cart.process') }}" method="POST" id="cartForm">
        @csrf
        <div class="cart-items">
            @foreach($cartItems as $cartItem)
                @php
                    $itemPrice = $cartItem->cake->base_price + $cartItem->level->price;
                @endphp
                <div class="card cart-item">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <h5 class="card-title">{{ $cartItem->cake->name }}</h5>
                                <p>{{ $cartItem->level->name }} - ${{ number_format($itemPrice, 2) }}</p>
                            </div>
                            <div class="col-4 text-end">
                                <!-- Remove Button -->
                                <a href="{{ route('cart.remove', $cartItem->cart_item_id) }}" class="btn btn-danger">Remove</a>
                            </div>
                        </div>
                        <div class="form-check">
                            <!-- Checkbox for selecting items to checkout -->
                            <input class="form-check-input" type="checkbox" name="cart_items[]" value="{{ $cartItem->cart_item_id }}" data-price="{{ $itemPrice }}" onchange="updateTotalPrice()">
                            <label class="form-check-label">Select for checkout</label>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Total Price Display -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <h5>Total Price: $<span id="totalPrice">0.00</span></h5>
            <button type="submit" class="btn btn-success">Proceed to Payment</button>
        </div>
    </form>
</div>

<script>
    function updateTotalPrice() {
        let totalPrice = 0;
        document.querySelectorAll('.form-check-input:checked').forEach(checkbox => {
            totalPrice += parseFloat(checkbox.getAttribute('data-price'));
        });
        document.getElementById('totalPrice').textContent = totalPrice.toFixed(2);
    }

    // Trigger initial calculation on page load (if some items are preselected)
    document.addEventListener('DOMContentLoaded', updateTotalPrice);
</script>

@endsection