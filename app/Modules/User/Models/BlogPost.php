<?php

namespace App\Modules\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'body' ,'image','created_by'];

public function User()
{
   return $this->belongsTo(User::class);
}


public function comments()
{
    return $this->hasMany(Comment::class, 'post_id' ,'id');
    
}

  
}
