<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeneficiariesProject extends Model
{
    use HasFactory;
    protected  $table = 'beneficiaries_project';
    protected $fillable = [
        'id', 'project_id','beneficiary_id', 'branch_id','recever_name','status','family_member_count','add_by','delivery_date','employee_who_delivered','created_at','updated_at'
    ];


    protected $hidden = [
        'created_at','updated_at'
    ];

    public $timestamps = true;
    public function cities(){
        return $this->belongsTo(City::class,'city_id','id');
    }
    public function branchs(){
        return $this->belongsTo(Branches::class,'branch_id','id');
    }
    public function getActive(){
        return $this->status_id == 0 ? ' غير مستلم ': 'مستلم' ;
    }
    public function beneficiaries(){
        return $this->belongsTo(Beneficiary::class,'beneficiary_id','id');
    }
    public function getFullNameAttribute(): string
    {
        return ucfirst($this->firstName) . ' ' . ucfirst($this->secondName) . ' ' .ucfirst($this->thirdName) . ' ' .ucfirst($this->lastName);
    }

}
