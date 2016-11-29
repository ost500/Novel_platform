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
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('author/faq_create')
                ->withErrors($validator)
                ->withInput();
        }
        $input=$request->all();
        //if validation is passed then insert the record
        Faq::create($input);
        //redirect to faqs
        return redirect('/author/faq_index');
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
        $validator = Validator::make($request->all(), [
            'nickname' => 'required|max:255',
            'title' => 'required',
            'description' => 'required',
        ]);
        //if validation fails then redirect to create page
        if ($validator->fails()) {
            return redirect('author/faq_edit')
                ->withErrors($validator)
                ->withInput();
        }

        //if validation is passed then insert the record
        Faq::where('id',$id)->update($input);
        //redirect to faqs
        return redirect('/author/faq_index');

    }


}
