<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PurchasedNovel
 *
 * @property int $id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $novel_id
 * @property string $method
 * @property bool $status
 * @property-read \App\Novel $novels
 * @property-read \App\User $users
 * @method static \Illuminate\Database\Query\Builder|\App\PurchasedNovel whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PurchasedNovel whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PurchasedNovel whereMethod($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PurchasedNovel whereNovelId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PurchasedNovel whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PurchasedNovel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PurchasedNovel whereUserId($value)
 * @mixin \Eloquent
 */
class PurchasedNovel extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function novels()
    {
        return $this->hasOne(Novel::class, 'id', 'novel_id');
    }
}
