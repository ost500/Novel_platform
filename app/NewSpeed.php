<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\NewSpeed
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $link
 * @property string $image
 * @property bool $read
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $users
 * @method static \Illuminate\Database\Query\Builder|\App\NewSpeed whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NewSpeed whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NewSpeed whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NewSpeed whereLink($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NewSpeed whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NewSpeed whereRead($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NewSpeed whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NewSpeed whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NewSpeed extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
