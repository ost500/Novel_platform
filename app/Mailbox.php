<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Mailbox
 *
 * @property integer $id
 * @property string $to
 * @property string $from
 * @property string $subject
 * @property string $body
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $users
 * @method static \Illuminate\Database\Query\Builder|\App\Mailbox whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Mailbox whereTo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Mailbox whereFrom($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Mailbox whereSubject($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Mailbox whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Mailbox whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Mailbox whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Mailbox extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'to', 'from', 'subject', 'body',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'from', 'id');
    }

    public function maillogs()
    {
        return $this->hasMany(MailLog::class, 'from', 'user_id');
    }

}
