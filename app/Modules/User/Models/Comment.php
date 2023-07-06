<?php

namespace App\Modules\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\User\Models\BlogPost;
use App\Modules\User\Models\User;


class Comment extends Model
{
     use HasFactory;

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function replies()
    // {
    //   return $this->hasMany(Comment::class, 'parent_id');
    // }
    protected  $table= 'comments';
    protected $fillable =[
      
      'post_id',
      'user_id',
      'comment_body',
      'commented_by',
    ];

    public function post()
    {
      return $this->belongsTo(BlogPost::class, 'post_id', 'id');
    }

    public function user()
    {
      return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
