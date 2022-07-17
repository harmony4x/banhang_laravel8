<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistical extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'statistical';
    protected $fillable = [
        'order_date', 'sales', 'profit', 'quantity','total_order'
    ];
}
