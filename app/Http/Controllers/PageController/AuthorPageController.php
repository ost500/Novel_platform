<?php

namespace App\Http\Controllers\PageController;
use App\NovelGroup;
use App\Faq;
use App\Http\Controllers\Controller;
use Auth;


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

    public function edit($id)
    {
        $novel_group=NovelGroup::find($id);
        return view('author.edit', compact('novel_group'));
    }

   /* public function faqs()
    {
        return view('author.faqs');
    }*/

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
