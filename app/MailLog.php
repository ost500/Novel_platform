<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\MailLog
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $mailbox_id
 * @property integer $novel_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $users
 * @property-read \App\Mailbox $mailboxs
 * @method static \Illuminate\Database\Query\Builder|\App\MailLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MailLog whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MailLog whereMailboxId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MailLog whereNovelId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MailLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MailLog whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $novel_group_id
 * @property \Carbon\Carbon $deleted_at
 * @property string $read
 * @property-read \App\NovelGroup $novel_groups
 * @method static \Illuminate\Database\Query\Builder|\App\MailLog whereNovelGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MailLog whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MailLog whereRead($value)
 */
class MailLog extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function mailboxs()
    {
        return $this->belongsTo(Mailbox::class, 'mailbox_id', 'id');
    }

    public function novel_groups()
    {
        return $this->belongsTo(NovelGroup::class, 'novel_group_id', 'id');
    }
}
