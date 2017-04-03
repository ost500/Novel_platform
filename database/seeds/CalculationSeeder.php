<?php

use App\Calculation;
use Illuminate\Database\Seeder;

class CalculationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cal = new Calculation();

        $cal->columnX = 'A';
        $cal->columnY = '3';
        $cal->dataX = 'A';
        $cal->dataY = '5';
        $cal->column_names = "name,컨텐츠No, 공급자코드, CP명, 서비스일";
        $cal->excel_file = '/excel/' . 'naver.xlsx';
        $cal->description = "this is what i want";
        $cal->when = "2017-03-22";
        $cal->cal_numberX = "C";
        $cal->save();
    }
}
