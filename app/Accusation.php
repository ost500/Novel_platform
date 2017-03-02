<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Accusation
 *
 * @property int $id
 * @property int $user_id
 * @property int $accu_id
 * @property string $category
 * @property string $title
 * @property string $contents
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $link
 * @property-read \App\User $accuUser
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Accusation whereAccuId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Accusation whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Accusation whereContents($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Accusation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Accusation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Accusation whereLink($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Accusation whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Accusation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Accusation whereUserId($value)
 * @mixin \Eloquent
 */
class Accusation extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function accuUser()
    {
        return $this->belongsTo(User::class, 'accu_id', 'id');
    }
}
