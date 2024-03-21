<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketItem extends Model
{
    use HasFactory;

    public $incrementing = false; // Add this line

    protected $primaryKey = ['product', 'basket'];


    protected $fillable = [
        'basket',
        'product',
        'amount'
    ];
}
