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
        'novel_group_id', 'days', 'novels_per_days',
    ];

    public function novel_groups()
    {
        return $this->belongsTo(NovelGroup::class, 'id');
    }

    public function publish_novels()
    {
        return $this->hasMany(PublishNovel::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class,
            'novel_group_publish_companies', 'publish_novel_group_id', 'company_id')
            ->withPivot('status', 'created_at');
    }

}
