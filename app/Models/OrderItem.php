<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    // Table associated with the model
    protected $table = 'order_items';

    // Primary key
    protected $primaryKey = 'order_item_id';

    // Timestamps
    public $timestamps = false;

    // Fillable attributes
    protected $fillable = [
        'order_id',
        'cake_id',
        'level_id',
        'total_price',
    ];

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
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