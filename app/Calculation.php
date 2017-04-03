<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Calculation
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $columnX
 * @property string $columnY
 * @property string $dataX
 * @property string $dataY
 * @property string $column_names
 * @property string $description
 * @property string $excel_file
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Calculation whereColumnNames($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Calculation whereColumnX($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Calculation whereColumnY($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Calculation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Calculation whereDataX($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Calculation whereDataY($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Calculation whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Calculation whereExcelFile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Calculation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Calculation whereUpdatedAt($value)
 */
class Calculation extends Model
{
    public function calculation_eaches()
    {
        return $this->hasMany(CalculationEach::class);
    }
}
