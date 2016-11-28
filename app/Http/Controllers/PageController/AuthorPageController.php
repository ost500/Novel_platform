<?php

namespace App\Http\Controllers\PageController;
use App\NovelGroup;
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
}
