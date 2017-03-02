<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $children
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $myself
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereDeletedAt($value)
 * @property bool $comment_secret
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereCommentSecret($value)
 */
class Comment extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'novel_id','parent_id','comment',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function novels()
    {
        return $this->belongsTo(Novel::class, 'novel_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('users')->with('novels');
    }

    public function myself()
    {
        return $this->hasMany(Comment::class, 'id')->with('users')->with('novels');
    }
}
