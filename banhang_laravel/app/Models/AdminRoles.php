<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRoles extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'admin_id','roles_id',
    ];
    protected $table = 'admin_roles';
    public function roles(){
        return $this->belongsToMany(Roles::class);
    }
    public function admin(){
        return $this->belongsToMany(Admin::class);
    }
}
