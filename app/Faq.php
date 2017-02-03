<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Faq
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $faq_category
 * @property string $title
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Faq whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faq whereFaqCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faq whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faq whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faq whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faq whereUpdatedAt($value)
 * @property bool $best
 * @method static \Illuminate\Database\Query\Builder|\App\Faq whereBest($value)
 */
class Faq extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'faq_category','title', 'description',
    ];
}
