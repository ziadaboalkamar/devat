<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorAttachment extends Model
{
    use HasFactory;
    use HasFactory;
    protected  $table = 'donor_attachment';
    protected $fillable = [
        'id', 'project_id ','category_id', 'file','url','add_by','created_at','updated_at'
    ];


    protected $hidden = [
        'created_at','updated_at'
    ];

    public $timestamps = true;
}
