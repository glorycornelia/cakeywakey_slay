<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'levels';

    // Primary key (if different from the default 'id')
    protected $primaryKey = 'level_id';

    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'price',
        'description',
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'level_id', 'level_id');
    }

    // methods to fetch or manipulate the data
    public static function getAllLevels()
    {
        return self::all();  // Get all level
    }

    public static function getLevelById($level_id)
    {
        return self::find($level_id);  // Find a level by its ID
    }
}
