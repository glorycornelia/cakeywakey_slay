<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Import User model

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('login'); 
    }

    // Handle the login attempt
    public function login(Request $request)
    {
        // Validate the input data
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8', // Password validation
        ]);

        // Attempt to log in with the given credentials
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Check if the user is an admin
            $user = Auth::user();
            if ($user->is_admin == 1) {
                return redirect()->intended('admin'); // Redirect to admin page
            }
            return redirect()->intended('home'); // Redirect to user home page
        } else {
            // Redirect back with an error message if credentials are invalid
            return redirect()->back()->withErrors(['login' => 'Invalid credentials']);
        }
    }

    // Logout method
    public function logout(Request $request)
    {
        Auth::logout(); // Log out the user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token for security
        return redirect('/home');
    }
}