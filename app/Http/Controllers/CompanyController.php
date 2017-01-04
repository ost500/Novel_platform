<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use Validator;

class CompanyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Validator::make($request->all(), [
            'name' => 'required|max:255',
            'company_picture' => 'mimes:jpeg,png|max:1024',
            'initial_inning' => 'required|numeric',

        ], [
            'name.required' => '업체명은 필수 입니다.',
            'name.max' => '업체명은 반드시 255 자리보다 작아야 합니다.',
            'company_picture.mimes' => '이미지는 반드시 다음의 파일 타입이어야 합니다: jpeg, png',
            'company_picture.max' => '표지1 용량은 1M를 넘지 않아야 합니다',
            'initial_inning.required' => '초기연재회차는 필수 입니다.',
            'initial_inning.numeric' => ' 초기연재회차는 반드시 숫자여야 합니다',


        ])->validate();

        $input = $request->all();
        if ($request->adult == "on") {
            $input['adult'] = true;
        } else {
            $input['adult'] = false;
        }

        //if validation is passed then insert the record
        $company = Company::create($input);

        if ($request->hasFile('company_picture')) {
            $company_picture = $request->file('company_picture');
            $filename = $company->id.".".$company_picture->getClientOriginalExtension();
            //db pic name
            $company->company_picture = $filename;
            //upload file to destination path
            $destinationPath = public_path('img/company_pictures/');
            $company_picture->move($destinationPath, $filename);
            $company->save();
        }


        flash("제휴 업체가 성공적으로 생성 됐습니다.");

        if ($request->ajax()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()->route('admin.partner_manage_company');

    }

    public function update(Request $request ,$company_id)
    {
        Validator::make($request->all(), [
            'name' => 'required|max:255',
            'company_picture' => 'mimes:jpeg,png|max:1024',
            'initial_inning' => 'required|numeric',

        ], [
            'name.required' => '업체명은 필수 입니다.',
            'name.max' => '업체명은 반드시 255 자리보다 작아야 합니다.',
            'company_picture.mimes' => '이미지는 반드시 다음의 파일 타입이어야 합니다: jpeg, png',
            'company_picture.max' => '표지1 용량은 1M를 넘지 않아야 합니다',
            'initial_inning.required' => '초기연재회차는 필수 입니다.',
            'initial_inning.numeric' => ' 초기연재회차는 반드시 숫자여야 합니다',


        ])->validate();

        $input = $request->except('_method','_token','test');
        if ($request->adult == "on") {
            $input['adult'] = true;
        } else {
            $input['adult'] = false;
        }

        //if validation is passed then insert the record

        if ($request->hasFile('company_picture')) {
            $company_picture = $request->file('company_picture');
            $filename = $company_id.".".$company_picture->getClientOriginalExtension();
            //db pic name
            $input['company_picture'] = $filename;
            //upload file to destination path
            $destinationPath = public_path('img/company_pictures/');
            $company_picture->move($destinationPath, $filename);
        }

        Company::where('id', $company_id)->update($input);
        flash("제휴 업체가 성공적으로 수정 됐습니다.");

        if ($request->ajax()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()->route('admin.partner_manage_company');
    }


    public function show($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();
        //  flash('삭제 되었습니다');
        return response()->json(['status' => 'ok']);
    }


}
