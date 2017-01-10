<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\NovelGroupPublishCompany
 *
 * @property int $id
 * @property int $publish_novel_group_id
 * @property int $company_id
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroupPublishCompany whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroupPublishCompany wherePublishNovelGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroupPublishCompany whereCompanyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroupPublishCompany whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroupPublishCompany whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroupPublishCompany whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $reject_reason
 * @property-read \App\PublishNovelGroup $publish_novel_groups
 * @property-read \App\NovelGroup $novel_groups
 * @property-read \App\Company $companies
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroupPublishCompany whereRejectReason($value)
 * @property bool $today_done
 * @property int $days
 * @property int $novels_per_days
 * @property int $initial_novels
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroupPublishCompany whereTodayDone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroupPublishCompany whereDays($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroupPublishCompany whereNovelsPerDays($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroupPublishCompany whereInitialNovels($value)
 */
class NovelGroupPublishCompany extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'publish_novel_group_id','company_id', 'status',
    ];


    public function publish_novel_groups()
    {
        return $this->belongsTo(PublishNovelGroup::class, 'publish_novel_group_id');
    }

    public function companies()
    {
        return $this->hasOne(Company::class, 'id','company_id');
    }


}
