<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class,id);
    }
    public function novel_groups()
    {
        return $this->belongsTo(NovelGroup::class, 'id');
    }
}
