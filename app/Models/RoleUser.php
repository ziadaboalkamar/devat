<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;
    protected  $table = 'role_users';
    protected $fillable = [
        'id', 'role_id','user_id','created_at','updated_at'
    ];


    protected $hidden = [
        'created_at','updated_at'
    ];

    public $timestamps = true;
}
