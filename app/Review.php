<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * App\Review
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $novel_id
 * @property string $review
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $users
 * @property-read \App\Novel $novels
 * @property-read \App\Review $myself
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereNovelId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereReview($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereDeletedAt($value)
 */
class Review extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function novel_groups()
    {
        return $this->belongsTo(NovelGroup::class, 'novel_group_id', 'id');
    }

    public function myself()
    {
        return $this->belongsTo(Review::class, 'id')->with('users')->with('novels');
    }

    public function comments()
    {
        return $this->hasMany(ReviewComment::class);
    }
}
