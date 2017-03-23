<?php

namespace App\Http\Controllers;


use App\Calculation;
use App\CalculationEach;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class CalculationController extends Controller
{


    public function store(Request $request)
    {

        Validator::make($request->all(), [
            'columnX' => 'required|max:2|alpha',
            'columnY' => 'required|max:100|numeric',
            'dataX' => 'required|max:2|alpha',
            'dataY' => 'required|max:100|numeric',
            'columnNames' => 'required|max:2000',
            'description' => 'required|max:3000',
            'excel' => 'required',
            'code_numberX' => 'required|max:2|alpha',
            'date' => 'required',
            'cal_numberX' => 'required|max:2|alpha'

        ],
            [
                'columnX.required' => '컬럼 시작 인덱스(X)는 필수 입니다.',
                'columnX.max' => '컬럼 시작 인덱스(X) 타입이 잘못 됐습니다.',
                'columnX.alpha' => '컬럼 시작 인덱스(X) 타입이 잘못 됐습니다.',

                'columnY.required' => '컬럼 시작 인덱스(Y)는 필수 입니다.',
                'columnY.max' => '컬럼 시작 인덱스(Y) 타입이 잘못 됐습니다.',
                'columnY.numeric' => '컬럼 시작 인덱스(Y) 타입이 잘못 됐습니다.',

                'dataX.required' => '데이터 시작 인덱스(X)는 필수 입니다.',
                'dataX.max' => '데이터 시작 인덱스(X) 타입이 잘못 됐습니다.',
                'dataX.alpha' => '데이터 시작 인덱스(X) 타입이 잘못 됐습니다.',

                'dataY.required' => '데이터 시작 인덱스(Y)는 필수 입니다.',
                'dataY.max' => '데이터 시작 인덱스(Y) 타입이 잘못 됐습니다.',
                'dataY.numeric' => '데이터 시작 인덱스(Y) 타입이 잘못 됐습니다.',

                'code_numberX.required' => '코드 번호 인덱스는 필수 입니다.',
                'code_numberX.max' => '코드 번호 인덱스 타입이 잘못 됐습니다.',
                'code_numberX.numeric' => '코드 번호 인덱스 타입이 잘못 됐습니다.',

                'cal_numberX.required' => '정산 금액 인덱스는 필수 입니다.',
                'cal_numberX.max' => '정산 금액 인덱스 타입이 잘못 됐습니다.',
                'cal_numberX.numeric' => '정산 금액 인덱스 타입이 잘못 됐습니다.',


                'columnNames.required' => '컬럼명은 필수 입니다.',
                'columnNames.max' => '컬럼명은 반드시 2000 자리보다 작아야 합니다.',

                'description.required' => '내용은 필수 입니다.',
                'description.max' => '내용은 반드시 2000 자리보다 작아야 합니다.',

                'excel.required' => '엑셀 파일은 필수 입니다.',
                'date.required' => '날짜는 필수 입니다.',
            ]
        )->validate();

        $newCalculation = new Calculation();

        $newCalculation->columnX = $request->columnX;
        $newCalculation->columnY = $request->columnY;
        $newCalculation->dataX = $request->dataX;
        $newCalculation->dataY = $request->dataY;
        $newCalculation->description = $request->description;
        $newCalculation->column_names = $request->columnNames;
        $newCalculation->code_numberX = $request->code_numberX;
        $newCalculation->when = $request->date;
        $newCalculation->cal_numberX = $request->cal_numberX;
        $newCalculation->save();

        $excelFile = $request->file('excel');
        $filename = $excelFile->getClientOriginalName();
        $destinationPath = 'excel/';
        $newCalculation->excel_file = $newCalculation->id . '_' . $filename;
        $excelFile->move($destinationPath, $newCalculation->excel_file);


        $newCalculation->save();


        return redirect()->route('calculation.eaches', ['id' => $newCalculation->id]);
//        return response()->json($request->all());
    }

    public function run($id)
    {
        $newCalculation = Calculation::findOrFail($id);

        $path = public_path() . '/excel/' . $newCalculation->excel_file;

        // fetch column names
        $newCalculation->column_names = str_replace(" ", "", $newCalculation->column_names);
        $newValueArray = explode(",", $newCalculation->column_names);

//        return response()->json($newCalculation);

        try {


            Excel::load($path, function ($reader) use ($newCalculation, $newValueArray) {


                $objExcel = $reader->getExcel();
                $sheet = $objExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                // data name

                //  Read a row of data into an array
                $column = $newCalculation->columnX;
                $row = $newCalculation->columnY;
                // from columnX to $highestColumn
                $keyData = $sheet->rangeToArray($column . $row . ':' . $highestColumn . $row,
                    NULL, TRUE, FALSE);


                $keys = array();
                $extraKeys = array();
                $code_num = "";
                $cal_num = "";

                // result is $keyData[0]
                foreach ($keyData[0] as $key => $value) {

                    if (in_array($value, $newValueArray)) {
                        // save keys which we need
                        $keys[] = $key;
                    } else {
                        $extraKeys[] = $value;
                    }

                    if ($key == ord(strtoupper($newCalculation->code_numberX)) - 65) {
                        $code_num = $key;
                    }
                    if ($key == ord(strtoupper($newCalculation->cal_numberX)) - 65) {
                        $cal_num = $key;
                    }
                    echo $cal_num;

                }

//            print_r($keys);

                // from dataX to highestColumn
                // fetch all data
                $excel = [];

                for ($row = $newCalculation->dataY; $row <= $highestRow; $row++) {
                    //  Read a row of data into an array

                    $rowData = $sheet->rangeToArray($newCalculation->dataX . $row . ':' . $highestColumn . $row,
                        NULL, TRUE, FALSE);

                    $excel[] = $rowData[0];
                }


                foreach ($excel as $index => $rowData) {
                    $newCalculationEach = new CalculationEach();
                    $newCalculationEach->calculation_id = $newCalculation->id;
                    $extraKeysIndex = 0;


                    foreach ($rowData as $key => $value) {

//                        print_r($key . "=>" . $value . "\n");
                        if (in_array($key, $keys)) {
                            // remove ","
                            $value = str_replace(",", "", $value);
                            // save keys which we need
                            $newCalculationEach->data = $newCalculationEach->data . $value . ",";
                        } else {
                            $newCalculationEach->extra_data = $newCalculationEach->extra_data . $extraKeys[$extraKeysIndex] . ":" . $value . ",";
                            $extraKeysIndex = $extraKeysIndex + 1;
                        }

                        if ($code_num == $key) {
                            $newCalculationEach->code_number = $value;

                        }
                        if ($cal_num == $key) {
                            $newCalculationEach->cal_number = $value;

                        }


                    }


                    // erase last ","
                    $newCalculationEach->data = rtrim($newCalculationEach->data, ",");
                    $newCalculationEach->extra_data = rtrim($newCalculationEach->extra_data, ",");
//                    print_r($newCalculationEach);
                    try {
                        $newCalculationEach->save();
                    } catch (Exception $e) {
                        flash('정산 실행 도중 에러가 발생했습니다. 파일을 다시 확인하세요.');
                        redirect()->back();

                    }


                }


            });
        } catch (Exception $e) {
            flash('정산 실행 도중 에러가 발생했습니다. 파일을 다시 확인하세요.');
            redirect()->back();
        }
        flash('정산을 성공했습니다');
//        return response()->json($newCalculationEach);
//        return redirect()->back();
    }

    public function cancelCalculation($id)
    {
        CalculationEach::where('calculation_id', $id)->delete();
        flash('정산 내용을 삭제했습니다');
        return redirect()->back();
    }

    public function destroyCalculationEaches(Request $request)
    {
        try {
            foreach ($request->ids as $id) {
                CalculationEach::findOrFail($id)->delete();
            }
        } catch (Exception $e) {
            flash('정산 내용 삭제를 실패했습니다');
        }


        flash('정산 내용을 삭제 했습니다');

        return $request->ids;
    }

    public function destroy(Request $request)
    {


        try {
            foreach ($request->ids as $id) {
                Calculation::findOrFail($id)->delete();
            }
        } catch (Exception $e) {
            flash('삭제에 실패했습니다');
        }


        flash('항목을 삭제 했습니다');

        return $request->ids;
    }

    public function updateXY(Request $request, $id)
    {
        Validator::make($request->all(), [
            'columnX' => 'required|max:2|alpha',
            'columnY' => 'required|max:100|numeric',
            'dataX' => 'required|max:2|alpha',
            'dataY' => 'required|max:100|numeric',
            'code_numberX' => 'required|max:2|alpha',
            'cal_numberX' => 'required|max:2|alpha',

        ],
            [
                'columnX.required' => '컬럼 시작 인덱스(X)는 필수 입니다.',
                'columnX.max' => '컬럼 시작 인덱스(X) 타입이 잘못 됐습니다.',
                'columnX.alpha' => '컬럼 시작 인덱스(X) 타입이 잘못 됐습니다.',

                'columnY.required' => '컬럼 시작 인덱스(Y)는 필수 입니다.',
                'columnY.max' => '컬럼 시작 인덱스(Y) 타입이 잘못 됐습니다.',
                'columnY.numeric' => '컬럼 시작 인덱스(Y) 타입이 잘못 됐습니다.',

                'code_numberX.required' => '코드 번호 인덱스는 필수 입니다.',
                'code_numberX.max' => '코드 번호 인덱스 타입이 잘못 됐습니다.',
                'code_numberX.numeric' => '코드 번호 인덱스 타입이 잘못 됐습니다.',

                'dataX.required' => '데이터 시작 인덱스(X)는 필수 입니다.',
                'dataX.max' => '데이터 시작 인덱스(X) 타입이 잘못 됐습니다.',
                'dataX.alpha' => '데이터 시작 인덱스(X) 타입이 잘못 됐습니다.',

                'dataY.required' => '데이터 시작 인덱스(Y)는 필수 입니다.',
                'dataY.max' => '데이터 시작 인덱스(Y) 타입이 잘못 됐습니다.',
                'dataY.numeric' => '데이터 시작 인덱스(Y) 타입이 잘못 됐습니다.',

                'cal_numberX.required' => '정산 금액 인덱스(Y)는 필수 입니다.',
                'cal_numberX.max' => '정산 금액 인덱스(Y) 타입이 잘못 됐습니다.',
                'cal_numberX.numeric' => '정산 금액 인덱스(Y) 타입이 잘못 됐습니다.',


            ]
        )->validate();


        $cal = Calculation::findOrFail($id);

        $cal->columnX = $request->columnX;
        $cal->columnY = $request->columnY;
        $cal->dataX = $request->dataX;
        $cal->dataY = $request->dataY;
        $cal->code_numberX = $request->code_numberX;
        $cal->cal_numberX = $request->cal_numberX;

        $cal->save();

        flash('인덱스를 수정 했습니다');
        return response()->json($request->all());
    }

    public function updateColumnNames(Request $request, $id)
    {

        Validator::make($request->all(), [
            'columnNames' => 'required|max:2000',
        ],
            [
                'columnNames.required' => '컬럼명은 필수 입니다.',
                'columnNames.max' => '컬럼명은 반드시 2000 자리보다 작아야 합니다.',
            ]
        )->validate();


        $cal = Calculation::findOrFail($id);

        $cal->column_names = $request->columnNames;
        $cal->save();

        flash('컬럼명들을 수정했습니다');
        return;
    }

    public function excel_down($id)
    {
        $file = Calculation::findOrFail($id)->excel_file;

        return response()->download('excel/' . $file);
    }

}
