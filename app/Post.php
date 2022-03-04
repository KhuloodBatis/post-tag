<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{   //to use the softdelete
    use SoftDeletes;
    //to update the delete_at
    protected $dates = ['delete_at'];

    protected $fillable = [
        'user_id', 'title', 'content', 'photo', 'slug',
    ];
    // to make the post for one user (one to many) To many Posts
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }
}
