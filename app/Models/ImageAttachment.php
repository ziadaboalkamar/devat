<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageAttachment extends Model
{
    use HasFactory;
    protected $table = 'image_attachment';
    public $timestamps = false;
    protected $fillable = [
        'project_id',
        'image_one',
        'image_two',
        'image_three',
        'image_fore',
        'image_five',
        'image_six',
        'image_seven',
        'image_eight',
    ];
}
