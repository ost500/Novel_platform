<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Present extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_id', 'id');
    }
}
