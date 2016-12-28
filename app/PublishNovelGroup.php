<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublishNovelGroup extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'novel_group_id','days', 'novels_per_days',
    ];

    public function novel_group_companies()
    {
        return $this->hasMany(NovelGroupPublishCompany::class);
    }

    public function novel_groups()
    {
        return $this->belongsTo(NovelGroup::class, 'id');
    }

    public function publish_novels()
    {
        return $this->hasMany(PublishNovel::class);
    }
}
