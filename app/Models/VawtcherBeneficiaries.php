<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VawtcherBeneficiaries extends Model
{
    use HasFactory;
    protected  $table = 'vawtcher_beneficiaries';
    protected $fillable = [
        'id', 'user_id ','user_name', 'id_number','ammount','note','project_id ','project_name','project_category_name','created_at','updated_at'
    ];


    protected $hidden = [
        'created_at','updated_at'
    ];

}
