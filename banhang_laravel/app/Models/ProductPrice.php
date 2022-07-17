<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'product_price';
    protected $fillable = [
        'product_id', 'cost', 'price', 'order_date',
    ];
}
