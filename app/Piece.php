<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
