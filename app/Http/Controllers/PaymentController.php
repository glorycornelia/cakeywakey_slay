<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function confirmation()
    {
        return view('order.confirmation');
    }
}
