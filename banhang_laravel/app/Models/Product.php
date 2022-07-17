<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'name', 'slug', 'quantity', 'category_id', 'brand_id',  'content', 'price', 'image', 'view', 'status','discount','quantity_sold'
    ];

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function order_detail(){
        return $this->hasMany(OrderDetail::class);
    }

    public function gallery(){
        return $this->hasMany(Gallery::class);
    }
    public function comment(){
        return $this->belongsTo(Comment::class);
    }
    public function product_price(){
        return $this->belongsTo(ProductPrice::class);
    }

}
