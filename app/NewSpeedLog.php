<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\NewSpeedLog
 *
 * @property int $id
 * @property int $user_id
 * @property int $new_speed_id
 * @property bool $read
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $users
 * @property-read \App\NewSpeed $new_speed
 * @method static \Illuminate\Database\Query\Builder|\App\NewSpeedLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NewSpeedLog whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NewSpeedLog whereNewSpeedId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NewSpeedLog whereRead($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NewSpeedLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NewSpeedLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
