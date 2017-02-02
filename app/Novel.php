<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * App\Novel
 *
 * @property-read \App\User $users
 * @property-read \App\NovelGroup $novel_groups
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $user_id
 * @property integer $novel_group_id
 * @property string $title
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereNovelGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property boolean $adult
 * @property string $publish_reservation
 * @property string $author_comment
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereAdult($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Novel wherePublishReservation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereAuthorComment($value)
 * @property integer $inning
 * @property string $cover_photo
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Review[] $reviews
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereInning($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereCoverPhoto($value)
 * @property boolean $non_free_agreement
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereNonFreeAgreement($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ViewCount[] $view_counts
 * @property-read \App\PublishNovel $publish_novels
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PublishNovelGroup[] $publish_novel_groups
 * @property int $today_count
 * @property int $week_count
 * @property int $month_count
 * @property int $year_count
 * @property int $total_count
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereTodayCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereWeekCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereMonthCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereYearCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereTotalCount($value)
 */
class Novel extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function novel_groups()
    {
        return $this->belongsTo(NovelGroup::class, 'novel_group_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->with('users');
    }

    
    public function view_counts()
    {
        return $this->hasMany(ViewCount::class);
    }

    public function publish_novel_groups()
    {
        return $this->belongsToMany(PublishNovelGroup::class,
            'publish_novels', 'novel_id', 'publish_novel_group_id')
            ->withPivot('status', 'created_at');
    }

    public function publish_novels()
    {
        return $this->hasOne(PublishNovel::class);
    }
}
