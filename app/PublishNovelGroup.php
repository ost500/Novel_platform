<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PublishNovelGroup
 *
 * @property int $id
 * @property int $novel_group_id
 * @property int $days
 * @property int $novels_per_days
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\NovelGroup $novel_groups
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PublishNovel[] $publish_novels
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Company[] $companies
 * @method static \Illuminate\Database\Query\Builder|\App\PublishNovelGroup whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PublishNovelGroup whereNovelGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PublishNovelGroup whereDays($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PublishNovelGroup whereNovelsPerDays($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PublishNovelGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PublishNovelGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PublishNovelGroup extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'novel_group_id', 'days', 'novels_per_days',
    ];

    public function novel_groups()
    {
        return $this->belongsTo(NovelGroup::class, 'novel_group_id');
    }

    public function publish_novels()
    {
        return $this->hasMany(PublishNovel::class);
    }

    public function novels()
    {
        return $this->belongsToMany(Novel::class,
            'publish_novels', 'publish_novel_group_id', 'novel_id')
            ->withPivot('status', 'created_at');
    }


    public function companies()
    {
        return $this->belongsToMany(Company::class,
            'novel_group_publish_companies', 'publish_novel_group_id', 'company_id')
            ->withPivot('status', 'created_at', 'id');
    }

}
