<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'scientific_name',
        'state',
        'type',
        'color',
        'unit',
        'price',
        'in_stock'
    ];
}
