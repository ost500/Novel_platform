<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

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
 * @property string $deleted_at
 * @property-read \App\PublishNovelGroup $publish_novel_groups
 * @method static \Illuminate\Database\Query\Builder|\App\NovelGroup whereDeletedAt($value)
 */
class NovelGroup extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nickname', 'title', 'description', 'keyword1', 'keyword2', 'keyword3', 'keyword4', 'keyword5', 'keyword6', 'keyword7', 'novel_group_id', 'cover_photo',
    ];

    public function novels()
    {
        return $this->hasMany(Novel::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
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

    public function publish_novel_groups()
    {
        return $this->hasOne(PublishNovelGroup::class);
    }

    public function nicknames()
    {
        return $this->belongsTo(NickName::class, 'nickname_id', 'id');
    }

    public function recently_visited_novels()
    {
        return $this->hasOne(RecentlyVisitedNovel::class);
    }

    public function keywords()
    {
        return $this->belongsToMany(Keyword::class,
            'novel_group_keywords', 'novel_group_id', 'keyword_id')
            ->withPivot('id','novel_group_id','keyword_id','created_at','updated_at');
    }

   public function getNovelGroupViewCount($novel_group_id)
    {
        $total_view_count= Novel::selectRaw(' sum(total_count) as total_view_count ')->where('novel_group_id',$novel_group_id)->first();
        if($total_view_count) {
            return $total_view_count->total_view_count;
        }
    }

    public function getNovelGroupFavoriteCount($novel_group_id)
    {
        $favorite_count= Favorite::selectRaw('  count(novel_group_id) as favorite_count ')->where('novel_group_id',$novel_group_id)->first();
        if($favorite_count) {
            return $favorite_count->favorite_count;
        }
    }
    public function checkUserFavourite($novel_group_id){

        $favorite=Favorite::where(['novel_group_id'=>$novel_group_id,'user_id'=>Auth::user()->id])->first();
        if($favorite){  return true; }
    }
}
