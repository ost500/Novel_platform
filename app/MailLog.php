<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailLog extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function mailboxs()
    {
        return $this->belongsTo(MailBox::class, 'mailbox_id', 'id');
    }
}
