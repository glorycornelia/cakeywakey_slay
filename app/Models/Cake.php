<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cake extends Model
{
    use HasFactory;

    protected $primaryKey = 'cake_id';

    protected $fillable = [
        'name',
        'description',
        'base_price',
    ];
}
