<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting2 extends Model
{
    use HasFactory;
    protected $fillable =[
        'key' ,'value'
    ];
    protected $table = 'settings_tow';
    public $timestamps = false;
}
