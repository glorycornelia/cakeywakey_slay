<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Table associated with the model
    protected $table = 'orders';

    // Primary key
    protected $primaryKey = 'order_id';

    // Timestamps
    public $timestamps = false;

    // Fillable attributes
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }
}