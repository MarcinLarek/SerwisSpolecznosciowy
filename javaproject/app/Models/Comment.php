<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $fillable = [
      'description',
      'user_id',
      'post_id',
  ];

  public function post()
  {
      return $this->belongsTo(Post::class);
  }
  public function getUser(){
    return User::where('id', $this->user_id)->firstOrFail();
  }
}
