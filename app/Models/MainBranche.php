<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class MainBranche extends Model
{
    use HasFactory;
    protected  $table = 'main_branches';
    protected $fillable = [
        'name','logo'
    ];


    protected $hidden = [
        'created_at','updated_at'
    ];

    public function projects(){
        return $this->hasMany(Project::class,'main_branch_id','id');
    }
    public $timestamps = true;
}
