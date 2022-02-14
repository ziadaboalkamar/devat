<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAttachment extends Model
{
    use HasFactory;
    protected  $table = 'project_attachment';
    protected $fillable = [
        'id', 'project_id','category_id', 'file','url','add_by','created_at','updated_at'
    ];


    protected $hidden = [
        'created_at','updated_at'
    ];

    public $timestamps = true;
    public function categoryAttachment()
    {
        return $this->belongsTo(AttachmentCategory::class, 'category_id','id');
    }

}
