<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RecentlyVisitedNovel
 *
 * @property int $id
 * @property int $user_id
 * @property int $novel_id
 * @property int $novel_group_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Novel $novels
 * @property-read \App\NovelGroup $novel_groups
 * @method static \Illuminate\Database\Query\Builder|\App\RecentlyVisitedNovel whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecentlyVisitedNovel whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecentlyVisitedNovel whereNovelId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecentlyVisitedNovel whereNovelGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecentlyVisitedNovel whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\RecentlyVisitedNovel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RecentlyVisitedNovel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'novel_id', 'novel_group_id',
    ];

    public function novels()
    {
        return $this->belongsTo(Novel::class, 'novel_id', 'id');
    }

    public function novel_groups()
    {
        return $this->belongsTo(NovelGroup::class, 'novel_group_id', 'id');
    }

}
