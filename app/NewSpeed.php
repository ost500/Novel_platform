<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewSpeed extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
