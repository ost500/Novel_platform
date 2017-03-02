<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Present
 *
 * @property int $id
 * @property int $from_id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $content
 * @property string $status
 * @property-read \App\User $fromUser
 * @property-read \App\User $users
 * @method static \Illuminate\Database\Query\Builder|\App\Present whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Present whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Present whereFromId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Present whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Present whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Present whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Present whereUserId($value)
 * @mixin \Eloquent
 */
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
