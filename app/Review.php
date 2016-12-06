<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function novels()
    {
        return $this->belongsTo(Novel::class, 'novel_id', 'id');
    }

    public function myself()
    {
        return $this->belongsTo(Review::class, 'id')->with('users')->with('novels');
    }
}
