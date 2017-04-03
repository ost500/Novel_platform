<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\NovelGroupKeyword
 *
 * @property int $id
 * @property int $novel_group_id
 * @property int $keyword_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroupKeyword whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroupKeyword whereNovelGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroupKeyword whereKeywordId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroupKeyword whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroupKeyword whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NovelGroupKeyword extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'novel_group_id', 'keyword_id',
    ];


}
