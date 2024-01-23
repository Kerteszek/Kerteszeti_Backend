<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliance extends Model
{
    use HasFactory;
    protected $fillable = [
        'product',
        'suppliance_date',
        'number_of_items',
        'purchase_price'
    ];
}
