<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleRoute extends Model
{
    use HasFactory;
    protected  $table = 'role_route';
    protected $fillable = [
        'id', 'route_id','role_id'
    ];

}
