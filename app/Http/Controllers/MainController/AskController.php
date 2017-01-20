<?php

namespace App\Http\Controllers\MainController;

use App\Faq;
use App\MenToMenQuestionAnswer;
use Illuminate\Http\Request;
use App\Notification;
use App\Http\Controllers\Controller;

class AskController extends Controller
{
    public function faqs(Request $request)
    {
        //Set the Filters for Category,Search and Best faqs
        $category = $request->get('category');
        $search = $request->get('search');

        if ($category) {

            $filter = ['faq_category' => $category];
            $query_string = '?category=' . $category;

        } elseif ($search) {

            $filter = [['title', 'like', '%' . $search . '%']];
            $query_string = '?search=' . $search;

        } else {

            $filter = ['best' => 1];
            $query_string = '?best';

        }

        //Fetch data with pagination
        $faqs = Faq::where($filter)->paginate(10);
        //send the category to view

        return view('main.ask.frequently_asked_questions', compact('faqs', 'query_string', 'category','search'));
    }

    public function questions()
    {
        $questions = MenToMenQuestionAnswer::orderBy('created_at', 'desc')->paginate(10);
        return view('main.ask.questions', compact('questions'));
    }

    public function ask_question()
    {
        return view('main.ask.ask_question');
    }

    public function notifications()
    {
        $notifications = Notification::orderBy('created_at', 'desc')->paginate(10);
        return view('main.ask.notifications', compact('notifications'));
    }

}
