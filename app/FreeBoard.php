<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\FreeBoard
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $content
 * @property int $view_count
 * @property int $week_view_count
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\FreeBoardComment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\FreeBoardLike[] $likes
 * @method static \Illuminate\Database\Query\Builder|\App\FreeBoard whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FreeBoard whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FreeBoard whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FreeBoard whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FreeBoard whereViewCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FreeBoard whereWeekViewCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FreeBoard whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FreeBoard whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FreeBoard extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title','content',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(FreeBoardComment::class);
    }

    public function likes()
    {
        return $this->hasMany(FreeBoardLike::class);
    }
}
