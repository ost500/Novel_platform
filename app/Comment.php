<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Comment
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $novel_id
 * @property string $comment
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $users
 * @property-read \App\Novel $novel_groups
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereNovelId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property integer $parent_id
 * @property-read \App\Novel $novels
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereParentId($value)
 */
class Comment extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function novels()
    {
        return $this->belongsTo(Novel::class, 'novel_id', 'id');
    }
}
