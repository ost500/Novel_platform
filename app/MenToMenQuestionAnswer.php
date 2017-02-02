<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\MenToMenQuestionAnswer
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $question
 * @property string $answer
 * @property boolean $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $users
 * @method static \Illuminate\Database\Query\Builder|\App\MenToMenQuestionAnswer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MenToMenQuestionAnswer whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MenToMenQuestionAnswer whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MenToMenQuestionAnswer whereQuestion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MenToMenQuestionAnswer whereAnswer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MenToMenQuestionAnswer whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MenToMenQuestionAnswer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MenToMenQuestionAnswer whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $category
 * @method static \Illuminate\Database\Query\Builder|\App\MenToMenQuestionAnswer whereCategory($value)
 */
class MenToMenQuestionAnswer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','category','title', 'question','answer','status',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
