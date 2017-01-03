<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PublishNovel
 *
 * @property int $id
 * @property int $novel_id
 * @property int $publish_novel_group_id
 * @property string $status
 * @property string $file
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\PublishNovelGroup $publish_novel_groups
 * @property-read \App\Novel $novels
 * @method static \Illuminate\Database\Query\Builder|\App\PublishNovel whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PublishNovel whereNovelId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PublishNovel wherePublishNovelGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PublishNovel whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PublishNovel whereFile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PublishNovel whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PublishNovel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PublishNovel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'novel_id', 'publish_novel_group_id', 'status', 'file',
    ];

    public function publish_novel_groups()
    {
        return $this->belongsTo(PublishNovelGroup::class, 'publish_novel_group_id', 'id');
    }

    public function novels()
    {
        return $this->hasOne(Novel::class, 'id','novel_id');
    }

    public function companies()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
