<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewSpeedLog extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function new_speed()
    {
        return $this->belongsTo(NewSpeed::class, 'new_speed_id', 'id');
    }
}
