<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CalculationEach
 *
 * @property int $id
 * @property string $data
 * @property string $extra_data
 * @property int $calculation_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\CalculationEach whereCalculationId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CalculationEach whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CalculationEach whereData($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CalculationEach whereExtraData($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CalculationEach whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CalculationEach whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CalculationEach extends Model
{
    public function calculations()
    {
        return $this->belongsTo(Calculation::class, 'calculation_id', 'id');
    }

    public function novel_groups()
    {
        return $this->belongsTo(NovelGroup::class, 'code_number', 'code_number');
    }
}
