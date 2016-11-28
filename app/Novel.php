<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Novel
 *
 * @property-read \App\User $users
 * @property-read \App\NovelGroup $novel_groups
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $user_id
 * @property integer $novel_group_id
 * @property string $title
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereNovelGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Novel whereUpdatedAt($value)
 */
class Novel extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function novel_groups()
    {
        return $this->belongsTo(NovelGroup::class, 'id');
    }
}
