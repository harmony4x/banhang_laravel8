<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'admin_email', 'admin_password', 'admin_name','admin_phone',
    ];
    protected $table = 'admin';

    public function role(){
        return $this->belongsToMany(Roles::class, 'admin_roles');


    }


    public function getAuthPassword(){
        return $this->admin_password;
    }
}
