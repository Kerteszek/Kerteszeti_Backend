<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
  use HasFactory;

  //protected $primaryKey = ['purchase_number', 'product_id'];
  protected $primaryKey = 'purchase_number,product_id';
  public $incrementing = false;
  protected $fillable = [
    'purchase_number',
    'product_id',
    'quantity'
  ];

  public function getKey()
  {
    return [$this->getAttribute('purchase_number'), $this->getAttribute('product_id')];
  }
}
