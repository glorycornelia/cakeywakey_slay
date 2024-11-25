<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'cart_items';

    // Primary key (if different from the default 'id')
    protected $primaryKey = 'cart_item_id';

    public $timestamps = false;

    // The attributes that are mass assignable
    protected $fillable = [
        'cart_id',
        'cake_id',
        'level_id',
        'total_price'
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'cart_id');
    }

    public function cake()
    {
        return $this->belongsTo(Cake::class, 'cake_id', 'cake_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id', 'level_id');
    }
}
