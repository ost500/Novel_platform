<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\NovelGroupHashTag
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $novel_group_id
 * @property string $tag
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroupHashTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroupHashTag whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroupHashTag whereNovelGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroupHashTag whereTag($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroupHashTag whereUpdatedAt($value)
 */
class NovelGroupHashTag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'novel_group_id', 'tag',
    ];

}
