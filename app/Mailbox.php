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
 * @property integer $novel_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\MailLog[] $maillogs
 * @method static \Illuminate\Database\Query\Builder|\App\Mailbox whereNovelId($value)
 * @property string $attachment
 * @property int $novel_group_id
 * @property-read \App\NovelGroup $novel_groups
 * @method static \Illuminate\Database\Query\Builder|\App\Mailbox whereAttachment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Mailbox whereNovelGroupId($value)
 */
class Mailbox extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from', 'subject', 'body',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'from', 'id');
    }

    public function maillogs()
    {
        return $this->hasMany(MailLog::class);
    }

    public function novel_groups()
    {
        return $this->belongsTo(NovelGroup::class, 'novel_group_id', 'id');
    }

}
