<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $fillable = [
        'comment', 'user_name', 'product_id','parent_comment',
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
