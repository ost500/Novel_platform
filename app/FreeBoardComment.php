<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FreeBoardComment extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function freeboards()
    {
        return $this->belongsTo(FreeBoard::class, 'free_board_id', 'id');
    }
}
