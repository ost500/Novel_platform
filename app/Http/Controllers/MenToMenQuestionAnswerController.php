<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
class MenToMenQuestionAnswerController extends Controller
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
        $men_to_men_requests= $request->user()->question_answers()->get();
        return \Response::json($men_to_men_requests);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'title' => 'required',
            'question' => 'required',
        ]);


         $request->user()->question_answers()->create($request->all());
       //  return "OK";
         return \Response::json("Request submitted successfully");
       //         return redirect()->route('author.novel_request_list');
    }

}
