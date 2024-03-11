<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';
    protected $fillable = [
        'scientific_name',
        'status',
        'type',
        'color',
        'unit',
        'price',
        'in_stock',
        'reserved',
        'priority'
    ];
}
