<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected  $table = 'roles';
    protected $fillable = [
        'id', 'role_name','created_at','updated_at'
    ];


    protected $hidden = [
        'created_at','updated_at'
    ];

    public $timestamps = true;
    public function users()
    {
        return $this->hasMany(User::class, 'rolle_id','id');
    }
    public function route()
    {
        return $this->belongsToMany(Route::class, 'role_route','route_id','role_id');
    }
}
