<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Payment
 *
 * @property int $id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $content
 * @property int $numbers
 * @property string $method
 * @property-read \App\User $users
 * @method static \Illuminate\Database\Query\Builder|\App\Payment whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Payment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Payment whereMethod($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Payment whereNumbers($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Payment whereUserId($value)
 * @mixin \Eloquent
 */
class Payment extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
