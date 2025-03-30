<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cake extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'cakes';

    // Primary key (if different from the default 'id')
    protected $primaryKey = 'cake_id';

    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'description',
        'base_price',
        'image',
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'cake_id', 'cake_id');
    }

    public static function getAllCakes()
    {
        return self::all();  // Get all cakes
    }

    public static function getCakeById($id)
    {
        if (is_array($cake_id)) {
            return self::whereIn('cake_id', $cake_id)->get(); // Retrieve cakes with matching IDs
        }
        return self::find($cake_id); // Retrieve a single cake by ID
    }
}
