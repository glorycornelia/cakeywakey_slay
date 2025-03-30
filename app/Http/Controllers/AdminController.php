<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cake;
use App\Models\Order;
use App\Models\Payment;

class AdminController extends Controller
{
    public function index()
    {
        $cakes = Cake::all(); // Retrieve all cakes
        $orders = Order::all(); // Retrieve all orders
        $payments = Payment::all(); // Retrieve all payments

        // Return the admin view with the data
        return view('admin', compact('cakes', 'orders', 'payments'));
    }
}

