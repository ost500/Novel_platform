<?php

namespace App\Http\Controllers\PageController;
use App\MenToMenQuestionAnswer;
use App\NovelGroup;
use App\Faq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthorPageController extends Controller
{
    public function index()
    {
        return view('author.index');
    }

    public function create()
    {

        return view('author.create');
    }

    public function edit($id)
    {
        $novel_group=NovelGroup::find($id);
        return view('author.edit', compact('novel_group'));
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
}
