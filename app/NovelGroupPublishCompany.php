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

    public function novel_groups()
    {
        return $this->belongsTo(NovelGroup::class, 'publish_novel_group_id');
    }

    public function companies()
    {
        return $this->hasOne(Company::class, 'id','company_id');
    }


}
