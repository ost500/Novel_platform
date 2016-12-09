<?php

namespace App\Http\Controllers;

use App\MenToMenQuestionAnswer;
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


        $men_to_menRequest =$request->user()->question_answers()->create($request->all());

        flash('1:1문의를 등록했습니다.');

        return \Response::json(["status"=>"200", "id"=> $men_to_menRequest->id ]);
    }



    public function answer(Request $request, $id)
    {
        $mtm = MenToMenQuestionAnswer::find($id);
        $mtm->answer = $request->comment;
        $mtm->status = 1;
        $mtm->save();

        flash('답변을 등록했습니다.');

        return \Response::json(["status"=>"200", "id"=> $mtm->id ]);
    }
}