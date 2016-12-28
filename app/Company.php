<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'initial_inning', 'adult_allowance',
    ];

    public function publish_novel_groups()
    {
        return $this->belongsToMany(PublishNovelGroup::class,
            'novel_group_publish_companies', 'company_id', 'publish_novel_group_id')
            ->withPivot('status', 'created_at');
    }


}
