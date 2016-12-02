<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mailbox extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
        protected $fillable = [
            'to','from', 'subject', 'body',
        ];

    public function users()
    {
        return $this->belongsTo(User::class,'from', 'email');
    }

}
