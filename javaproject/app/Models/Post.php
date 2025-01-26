<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
      return Comment::where('post_id',$this->id)->get();
      //return $this->hasMany(Comment::class);
    }
}
