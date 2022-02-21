<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesOfProject extends Model
{
    use HasFactory;
    protected  $table = 'categories_of_project';
    protected $fillable = [
        'id', 'name','created_at','updated_at'
    ];


    protected $hidden = [
        'created_at','updated_at'
    ];

    public function projects(){
        return $this->hasMany(Project::class,'category_id','id');
    }
    public $timestamps = true;
}
