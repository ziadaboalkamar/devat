<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected  $table = 'routes';
    protected $fillable = [
        'id', 'route_name','category','route','created_at','updated_at'
    ];
    protected $hidden = [
        'created_at','updated_at'
    ];

    public $timestamps = true;
    public function user()
    {
        return $this->belongsToMany(User::class, 'user_route','route_id','user_id');
    }
    public function role()
    {
        return $this->belongsToMany(User::class, 'role_route','route_id','role_id');
    }
}
