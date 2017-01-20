<?php

namespace App\Http\Controllers\MainController;

use App\Faq;
use App\MenToMenQuestionAnswer;
use Illuminate\Http\Request;
use App\Notification;
use App\Http\Controllers\Controller;

class AskController extends Controller
{
    public function faqs()
    {
       // $faqs= Faq::orderBy('created_at','desc')->paginate(10);
        $best_faqs= Faq::Where([['best','=', 1 ],['faq_category','<>','독자']])->get();

        return view('main.ask.frequently_asked_questions',compact('best_faqs'));
    }

    public function questions()
    {
       $questions= MenToMenQuestionAnswer::orderBy('created_at','desc')->paginate(10);
        return view('main.ask.questions',compact('questions'));
    }

    public function ask_question()
    {
        return view('main.ask.ask_question');
    }

    public function notifications()
    {
        $notifications=Notification::orderBy('created_at','desc')->paginate(10);
        return view('main.ask.notifications',compact('notifications'));
    }

}
