<?php

namespace App\Http\Controllers\MobileController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notification;
use App\Faq;
use App\MenToMenQuestionAnswer;
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
        $faqs = Faq::where($filter)->paginate(config('define.pagination_long'));
        //send the category to view

        return view('mobile.ask.frequently_asked_questions', compact('faqs', 'query_string', 'category', 'search'));
    }

    public function questions()
    {
        $questions = MenToMenQuestionAnswer::orderBy('created_at', 'desc')->paginate(config('define.pagination_long'));
        return view('mobile.ask.questions', compact('questions'));
    }

    public function ask_question()
    {
        return view('mobile.ask.ask_question');
    }

    public function notifications()
    {
        $notifications = Notification::orderBy('created_at', 'desc')->where('posting', 1)->paginate(config('define.pagination_long'));
        return view('mobile.ask.notifications', compact('notifications'));
    }

    public function notification_detail($id)
    {
        //current notification
        $notification = Notification::where('id', $id)->first();

        //next notification
        $next_notification_id = Notification::where('id', '>', $notification->id)->min('id');
        $next_notification = Notification::find($next_notification_id);

        //previous notification
        $pre_notification_id = Notification::where('id', '<', $notification->id)->max('id');
        $pre_notification = Notification::find($pre_notification_id);

        return view('mobile.ask.notification_detail', compact('notification', 'next_notification', 'pre_notification'));
    }

    public function question_detail($id)
    {
        //current notification
        $question = MenToMenQuestionAnswer::where('id', $id)->first();

        //next notification
        $next_question_id = MenToMenQuestionAnswer::where('id', '>', $question->id)->min('id');
        $next_question = MenToMenQuestionAnswer::with('users')->find($next_question_id);

        //previous notification
        $pre_question_id = MenToMenQuestionAnswer::where('id', '<', $question->id)->max('id');
        $pre_question = MenToMenQuestionAnswer::with('users')->find($pre_question_id);

        return view('mobile.ask.question_detail', compact('question', 'next_question', 'pre_question'));
    }


    public function faq_detail(Request $request, $id)
    {

        //Set the Filters for Category,Search and Best faqs
        $category = $request->get('category');
        $search = $request->get('search');

        if ($category) {

            $filter = ['faq_category', '=', $category];
            $query_string = '?category=' . $category;

        } elseif ($search) {

            $filter = ['title', 'like', '%' . $search . '%'];
            $query_string = '?search=' . $search;

        } else {

            $filter = ['best', '=', 1];
            $query_string = '?best';

        }


        //current notification
        $faq = Faq::where('id', $id)->first();

        //next notification
        $next_faq_id = Faq::where([['id', '>', $id], $filter])->min('id');
        $next_faq = Faq::find($next_faq_id);

        //previous notification
        $pre_faq_id = Faq::where([['id', '<', $id], $filter])->max('id');
        $pre_faq = Faq::find($pre_faq_id);

        return view('mobile.ask.faq_detail', compact('faq', 'next_faq', 'pre_faq', 'query_string'));
    }

    public function accusations(Request $request, $id)
    {
        $link = url()->previous();

        $accu_id = $id;
        return view('mobile.ask.accusations', compact('accu_id', 'link'));
    }
}
