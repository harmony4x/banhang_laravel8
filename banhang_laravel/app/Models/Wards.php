<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    use HasFactory;
    protected $table = 'devvn_xaphuongthitran';
    protected $fillable = [
        'xaid', 'name', 'type', 'maqh',
    ];
    protected $primaryKey = 'xaid';

    public function province() {
        return $this->belongsTo(Province::class,'maqh');
    }
}
