<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\NovelGroup
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Novel[] $novels
 * @property-read \App\User $users
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereUpdatedAt($value)
 */
class NovelGroup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nickname', 'title', 'description','keyword1','keyword2','keyword3','keyword4','keyword5','keyword6','keyword7','novel_group_id','cover_photo',
    ];

    public function novels()
    {
        return $this->hasMany(Novel::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
