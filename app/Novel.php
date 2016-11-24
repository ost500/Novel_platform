<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Novel
 *
 * @property-read \App\User $users
 * @property-read \App\NovelGroup $novel_groups
 * @mixin \Eloquent
 */
class Novel extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function novel_groups()
    {
        return $this->belongsTo(NovelGroup::class, 'id');
    }
}
