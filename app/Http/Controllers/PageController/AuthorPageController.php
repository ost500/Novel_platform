<?php

namespace App\Http\Controllers\PageController;
use App\NovelGroup;
use App\Faq;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;

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
