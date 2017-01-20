<?php

namespace App\Http\Controllers\MainController;

use Illuminate\Http\Request;
use App\Notification;
use App\Http\Controllers\Controller;

class AskController extends Controller
{
    public function faqs()
    {
        return view('main.ask.frequently_asked_questions');
    }

    public function questions()
    {
        return view('main.ask.questions');
    }

    public function ask_question()
    {
        return view('main.ask.ask_question');
    }

    public function notifications()
    {
        $notifications=Notification::paginate(5);
        return view('main.ask.notifications',compact('notifications'));
    }


}
