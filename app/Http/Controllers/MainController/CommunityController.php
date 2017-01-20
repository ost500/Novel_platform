<?php

namespace App\Http\Controllers\MainController;

use App\FreeBoard;
use App\Http\Controllers\Controller;
use App\Review;
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

        $articles = $articles->latest()->with('users')->withCount('comments')->paginate(config('define.pagination_long'));
        $weekly_best = FreeBoard::orderby('week_view_count', 'desc')->latest()->with('users')->withCount('comments')->take(10)->get()
            ->split(2);


//        return response()->json($weekly_best);
        return view('main.community.free_board', compact('articles', 'weekly_best', 'search_option', 'search_text'));
    }

    public function free_board_detail($id)
    {
        $article = FreeBoard::with('comments.users')->with('likes')->withCount('likes')->withCount('comments')->findOrFail($id);
        $next_article_id = FreeBoard::where('id', '>', $article->id)->min('id');
        $next_article = FreeBoard::with('users')->find($next_article_id);
        $prev_article_id = FreeBoard::where('id', '<', $article->id)->max('id');
        $prev_article = FreeBoard::with('users')->find($prev_article_id);

        //view_count +1
        $article->view_count = $article->view_count + 1;
        $article->save();
//        return response()->json($prev_article);
        return view('main.community.free_board_detail', compact('article', 'next_article', 'prev_article'));
    }

    public function reader_reco(Request $request)
    {
        $reviews = Review::latest()->with('users')->paginate(config('define.pagination_long'));

        $genre = isset($request->genre) ? $request->genre : "%";

        return view('main.community.reader_reco', compact('reviews', 'genre'));
    }
}
