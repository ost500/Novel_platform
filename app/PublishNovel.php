<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublishNovel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'novel_id','publish_novel_group_id','status','file',
    ];

    public function novel_groups()
    {
        return $this->belongsTo(PublishNovelGroup::class, 'id');
    }

}
