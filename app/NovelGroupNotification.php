<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NovelGroupNotification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','novel_group_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function novel_groups()
    {
        return $this->belongsTo(NovelGroup::class, 'novel_group_id', 'id');
    }

}
