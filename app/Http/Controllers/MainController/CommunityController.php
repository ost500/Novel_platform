<?php

namespace App\Http\Controllers\MainController;

use App\FreeBoard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function free_board(Request $request)
    {
        $articles = new FreeBoard();
        $search_option = $request->search_option;
        $search_text = $request->search_text;
        if ($search_option == 'title') {
            $articles = $articles->where('title', 'like', '%' . $search_text . '%');
        } else if ($search_option == 'content') {
            $articles = $articles->where('content', 'like', '%' . $search_text . '%');
        }

        $articles = $articles->latest()->with('users')->withCount('comments')->paginate(5);
        $weekly_best = FreeBoard::orderby('week_view_count', 'desc')->latest()->with('users')->withCount('comments')->take(10)->get()
            ->split(2);


//        return response()->json($weekly_best);
        return view('main.community.free_board', compact('articles', 'weekly_best', 'search_option', 'search_text'));
    }
}
