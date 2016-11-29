<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
