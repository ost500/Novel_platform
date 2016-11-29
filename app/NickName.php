<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NickName extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function nick_main($user_id, $id)
    {
        $this->where('user_id', $user_id)->update(['main' => false]);
        $nick_main = $this->find($id);
        $nick_main->main = true;
        $nick_main->save();
    }
}
