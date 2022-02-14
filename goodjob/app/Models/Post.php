<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    public function privacy()
    {
        return $this->hasOne(Privacy::class, 'post_id');
    }

    public function likes()
    {
        return $this->hasMany(User::class, 'post_like');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function tagedPeople()
    {
        return $this->hasMany(User::class, 'post_id', 'post_id');
    }
}
