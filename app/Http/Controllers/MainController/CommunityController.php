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

        $page = $request->page;

//        return response()->json($weekly_best);
        return view('main.community.free_board', compact('articles', 'weekly_best', 'search_option', 'search_text', 'page'));
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
        $reviews = Review::selectRaw('reviews.*, novel_groups.*, sum(total_count) as total_count, reviews.id')
            ->join('novel_groups', 'novel_groups.id', '=', 'reviews.novel_group_id')
            ->join('novels', 'novel_groups.id', '=', 'novels.novel_group_id')
            ->groupBy('reviews.id')->orderBy('reviews.created_at', 'desc')
            ->with('users');

        $search_option = $request->search_option;
        $search_text = $request->search_text;

        if ($search_option == 'title') {
            $reviews = $reviews->where('reviews.title', 'like', '%' . $search_text . '%');
        } else if ($search_option == 'content') {
            $reviews = $reviews->where('review', 'like', '%' . $search_text . '%');
        }


        //genre
        $genre = isset($request->genre) ? $request->genre : "%";

        $reviews = $reviews->whereHas('novel_groups.keywords', function ($q) use ($genre) {
            $q->where('name', 'like', $genre);
        });

        $reviews = $reviews->paginate(3);


//        return response()->json($reviews);
        return view('main.community.reader_reco', compact('reviews', 'genre', 'search_option', 'search_text', 'page'));
    }

    public function reader_reco_detail($id)
    {
        $review = Review::findOrFail($id);
        $review->view_count = $review->view_count + 1;
        $review->save();

        $review = Review::with('novel_groups.keywords')->with('novel_groups.favorites')->with('users')->with('comments.users')
            ->join('novel_groups', 'novel_groups.id', '=', 'reviews.novel_group_id')
            ->join('novels', 'novel_groups.id', '=', 'novels.novel_group_id')
            ->join('favorites', 'novel_groups.id', '=', 'favorites.novel_group_id')
            ->selectRaw('reviews.id as review_id, reviews.*, reviews.title as review_title, novel_groups.*, sum(total_count) as total_count, reviews.id')
            ->where('reviews.id', $id)
            ->groupBy('reviews.id')->get()[0];

        $next_review_id = Review::where('id', '>', $review->review_id)->min('id');
        $next_review = Review::with('users')->find($next_review_id);
        $prev_review_id = Review::where('id', '<', $review->review_id)->max('id');
        $prev_review = Review::with('users')->find($prev_review_id);

//        return response()->json($review);
//        return response()->json($prev_review);
//        return response()->json($review->id);
        return view('main.community.reader_reco_detail', compact('review', 'next_review', 'prev_review'));
    }
}
