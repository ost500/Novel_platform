<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Review[] $reviews
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Mailbox[] $mailbox
 * @property boolean $author_agreement
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\MailLog[] $maillogs
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Favorite[] $favorites
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAuthorAgreement($value)
 * @property string $user_name
 * @property string $nickname
 * @property string $nickname_at
 * @property bool $auth_email
 * @property bool $auth_name
 * @property string $auth_mail_code
 * @property bool $comment_show
 * @property bool $mail_available
 * @property bool $event_mail_available
 * @property string $deleted_at
 * @property int $birth_of_year
 * @property bool $gender
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\FreeBoard[] $free_boards
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\FreeBoardComment[] $free_board_comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ReviewComment[] $review_comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\FreeBoardLike[] $free_board_likes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\NewSpeed[] $new_speeds
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUserName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereNickname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereNicknameAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAuthEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAuthName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAuthMailCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCommentShow($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereMailAvailable($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEventMailAvailable($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereBirthOfYear($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereGender($value)
 */
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_name', 'nickname', 'event_mail_available', 'birth_of_year', 'gender', 'auth_mail_code'
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
        return $this->hasMany(Mailbox::class, 'from', 'id');
    }

    public function maillogs()
    {
        return $this->hasMany(MailLog::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function isAdmin()
    {
        if ($this->name == 'Admin') {
            return true;
        } else {
            return false;
        }
    }

    public function free_boards()
    {
        return $this->hasMany(FreeBoard::class);
    }

    public function free_board_comments()
    {
        return $this->hasMany(FreeBoardComment::class);
    }

    public function review_comments()
    {
        return $this->hasMany(ReviewComment::class);
    }

    public function free_board_likes()
    {
        return $this->hasMany(FreeBoardLike::class);
    }

    public function new_speeds()
    {
        return $this->hasMany(NewSpeed::class);
    }
}
