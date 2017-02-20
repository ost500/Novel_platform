<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\FreeBoardLike
 *
 * @property int $id
 * @property int $user_id
 * @property int $free_board_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $users
 * @property-read \App\FreeBoard $freeboards
 * @method static \Illuminate\Database\Query\Builder|\App\FreeBoardLike whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FreeBoardLike whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FreeBoardLike whereFreeBoardId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FreeBoardLike whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FreeBoardLike whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FreeBoardLike extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'free_board_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function freeboards()
    {
        return $this->belongsTo(FreeBoard::class, 'free_board_id', 'id');
    }
}
