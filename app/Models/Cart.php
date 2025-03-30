<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'carts';

    // Primary key (if different from the default 'id')
    protected $primaryKey = 'cart_id';
    
    public $timestamps = false;

    // The attributes that are mass assignable
    protected $fillable = [
        'user_id'
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'cart_id');
    }

    // Optionally, you can define any methods to fetch or manipulate the data
    public static function getAllCarts()
    {
        return self::all();  // Get all carts
    }

    public static function getCartsById($cart_id)
    {
        return self::find($cart_id);  // Find a cart by its ID
    }
}
