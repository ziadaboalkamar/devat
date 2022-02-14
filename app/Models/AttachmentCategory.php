<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachmentCategory extends Model
{
    use HasFactory;
    protected  $table = 'attachment_categories';
    protected $fillable = [
        'id', 'name','type','created_at','updated_at'
    ];


    protected $hidden = [
        'created_at','updated_at'
    ];

    public $timestamps = true;
}
