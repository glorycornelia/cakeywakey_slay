<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Table name (optional if it's the plural form of the model)
    protected $table = 'payments';

    // Primary key
    protected $primaryKey = 'payment_id';

    // Timestamps
    public $timestamps = false;

    // Fillable fields for mass assignment
    protected $fillable = [
        'order_id',
        'amount',
        'payment_date',
        'payment_method',
        'status',
        'user_id', // Include user_id in fillable fields
    ];

    // Define a relationship to other tables
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}