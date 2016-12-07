<?php

namespace App\Http\Controllers\PageController;
use App\Mailbox;
use App\MenToMenQuestionAnswer;
use App\Novel;
use App\NovelGroup;
use App\Faq;
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

        $reser_day = new Carbon();

        //출간예약이 없다면 null 값을 리턴한다
        if($novel->publish_reservation == null){
            $novel->reser_day = null;
            $novel->reser_time = null;
        }
        else{
            $novel->reser_day = $reser_day->toDateString();
            $novel->reser_day = $reser_day->format('h:i');
        }



        return view('author.novel_inning_update', compact('novel', 'novel_group'));
    }

    public function edit($id)
    {
       // $novel_group=NovelGroup::find($id);
      //  return view('author.edit', compact('novel_group','id'));
        return view('author.edit', compact('id'));
    }

    public function mailbox_index(Request $request)
    {
        $novel_mail_messages= Mailbox::where('to',\Auth::user()->email)->with('users')->get();
        return view('author.novel_memo', compact('novel_mail_messages'));
    }

    public function mailbox_create()
    {
        return view('author.novel_memo_create');
    }

    public function mailbox_message_show($id)
    {

        $mailbox_message= Mailbox::where('id',$id)->with('users')->first();
        return view('author.mailbox_message', compact('mailbox_message'));
    }

    public function men_to_men_create()
    {
        return view('author.novel_request');
    }

    public function men_to_men_index(Request $request)
    {
        $men_to_men_requests = $request->user()->question_answers()->paginate(10);
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

    public function memo_index()
    {
        $memos = Memo::get();
        return view('author.novel_memo', compact('memos'));
    }

    public function faq_index()
    {

        $faq_reader = Faq::where('faq_category', 1)->get();
        $faq_author = Faq::where('faq_category', 2)->get();
        $faq_etc = Faq::where('faq_category', 3)->get();

        return view('author.novel_faq', compact('faq_reader','faq_author','faq_etc'));
    }

    public function faq_create()
    {
        return view('author.faq_create');
    }

    public function faq_edit($id)
    {
        $faq = Faq::find($id);
        return view('author.faq_edit', compact('faq'));
    }

    public function nickname()
    {
        return view('author.nick_name');
    }

}
