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
            'initial_inning' => 'required|numeric',
            'adult_allowance' => 'required',
            //'company_picture' => 'image|max:1024',
        ], [
            'name.required' => '업체명은 필수 입니다.',
            'name.max' => '업체명은 반드시 255 자리보다 작아야 합니다.',
            'initial_inning.required' => '소개은 필수 입니다.',
            'initial_inning.numeric' => ' 반드시 숫자여야 합니다',
            'adult_allowance.required' => '소개은 필수 입니다.',
            //  'company_picture.max' => '표지1 용량은 1M를 넘지 않아야 합니다',
            // 'company_picture.mimes' =>'이미지은 반드시 다음의 파일 타입이어야 합니다: jpeg, png',
        ])->validate();

        $input = $request->all();
        if ($request->adult_allowance=="on") {
            $input['adult_allowance'] = true;
        } else {
            $input['adult_allowance'] = false;
        }
        //if validation is passed then insert the record
        Company::create($input);
        flash("Company created successfully");
      
        if ($request->ajax()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()->route('author.partner_manage_company');

    }

    public function update(Request $request)
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
