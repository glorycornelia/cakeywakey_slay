<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;  // Import User model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Show the registration form
    public function showRegisterForm()
    {
        return view('register'); // Make sure this view exists
    }

    // Handle registration
    public function register(Request $request)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => [
                'required',
                'regex:/^\d{10,13}$/',
            ],
            'email' => 'required|string|email|max:255|unique:users,email', 
            'password' => 'required|string|min:8',
        ]);
    
        // Create the new user
        $user = User::create([
            'name' => $request->name,
            'phone' =>$request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
        ]);
    
        $user->is_admin = false; // Default to non-admin user
        $user->save();

        // Log the user in after successful registration
        Auth::login($user);
    
        // Redirect the user to the intended page (or home)
        return redirect()->intended('home');
    }
}
