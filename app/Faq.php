<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Faq
 *
 * @mixin \Eloquent
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
