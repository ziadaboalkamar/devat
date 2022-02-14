<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteUser extends Model
{
    use HasFactory;
    protected  $table = 'user_route';
    protected $fillable = [
        'id', 'route_id','user_id'
    ];
}
