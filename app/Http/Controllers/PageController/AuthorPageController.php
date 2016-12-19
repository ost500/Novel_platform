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
use App\Keyword;
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

        $keyword1 = Keyword::select('id', 'name')->where('category', '1')->get();
        $keyword2 = Keyword::select('id', 'name')->where('category', '2')->get();
        $keyword3 = Keyword::select('id', 'name')->where('category', '3')->get();
        $keyword4 = Keyword::select('id', 'name')->where('category', '4')->get();
        $keyword5 = Keyword::select('id', 'name')->where('category', '5')->get();
        $keyword6 = Keyword::select('id', 'name')->where('category', '6')->get();
        $keyword7 = Keyword::select('id', 'name')->where('category', '7')->get();

        return view('author.create',compact('keyword1','keyword2','keyword3','keyword4','keyword5','keyword6','keyword7'));
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
            $user = null;
        }
        return view('author.specific_mail', compact('user'));

    }

    public function mailbox_index(Request $request)
    {
        $novel_mail_messages = Auth::user()->maillogs()->with('mailboxs')->paginate(2);
        $page = $request->page;
//        return response()->json($novel_mail_messages);
        return view('author.novel_memo', compact('novel_mail_messages', 'page'));
    }

    public function mailbox_create()
    {
        $my_novel_groups = NovelGroup::where('user_id', Auth::user()->id)->get();
        return view('author.novel_memo_create', compact('my_novel_groups'));
    }

    public function mailbox_message_show($id, Request $request)
    {

//        $mailbox_message = Mailbox::where('id', $id)->with('users')->first();
        $men_to_men_request = MailLog::where('id', $id)->with('mailboxs.users')->with('users')->first();
        //update the read status
         if(!$men_to_men_request->read){
             //$maillog = new MailLog();
             $men_to_men_request->read=Carbon::now();
             $men_to_men_request->save();
         }
        $men_to_men_requests = $request->user()->maillogs()->with('mailboxs.users')->orderBy('created_at', 'desc')->paginate(2);
//                return response()->json($men_to_men_request);
        $page = $request->page;
        return view('author.mailbox_message', compact('men_to_men_request', 'men_to_men_requests', 'page'));
    }

    public function mailbox_send(Request $request)
    {
        $novel_mail_messages = Mailbox::where('from', Auth::user()->id)->with('users')->orderBy('created_at', 'desc')->paginate(2);
        $page = $request->page;
//                return response()->json($novel_mail_messages);
        return view('author.novel_memo_send', compact('novel_mail_messages', 'page'));
    }

    public function mailbox_send_message_show($id, Request $request)
    {

//        $mailbox_message = Mailbox::where('id', $id)->with('users')->first();
        $men_to_men_request = Mailbox::where('id', $id)->with('users')->with('maillogs.users')->with('novel_groups')->first();
        $men_to_men_requests = $request->user()->mailbox()->orderBy('id', 'desc')->paginate(2);
        $page = $request->page;
//        return response()->json($men_to_men_request);
        return view('author.mailbox_send_message', compact('men_to_men_request', 'men_to_men_requests', 'page'));
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
