<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTimeLine extends Model
{
    use HasFactory;
    protected  $table = 'project_time_line';
    protected $fillable = [
        'id', 'project_id','user_id','action','created_at','updated_at'
    ];


    protected $hidden = [
        'created_at','updated_at'
    ];

    public $timestamps = true;
}
