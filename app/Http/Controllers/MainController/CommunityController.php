<?php

namespace App\Http\Controllers\MainController;

use App\FreeBoard;
use App\FreeBoardLike;
use App\Http\Controllers\Controller;
use App\Keyword;
use App\NovelGroup;
use App\Review;
use Illuminate\Http\Request;
use Auth;
use Jenssegers\Agent\Agent;
use Illuminate\Database\Eloquent\Collection;

class CommunityController extends Controller
{

    var $agent;

    public function __construct()
    {
        $this->agent = new Agent();
        $this->middleware('auth')->only('free_board_detail_auth');
    }

    public function free_board(Request $request)
    {
        $articles = new FreeBoard();
        $search_option = $request->search_option;
        $search_text = $request->search_text;
        if ($search_option == 'title') {
            $articles = $articles->where('title', 'like', '%' . $search_text . '%');
        } else if ($search_option == 'content') {
            $articles = $articles->where('content', 'like', '%' . $search_text . '%');
        } else if ($search_option == 'nickname') {
            $articles = $articles->whereHas('users', function ($q) use ($search_text) {
                $q->where('nickname', 'like', '%' . $search_text . '%');
            });
        }

        $articles = $articles->latest()->with('users')->withCount('comments')->paginate(config('define.pagination_long'));
        $weekly_best = FreeBoard::orderby('week_view_count', 'desc')->latest()->with('users')->withCount('comments')->take(10)->get()
            ->split(2);

        $page = $request->page;

//        return response()->json($weekly_best);

        //Detect mobile
        if ($this->agent->isMobile()) {
            return view('mobile.community.free_board', compact('articles', 'weekly_best', 'search_option', 'search_text', 'page'));

        }
        return view('main.community.free_board', compact('articles', 'weekly_best', 'search_option', 'search_text', 'page'));
    }

    public function free_board_detail_auth($id)
    {
        return redirect()->route('free_board.detail', ['id' => $id]);
    }

    public function free_board_detail(Request $request, $id)
    {

        $order = $request->get('order');
        $article = FreeBoard::with(['comments' => function ($q) use ($order) {
            if ($order == 'oldest') {
                $q->oldest();
            } else {
                $q->latest();
            }
        }, 'comments.users'])->with('likes')->withCount('likes')->withCount('comments')->findOrFail($id);
        $next_article_id = FreeBoard::where('id', '>', $article->id)->min('id');
        $next_article = FreeBoard::with('users')->find($next_article_id);
        $prev_article_id = FreeBoard::where('id', '<', $article->id)->max('id');
        $prev_article = FreeBoard::with('users')->find($prev_article_id);

        //view_count +1
        $article->view_count = $article->view_count + 1;
        $article->week_view_count = $article->week_view_count + 1;
        $article->save();
        $show_liked = false;
        if (Auth::check()) {
            //check if this free_board is liked by user or not
            $liked = FreeBoardLike::where(['free_board_id' => $article->id, 'user_id' => Auth::user()->id])->first();
            if ($liked) {
                $show_liked = true;
            }
        }
//dd($article);
        //get the all comments of a novel
        $article_comments = new Collection();
        foreach ($article->comments as $comment) {
            if ($comment->parent_id == 0) {
                $single_comment = $comment->myself;
                $single_comment->put('children', $comment->children);
                $article_comments->push($single_comment);
            }
        }
        //Detect mobile
        if ($this->agent->isMobile()) {
            return view('mobile.community.free_board_detail', compact('article', 'next_article', 'prev_article', 'show_liked', 'order', 'article_comments'));

        }

        return view('main.community.free_board_detail', compact('article', 'next_article', 'prev_article', 'show_liked', 'order', 'article_comments'));
    }


    public function free_board_write(Request $request)
    {
        //Detect mobile
        if ($this->agent->isMobile()) {
            return view('mobile.community.free_board_write');
        }
        return view('main.community.free_board_write');
    }

    public function free_board_edit($id)
    {
        $free_board = FreeBoard::find($id);
        //Detect mobile
        if ($this->agent->isMobile()) {
            return view('mobile.community.free_board_edit', compact('free_board'));
        }
        return view('main.community.free_board_edit', compact('free_board'));
    }

    public function reader_reco_edit($id)
    {
        $reader_reco = Review::find($id);
        //Detect mobile
        if ($this->agent->isMobile()) {
            return view('mobile.community.reader_reco_edit', compact('reader_reco'));
        }
        return view('main.community.reader_reco_edit', compact('reader_reco'));
    }


    public function reader_reco(Request $request)
    {
        $novel_group_id = $request->novel_group;
        $review_user_id = $request->review_user;
        if ($request->novel_group) {
            //이 소설의 다른 추천 보기
            $reviews = Review::selectRaw('reviews.*, novel_groups.*, reviews.title as review_title, sum(total_count) as total_count, reviews.id,reviews.user_id')
                ->join('novel_groups', 'novel_groups.id', '=', 'reviews.novel_group_id')
                ->join('novels', 'novel_groups.id', '=', 'novels.novel_group_id')
                ->join('novel_group_keywords', 'novel_group_keywords.novel_group_id', '=', 'novel_groups.id')
                ->groupBy('reviews.id', 'reviews.user_id')->where(['novel_groups.secret' => null, 'reviews.novel_group_id' => $novel_group_id])->orderBy('reviews.created_at', 'desc')
                ->with('users');

        } elseif ($request->review_user) {
            // 작성자의 다른 추천 보기
            $reviews = Review::selectRaw('reviews.*, novel_groups.*, reviews.title as review_title, users.name as user_name, sum(total_count) as total_count, reviews.id,reviews.user_id')
                ->join('novel_groups', 'novel_groups.id', '=', 'reviews.novel_group_id')
                ->join('novels', 'novel_groups.id', '=', 'novels.novel_group_id')
                ->join('users', 'users.id', '=', 'reviews.user_id')
                ->join('novel_group_keywords', 'novel_group_keywords.novel_group_id', '=', 'novel_groups.id')
                ->groupBy('reviews.id', 'reviews.user_id')->where(['novel_groups.secret' => null, 'reviews.user_id' => $review_user_id])->orderBy('reviews.created_at', 'desc')
                ->with('users');
        } else {

            $reviews = Review::selectRaw('reviews.*, novel_groups.*, reviews.title as review_title, sum(total_count) as total_count, reviews.id,reviews.user_id')
                ->join('novel_groups', 'novel_groups.id', '=', 'reviews.novel_group_id')
                ->join('novels', 'novel_groups.id', '=', 'novels.novel_group_id')
                ->join('novel_group_keywords', 'novel_group_keywords.novel_group_id', '=', 'novel_groups.id')
                ->groupBy('reviews.id', 'reviews.user_id')->where('novel_groups.secret', null)->orderBy('reviews.created_at', 'desc')
                ->with('users');
        }


        $search_option = $request->search_option;
        $search_text = $request->search_text;

        if ($search_option == 'title') {
            $reviews = $reviews->where('reviews.title', 'like', '%' . $search_text . '%');
        } else if ($search_option == 'content') {
            $reviews = $reviews->where('review', 'like', '%' . $search_text . '%');
        } else if ($search_option == 'nickname') {
            $reviews = $reviews->whereHas('users', function ($q) use ($search_text) {
                $q->where('nickname', 'like', '%' . $search_text . '%');
            });
        }


        //genre
        $genre = isset($request->genre) ? $request->genre : "%";

        if ($genre == "현대로맨스" or $genre == "시대로맨스" or $genre == "로맨스판타지") {

            $genreArr = "";
            if ($genre == "현대로맨스") {
                $genreArr = ['현대', '현대판타지'];
            } else if ($genre == "시대로맨스") {
                $genreArr = ['시대', '사극', '동양판타지'];
            } else if ($genre == "로맨스판타지") {
                $genreArr = ['서양역사', '로맨스판타지'];
            }

            //genre is equal to keyword
            //get id from keyword
            $keyword_id = Keyword::select('id')->where(function ($q) use ($genreArr) {
                $q->whereIn('name', $genreArr);
            })->get();

            //make the condition
            $reviews = $reviews->where(function ($q) use ($keyword_id) {
                $q->whereIn('novel_group_keywords.keyword_id', $keyword_id);
            });
        }


        $reviews = $reviews->paginate(config('define.pagination_long'));


        // return response()->json($reviews);
        //Detect mobile
        if ($this->agent->isMobile()) {
            return view('mobile.community.reader_reco', compact('reviews', 'genre', 'search_option', 'search_text', 'page', 'novel_group_id', 'review_user_id'));
        }

        return view('main.community.reader_reco', compact('reviews', 'genre', 'search_option', 'search_text', 'page', 'novel_group_id', 'review_user_id'));
    }


    public function reader_reco_detail(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $review->view_count = $review->view_count + 1;
        $review->save();

        $order = $request->get('order');

        $review = Review::with('novel_groups.keywords')->with('novel_groups.favorites')->with('novel_groups.users')->with('users')->with(['comments' => function ($q) use ($order) {
            if ($order == 'oldest') {
                $q->oldest();
            } else {
                $q->latest();
            }
        }, 'comments.users'])
            ->join('novel_groups', 'novel_groups.id', '=', 'reviews.novel_group_id')
            ->join('novels', 'novel_groups.id', '=', 'novels.novel_group_id')
//            ->join('favorites', 'novel_groups.id', '=', 'favorites.novel_group_id')
            ->selectRaw('reviews.id as review_id, reviews.*, reviews.title as review_title, sum(total_count) as total_count, reviews.id')
            ->where('reviews.id', $id)
            ->groupBy('reviews.id')->first();

        $next_review_id = Review::where('id', '>', $review->review_id)->min('id');
        $next_review = Review::with('users')->find($next_review_id);
        $prev_review_id = Review::where('id', '<', $review->review_id)->max('id');
        $prev_review = Review::with('users')->find($prev_review_id);

        if (!$review->novel_groups->keywords->isEmpty()) {
            $genre = $review->novel_groups->keywords[0]->name;
        }

        //get the all comments of a novel
        $review_comments = new Collection();
        foreach ($review->comments as $comment) {
            if ($comment->parent_id == 0) {
                $single_comment = $comment->myself;
                $single_comment->put('children', $comment->children);
                $review_comments->push($single_comment);
            }
        }

        $show_favorite = false;
        if (Auth::check()) {
            //check if this novel_group is user's favorite or not
            $show_favorite = NovelGroup::find($review->novel_group_id)->checkUserFavourite($review->novel_group_id);
        }
        //Detect mobile
        if ($this->agent->isMobile()) {
            return view('mobile.community.reader_reco_detail', compact('review', 'next_review', 'prev_review', 'genre', 'order', 'review_comments', 'show_favorite'));
        }
        return view('main.community.reader_reco_detail', compact('review', 'next_review', 'prev_review', 'genre', 'order', 'review_comments', 'show_favorite'));
    }

}
