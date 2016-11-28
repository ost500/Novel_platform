<?php

namespace App\Http\Controllers\PageController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthorPageController extends Controller
{
    public function index()
    {
        return view('author.index');
    }
}
