<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Notification
 *
 * @property int $id
 * @property string $category
 * @property string $title
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Notification whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Notification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'category','title', 'content',
    ];

}
