<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Display the user's cart
    public function index()
    {
        $userId = Auth::id();
        $cartItems = CartItem::whereHas('cart', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();
        
        return view('cart', compact('cartItems'));
    }

    // Remove a cart item
    public function remove($cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);
        $cartItem->delete();

        return redirect()->route('cart')->with('success', 'Item removed from cart.');
    }

    public function confirmation()
    {
        return view('cart.confirmation');
    }

    // Process cart items and move selected items to order_items
    public function process(Request $request)
    {
        $request->validate([
            'cart_items' => 'required|array',
            'cart_items.*' => 'exists:cart_items,cart_item_id'
        ]);

        $userId = Auth::id();
        $cartItems = CartItem::whereIn('cart_item_id', $request->cart_items)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'No items selected for checkout.');
        }

        // Calculate total price for selected items
        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->cake->base_price + $cartItem->level->price;
        });

        // Create order
        $order = Order::create([
            'user_id' => $userId,
            'total_price' => $totalPrice,
        ]);

        // Transfer selected cart items to order_items
        $cartItems->each(function ($cartItem) use ($order) {
            OrderItem::create([
                'order_id' => $order->order_id,
                'cake_id' => $cartItem->cake_id,
                'level_id' => $cartItem->level_id,
                'total_price' => $cartItem->total_price,
            ]);
            $cartItem->delete(); // Remove the cart item after processing
        });

        return redirect()->route('cart.confirmation')->with('success', 'Order placed successfully.');
    }
}