<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $fillable = [
        'shipping_id', 'order_status', 'order_code','order_date'
    ];

    public function shipping() {
        return $this->hasOne(Shipping::class);
    }

    public function payment() {
        return $this->hasOne(Payment::class);
    }
}
