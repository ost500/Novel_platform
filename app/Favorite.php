<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Favorite
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $novel_group_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $users
 * @property-read \App\NovelGroup $novel_groups
 * @method static \Illuminate\Database\Query\Builder|\App\Favorite whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Favorite whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Favorite whereNovelGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Favorite whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Favorite whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Favorite extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function novel_groups()
    {
        return $this->belongsTo(NovelGroup::class, 'novel_group_id', 'id');
    }
}
