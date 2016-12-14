<?php

namespace App\Http\Controllers;

use App\Faq;
use Validator;
use Illuminate\Http\Request;

class FaqController extends Controller
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
        $faqs= Faq::get();
        return \Response::json($faqs);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       Validator::make($request->all(), [
            'faq_category'=>'required',
            'title' => 'required|max:255',
            'description' => 'required',
        ], [
            'faq_category.required' => '범주은 필수 입니다.',
            'title.required' => '제목은 필수 입니다.',
            'title.max' =>   '제목은 반드시 255 자리보다 작아야 합니다.',
            'description.required' => '소개은 필수 입니다.',

        ])->validate();

        $input=$request->all();
        //if validation is passed then insert the record
        Faq::create($input);
        flash("FAQ created successfully");
        //redirect to faqs
        if($request->ajax()){ return response()->json(['status'=>'ok']);   }

       return redirect()->route('admin.faqs');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $input=$request->except('_token','_method');
        //Validate the request
        Validator::make($request->all(), [
            'faq_category'=>'required',
            'title' => 'required|max:255',
            'description' => 'required',
        ], [
            'faq_category.required' => '범주은 필수 입니다.',
            'title.required' => '제목은 필수 입니다.',
            'title.max' =>   '제목은 반드시 255 자리보다 작아야 합니다.',
            'description.required' => '소개은 필수 입니다.',

        ])->validate();

        //if validation is passed then insert the record
        Faq::where('id',$id)->update($input);

        if($request->ajax()){ return response()->json(['status'=>'ok']);   }
        //redirect to faqs
        return redirect()->route('admin.faqs');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $faq= Faq::find($id);
        $faq->delete();
        flash('삭제 되었습니다');
        return response()->json(['status'=>'ok']);
    }



}
