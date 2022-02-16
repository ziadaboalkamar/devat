<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected  $table = 'projects';
    protected $fillable = [
        'id','company_name','status','project_name', 'grant_date','category_id','grant_value','currency_id','managerial_fees','start_date','project_branch_count_id','main_branch_id','created_at','updated_at'
    ];


    protected $hidden = [
       'created_at','updated_at'
    ];

    public $timestamps = true;
<<<<<<< HEAD
    public function mainBranches(){
        return $this->belongsTo(MainBranche::class,'main_branch_id','id');
    }
    public function category(){
        return $this->belongsTo(CategoriesOfProject::class,'category_id','id');
=======
    public function getActive(){
        return $this->status == 0 ? __(' غير فعال ') : __('فعال') ;
>>>>>>> b711b8feed5c8d2abd10369d6c1c82c3ff967071
    }

}
