<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected  $table = 'roles';
    protected $fillable = [
        'id', 'name','created_at','updated_at','permissions'
    ];


    protected $hidden = [
        'created_at','updated_at'
    ];

    public $timestamps = false;
    public function users()
    {
        return $this->hasMany(User::class, 'rolle_id','id');
    }
    public function route()
    {
        return $this->belongsToMany(Route::class, 'role_route','route_id','role_id');
    }

    public function getPermissionsAttribute($permissions)
    {
        return json_decode($permissions, true);
    }
}
