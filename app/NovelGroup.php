<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\NovelGroup
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Novel[] $novels
 * @property-read \App\User $users
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereUpdatedAt($value)
 * @property string $nickname
 * @property string $description
 * @property string $keyword1
 * @property string $keyword2
 * @property string $keyword3
 * @property string $keyword4
 * @property string $keyword5
 * @property string $keyword6
 * @property string $keyword7
 * @property string $cover_photo
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereNickname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereKeyword1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereKeyword2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereKeyword3($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereKeyword4($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereKeyword5($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereKeyword6($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereKeyword7($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereCoverPhoto($value)
 * @property integer $max_inning
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Review[] $reviews
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereMaxInning($value)
 * @property string $cover_photo2
 * @property string $latest_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\NovelGroup[] $favorites
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereCoverPhoto2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereLatestAt($value)
 * @property bool $completed
 * @property bool $secret
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Mailbox[] $mailboxes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\MailLog[] $maillogs
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereCompleted($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereSecret($value)
 */
class NovelGroup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nickname', 'title', 'description','keyword1','keyword2','keyword3','keyword4','keyword5','keyword6','keyword7','novel_group_id','cover_photo',
    ];

    public function novels()
    {
        return $this->hasMany(Novel::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function mailboxes()
    {
        return $this->hasMany(Mailbox::class);
    }

    public function maillogs()
    {
        return $this->hasMany(MailLog::class);
    }
}
