<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\FCM
 *
 * @property int $id
 * @property string $Token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\FCM whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FCM whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FCM whereToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FCM whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FCM extends Model
{
    protected $table = "f_c_ms";
}
