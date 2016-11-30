<?php

namespace App\Http\Controllers\PageController;
use App\Mailbox;
use App\MenToMenQuestionAnswer;
use App\NovelGroup;
use App\Faq;
use App\Http\Controllers\Controller;
use Auth;

use Illuminate\Http\Request;

class AuthorPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $novel_groups = Auth::user()->novel_groups;
        return view('author.index', compact('novel_groups'));
    }

    public function novel_gorup($id)
    {
        $novel_group = NovelGroup::find($id);
        $novels = $novel_group->novels;
        return view('author.novel_group', compact('novels'));
    }

    public function profile()
    {
        return view('author.profile');
    }

    public function create()
    {

        return view('author.create');
    }

    public function create_inning()
    {
        return view('author.novel_inning_write');
    }

    public function edit($id)
    {
        $novel_group=NovelGroup::find($id);
        return view('author.edit', compact('novel_group'));
    }

    public function mailbox_index(Request $request)
    {

        $novel_mail_messages= Mailbox::where('to',\Auth::user()->email)->with('users')->get();
        return view('author.novel_memo', compact('novel_mail_messages'));
    }

    public function mailbox_message_show($id)
    {

        $mailbox_message= Mailbox::where('id',$id)->with('users')->first();
        return view('author.mailbox_message', compact('mailbox_message'));
    }

    public function men_to_men_index(Request $request)
    {
        $men_to_men_requests= $request->user()->question_answers()->get();
        return view('author.novel_request_list', compact('men_to_men_requests'));
    }
    public function men_to_men_show(Request $request, $id)
    {
        $men_to_men_request= MenToMenQuestionAnswer::where('id',$id)->with('users')->first();
        $men_to_men_requests= $request->user()->question_answers()->get();
        return view('author.novel_request_view', compact('men_to_men_request','men_to_men_requests'));
    }

    public function memo_index()
    {
        $memos= Memo::get();
        return view('author.novel_memo', compact('memos'));
    }

    public function faq_index()
    {
        $faqs= Faq::get();
        return view('author.novel_faq', compact('faqs'));
    }

    public function faq_create()
    {
        return view('author.faq_create');
    }

    public function faq_edit($id)
    {
        $faq=Faq::find($id);
        return view('author.faq_edit', compact('faq'));
    }

    public function nickname()
    {
        return view('author.nick_name');
    }
}
