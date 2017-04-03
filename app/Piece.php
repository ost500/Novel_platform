<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Piece
 *
 * @property int $id
 * @property int $user_id
 * @property string $content
 * @property int $numbers
 * @property string $deadline
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $users
 * @method static \Illuminate\Database\Query\Builder|\App\Piece whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Piece whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Piece whereDeadline($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Piece whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Piece whereNumbers($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Piece whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Piece whereUserId($value)
 * @mixin \Eloquent
 */
class Piece extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'content','numbers', 'deadline', 'status',
    ];


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
