<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;  // Import User model

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('login'); // This is the login view you shared
    }

    // Handle the login attempt
    public function login(Request $request)
    {
        // Validate the input data
        $request->validate([
            'email' => 'required|email|exists:users,email', // Ensure the email exists in the database
            'password' => 'required|string|min:8', // Password validation
        ]);
    
        // Attempt to log in with the given credentials
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            // Redirect to the intended page or home
            return redirect()->intended('home');
        } else {
            // Redirect back with an error message if credentials are invalid
            return redirect()->back()->withErrors(['login' => 'Invalid credentials']);
        }
    }

    // Optionally, add a logout method
    public function logout(Request $request)
    {
        Auth::logout(); // Log out the user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token for security
        return redirect('/login'); // Redirect back to the login page
    }
}