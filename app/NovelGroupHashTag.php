<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NovelGroupHashTag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'novel_group_id', 'tag',
    ];

}
