<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\NovelGroup
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Novel[] $novels
 * @property-read \App\User $users
 * @mixin \Eloquent
 */
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
