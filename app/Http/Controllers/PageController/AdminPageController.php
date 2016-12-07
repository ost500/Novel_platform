<?php

namespace App\Http\Controllers\PageController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function novel()
    {
        return view('admin.novel');
    }

    public function user()
    {
        return view('admin.user');
    }

    public function sales()
    {
        return view('admin.sales');
    }
}
