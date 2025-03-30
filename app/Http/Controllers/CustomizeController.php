<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cake;
use App\Models\Level;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CustomizeController extends Controller
{
    public function index()
    {
        // Fetch only specific cakes and all levels
        $cakes = Cake::whereBetween('cake_id', [11, 15])->get();
        $levels = Level::all();

        // Pass data to the view
        return view('order', compact('cakes', 'levels'));
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'cake_id' => 'required|exists:cakes,cake_id',
            'level_id' => 'required|exists:levels,level_id',
        ]);

        // Get the authenticated user's ID
        $userId = Auth::id(); // This is how you get the user's ID

        // Find the selected cake and level
        $cake = Cake::findOrFail($request->cake_id);
        $level = Level::findOrFail($request->level_id);

        // Calculate the total price (cake base price + level price)
        $totalPrice = $cake->base_price + $level->price;

        // Check if user has a cart, create if not
        $cart = Cart::firstOrCreate([
            'user_id' => $userId,
        ]);

        // Add item to cart with calculated total price
        CartItem::create([
            'cart_id' => $cart->cart_id,
            'cake_id' => $request->cake_id,
            'level_id' => $request->level_id,
            'total_price' => $totalPrice, // Store the calculated total price
        ]);

        // Redirect back with success message
        return redirect()->route('order')->with('success', 'Item added to cart successfully!');
    }
}
