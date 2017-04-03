<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\FreeBoardComment
 *
 * @property int $id
 * @property int $user_id
 * @property int $free_board_id
 * @property string $comment
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $users
 * @property-read \App\FreeBoard $freeboards
 * @method static \Illuminate\Database\Query\Builder|\App\FreeBoardComment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FreeBoardComment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FreeBoardComment whereFreeBoardId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FreeBoardComment whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FreeBoardComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FreeBoardComment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FreeBoardComment extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function freeboards()
    {
        return $this->belongsTo(FreeBoard::class, 'free_board_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(FreeBoardComment::class, 'parent_id')->with('users')->with('freeboards');
    }

    public function myself()
    {
        return $this->hasMany(FreeBoardComment::class, 'id')->with('users')->with('freeboards');
    }

}
