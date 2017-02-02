<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReviewComment extends Model
{
    public function reviews()
    {
        return $this->belongsTo(Review::class, 'review_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function children()
    {
        return $this->hasMany(ReviewComment::class, 'parent_id','id')->with('users')->with('reviews');
    }

    public function myself()
    {
        return $this->hasMany(ReviewComment::class, 'id')->with('users')->with('reviews');
    }
}
