<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment_user_id',
        'comment_content',
        'comment_post_id',
        'comment_status',
        
       
    ];
    public function post(){
       
        return $this->belongsTo(Post::class,'comment_post_id','_id');
    }

    public function user(){
       
       return $this->belongsTo(User::class,'comment_user_id','_id');
    }
}
