<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo(PublishNovelGroup::class, 'id');
    }
}
