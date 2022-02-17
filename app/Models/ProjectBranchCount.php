<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectBranchCount extends Model
{
    use HasFactory;
    protected  $table = 'project_branch_count';
    protected $fillable = [
        'id','branch_id','project_id','beneficiaries_count','count','deadline_date','status_id','created_at','updated_at'
    ];


    protected $hidden = [
        'created_at','updated_at'
    ];

    public $timestamps = true;
    public function branches(){
        return $this->belongsTo(Branches::class,'branch_id','id');
    }
    public function getActive(){
        return $this->status = 0 ? __(' غير معتمد ') : __('معتمد') ;
    }
}
