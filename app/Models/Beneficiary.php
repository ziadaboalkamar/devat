<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;
    protected  $table = 'beneficiaries';
    protected $fillable = [
        'id', 'firstName','secondName', 'thirdName','lastName','gender','id_number','PhoneNumber','family_member','branch_id','project_id','city_id','address','maritial','status_id','created_at','updated_at'
    ];


    protected $hidden = [
        'created_at','updated_at'
    ];
    public function cities(){
        return $this->belongsTo(City::class,'city_id','id');
    }
    public function projects(){
        return $this->belongsTo(Project::class,'project_id','id');
    }
    public function branchs(){
        return $this->belongsTo(Branches::class,'branch_id','id');
    }
    public function getActive(){
        return $this->status_id == 0 ? __(' غير فعال ') : __('فعال') ;
    }
    
    public $timestamps = true;
}
