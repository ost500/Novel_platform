<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NovelGroup extends Model
{
    public function novels()
    {
        return $this->hasMany(Novel::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
