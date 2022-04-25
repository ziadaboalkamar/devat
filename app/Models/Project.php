<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected  $table = 'projects';
    protected $fillable = [
        'id','status','project_name','grant_date','donor_id','category_id','grant_value','currency_id','exchange_amount','managerial_fees','start_date','project_branch_count_id','main_branch_id','setting_status',
        'created_at','updated_at','type',
    ];


    protected $hidden = [
       'created_at','updated_at'
    ];

    public $timestamps = true;
    public function mainBranches(){
        return $this->belongsTo(MainBranche::class,'main_branch_id','id');
    }
    public function category()
    {
        return $this->belongsTo(CategoriesOfProject::class, 'category_id', 'id');
    }
    public function donors()
    {
        return $this->belongsTo(Donor::class, 'donor_id', 'id');
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }
    public function getActive(){
        return $this->status == 0 ? __(' غير فعال ') : __('فعال') ;
    }

    public function branches(){
        return $this->belongsToMany(Branches::class,'project_branch_count','project_id','branch_id')
                    ->withPivot([
                        'status_id'
                    ]);
    }

    public function projectBranchCount(){
        return $this->hasMany(ProjectBranchCount::class,'project_id','id');
    }

    public function image(){
        return $this->hasOne(ImageAttachment::class,'project_id','id');
    }

    protected function doProcess($total)
    {
        switch ($this->type) {
            case 'fixed':
                return $this->value;
            case 'percentage':
                return ($this->value / 100) * $total;
            default:
                return 0;
        }
    }
}
