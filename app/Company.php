<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Company
 *
 * @property int $id
 * @property string $name
 * @property int $initial_inning
 * @property bool $adult_allowance
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PublishNovelGroup[] $publish_novel_groups
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereInitialInning($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereAdultAllowance($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property bool $adult
 * @property string $company_picture
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereAdult($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereCompanyPicture($value)
 */
class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'initial_inning', 'adult_allowance',
    ];

    public function publish_novel_groups()
    {
        return $this->belongsToMany(PublishNovelGroup::class,
            'novel_group_publish_companies', 'company_id', 'publish_novel_group_id')
            ->withPivot('status', 'created_at');
    }

    public function publish_novels()
    {
        return $this->hasMany(PublishNovel::class);
    }


}
