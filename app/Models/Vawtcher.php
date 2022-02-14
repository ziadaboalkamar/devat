<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vawtcher extends Model
{
    use HasFactory;
    protected  $table = 'vawtcher';
    protected $fillable = [
        'id', 'user_id ','project_id', 'ammount','text','note','created_at','updated_at'
    ];


    protected $hidden = [
        'created_at','updated_at'
    ];


}
