<?php

namespace App\Http\Controllers\PageController;

use App\Mailbox;
use App\MailLog;
use App\MenToMenQuestionAnswer;
use App\Novel;
use App\NovelGroup;
use App\Faq;
use App\User;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthorPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $novel_groups = $request->user()->novel_groups()->with('novels')->get();
        return view('author.index', compact('novel_groups'));
    }

    public function novel_gorup($id)
    {
        $novel_group = NovelGroup::find($id);
        $novels = $novel_group->novels;
        return view('author.novel_group', compact('novels', 'novel_group'));
    }

    public function profile()
    {
        return view('author.profile');
    }

    public function create()
    {

        return view('author.create');
    }

    public function create_inning($id)
    {
        $novel_group = NovelGroup::find($id);
        return view('author.novel_inning_write', compact('novel_group'));
    }

    public function update_inning($id)
    {
        $novel = Novel::find($id);
        $novel_group = $novel->novel_groups;

        $reser_day = new Carbon($novel->publish_reservation);

        //출간예약이 없다면 null 값을 리턴한다
        if ($novel->publish_reservation == null) {
            $novel->reser_day = null;
            $novel->reser_time = null;
        } else {
            $novel->reser_day = $reser_day->toDateString();
            $novel->reser_time = $reser_day->format('h:i');
        }
        return view('author.novel_inning_update', compact('novel', 'novel_group'));

    }

    public function edit($id)
    {
        // $novel_group=NovelGroup::find($id);
        //  return view('author.edit', compact('novel_group','id'));
        return view('author.edit', compact('id'));
    }

    public function specific_mailbox_create($id = null)
    {
        if ($id) {
            $user = User::where('id', $id)->first();

        } else {
           $user=null;
        }
        return view('author.specific_mail', compact('user'));

    }

    public function mailbox_index(Request $request)
    {
        $novel_mail_messages = Auth::user()->maillogs()->paginate(10);
//        $page = new Paginator($novel_mail_messages, 2);
//        return response()->json($page);
        return view('author.novel_memo', compact('novel_mail_messages'));
    }

    public function mailbox_send(Request $request)
    {
        $novel_mail_messages = Mailbox::where('from', Auth::user()->id)->paginate(10);
//                return response()->json($novel_mail_messages);
        return view('author.novel_memo_send', compact('novel_mail_messages'));
    }

    public function mailbox_create()
    {
        $my_novel_groups = NovelGroup::where('user_id', Auth::user()->id)->get();
        return view('author.novel_memo_create', compact('my_novel_groups'));
    }

    public function mailbox_message_show($id, Request $request)
    {

//        $mailbox_message = Mailbox::where('id', $id)->with('users')->first();
        $men_to_men_request = MailLog::where('id', $id)->with('users')->first();
        $men_to_men_requests = $request->user()->maillogs()->orderBy('id', 'desc')->paginate(10);
//                return response()->json($men_to_men_requests);
        return view('author.mailbox_message', compact('men_to_men_request', 'men_to_men_requests'));
    }

    public function mailbox_send_message_show($id, Request $request)
    {

//        $mailbox_message = Mailbox::where('id', $id)->with('users')->first();
        $men_to_men_request = Mailbox::where('id', $id)->with('users')->first();
        $men_to_men_requests = $request->user()->mailbox()->orderBy('id', 'desc')->paginate(10);
        return view('author.mailbox_send_message', compact('men_to_men_request', 'men_to_men_requests'));
    }

    public function novel_memo_send($id)
    {
        $mailbox_message = Mailbox::where('id', $id)->with('users')->first();
        return view('author.mailbox_message', compact('mailbox_message'));
    }

    public function men_to_men_create()
    {
        return view('author.novel_request');
    }

    public function men_to_men_index(Request $request)
    {
        $men_to_men_requests = $request->user()->question_answers()->orderBy('id', 'desc')->paginate(10);
        // return \Response::json($men_to_men_requests);
        return view('author.novel_request_list', compact('men_to_men_requests'));
    }

    public function men_to_men_show(Request $request, $id)
    {
        $men_to_men_request = MenToMenQuestionAnswer::where('id', $id)->with('users')->first();
        $men_to_men_requests = $request->user()->question_answers()->orderBy('id', 'desc')->paginate(10);
        //  return \Response::json($men_to_men_requests);
        return view('author.novel_request_view', compact('men_to_men_request', 'men_to_men_requests'));
    }

    public function faq_index()
    {

        $faq_reader = Faq::where('faq_category', 1)->get();
        $faq_author = Faq::where('faq_category', 2)->get();
        $faq_etc = Faq::where('faq_category', 3)->get();

        return view('author.novel_faq', compact('faq_reader', 'faq_author', 'faq_etc'));
    }


    public function nickname()
    {
        return view('author.nick_name');
    }

}
