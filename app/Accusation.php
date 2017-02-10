<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accusation extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function accuUser()
    {
        return $this->belongsTo(User::class, 'accu_id', 'id');
    }
}
