<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPhasess extends Model
{
    use HasFactory;
    protected  $table = 'project_phasess';
    protected $fillable = [
        'id', 'phase_name','detail_phases', 'status_id','created_at','updated_at'
    ];


    protected $hidden = [
        'created_at','updated_at'
    ];

    public $timestamps = true;
}
