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
        $men_to_men_requests = $request->user()->question_answers()->get();
        return \Response::json($men_to_men_requests);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* $this->validate($request, [
             'title' => 'required',
             'question' => 'required',
         ]);*/
        Validator::make($request->all(), [
            'title' => 'required|max:255',
            'question' => 'required',
        ],
            [
                'title.required' => '제목은 필수 입니다.',
                'title.max' => '제목은 반드시 255 자리보다 작아야 합니다.',
                'question.required' => '내용은 필수 입니다.',
            ]
        )->validate();

        $input = $request->except('ask_question');
        //  dd($input);
        $men_to_menRequest = $request->user()->question_answers()->create($input);

        flash('1:1문의를 등록했습니다.');
        // if request is from front end
        if ($request->get('ask_question')) {

            return redirect()->route('ask.ask_question');

        }

        return \Response::json(["status" => "200", "id" => $men_to_menRequest->id]);
    }


    public function answer(Request $request, $id)
    {

        //  dd($request->all());
        Validator::make($request->all(), [
            'answer' => 'required',
        ],
            [
                'answer.required' => '답변은 필수 입니다.',
            ]
        )->validate();

        $mtm = MenToMenQuestionAnswer::find($id);
        $mtm->answer = $request->answer;
        $mtm->status = 1;
        $mtm->save();

        flash('1:1문의 답변을 등록했습니다.');

        return \Response::json(["status" => "200", "id" => $mtm->id]);
    }
}
