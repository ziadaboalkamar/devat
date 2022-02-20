<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected  $table = 'cities';
    protected $fillable = [
        'id', 'city_name','created_at','updated_at'
    ];


    protected $hidden = [
        'created_at','updated_at'
    ];

    public $timestamps = true;

    public  function beneficiaries(){
        return $this->hasMany(Beneficiary::class,'city_id','id');
    }
}
