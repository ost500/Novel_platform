<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ReviewComment
 *
 * @property int $id
 * @property int $user_id
 * @property int $review_id
 * @property int $parent_id
 * @property string $comment
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Review $reviews
 * @property-read \App\User $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ReviewComment[] $children
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ReviewComment[] $myself
 * @method static \Illuminate\Database\Query\Builder|\App\ReviewComment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ReviewComment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ReviewComment whereReviewId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ReviewComment whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ReviewComment whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ReviewComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ReviewComment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ReviewComment extends Model
{
    public function reviews()
    {
        return $this->belongsTo(Review::class, 'review_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function children()
    {
        return $this->hasMany(ReviewComment::class, 'parent_id','id')->with('users')->with('reviews');
    }

    public function myself()
    {
        return $this->hasMany(ReviewComment::class, 'id')->with('users')->with('reviews');
    }
}
