<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\NovelGroup[] $novel_groups
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Novel[] $novels
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $readNotifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @mixin \Eloquent
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @property string $phone_num
 * @property string $bank
 * @property string $account_holder
 * @property string $account_number
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePhoneNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereBank($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAccountHolder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAccountNumber($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\NickName[] $nicknames
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\MenToMenQuestionAnswer[] $question_answers
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function novel_groups()
    {
        return $this->hasMany(NovelGroup::class);
    }
    public function novels()
    {
        return $this->hasMany(Novel::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function nicknames()
    {
        return $this->hasMany(NickName::class);
    }
    public function question_answers()
    {
        return $this->hasMany(MenToMenQuestionAnswer::class);
    }

    public function mailbox()
    {
        return $this->hasMany(Mailbox::class,'to','email');
    }
}
