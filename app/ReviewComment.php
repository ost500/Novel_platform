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
}
