<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\NickName
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $nickname
 * @property boolean $main
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $users
 * @method static \Illuminate\Database\Query\Builder|\App\NickName whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NickName whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NickName whereNickname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NickName whereMain($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NickName whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NickName whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

    public function novel_groups()
    {
        return $this->hasOne('novel_groups');
    }
}
