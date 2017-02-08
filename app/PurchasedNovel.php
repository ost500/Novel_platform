<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasedNovel extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function novels()
    {
        return $this->hasOne(Novel::class, 'id', 'novel_id');
    }
}
