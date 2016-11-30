<?php

namespace App\Http\Controllers\PageController;

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
        $novel_group = NovelGroup::find($id);
        return view('author.edit', compact('novel_group'));
    }

    public function men_to_men_index(Request $request)
    {
        $men_to_men_requests = $request->user()->question_answers()->get();
        return view('author.novel_request_list', compact('men_to_men_requests'));
    }

    public function men_to_men_show(Request $request, $id)
    {
        $men_to_men_request = MenToMenQuestionAnswer::where('id', $id)->with('users')->first();
        $men_to_men_requests = $request->user()->question_answers()->get();
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
