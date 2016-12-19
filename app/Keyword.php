<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Keyword
 *
 * @property int $id
 * @property int $category
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Keyword whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Keyword whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Keyword whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Keyword whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Keyword whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Keyword extends Model
{
    //

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category', 'name',
    ];
}
