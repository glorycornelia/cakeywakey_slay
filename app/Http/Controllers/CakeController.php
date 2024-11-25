<?php

namespace App\Http\Controllers;
use App\Models\Cake;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Level;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CakeController extends Controller
{
    public function index()
    {
        $cakes = Cake::whereBetween('cake_id', [1, 10])->get(); // Retrieve cakes from database

        return view('home', compact('cakes')); // Pass cakes to view
    }

    // Add cake to the user's cart
    public function addToCart(Request $request)
    {
        // Validate the input cake_id and level_id
        $request->validate([
            'cake_id' => 'required|exists:cakes,cake_id', // Ensure the cake exists
            'level_id' => 'nullable|exists:levels,level_id', // Ensure the level exists, optional (defaults to level 1)
        ]);

        // Find the selected cake and level
        $cake = Cake::findOrFail($request->cake_id);
        $level = Level::find($request->level_id) ?? Level::find(1); // Use default level_id 1 if not provided

        // Calculate the total price (cake base price + level price)
        $totalPrice = $cake->base_price + $level->price;

        // Check if the user has an existing cart or create a new one
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),  // Use the logged-in user's ID
        ]);

        // Add the selected cake to the cart with the calculated total_price
        CartItem::create([
            'cart_id' => $cart->cart_id,
            'cake_id' => $cake->cake_id,
            'level_id' => $level->level_id, 
            'total_price' => $totalPrice,  
        ]);

        // Redirect back to the home page with a success message
        return redirect()->route('home')->with('success', 'Cake added to your cart!');
    }
}
