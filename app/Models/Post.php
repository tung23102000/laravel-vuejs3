<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_title',
        'post_author',
        'post_image',
        'post_content',
        'post_tag',
        'post_status',
        'post_comment_count',
       
    ];
}
