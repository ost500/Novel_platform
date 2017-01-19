<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FreeBoard extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(FreeBoardComment::class);
    }

    public function likes()
    {
        return $this->hasMany(FreeBoardLike::class);
    }
}
