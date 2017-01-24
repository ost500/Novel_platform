<?php

namespace App\Http\Controllers\MainController;

use App\Keyword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\NovelGroup;
use Auth;
use App\Favorite;

class MyPageController extends Controller
{

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {

        $my_profile = $request->user();
        //get recent groups having non-free novels of a user
        $recently_purchased_novels = NovelGroup::join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
            ->selectRaw('novel_groups.*,novels.updated_at as recent,max(non_free_agreement) as non_free')
            ->groupBy('novel_group_id', 'recent')
            ->havingRaw('max(non_free_agreement) > 0')
            ->with('nicknames')->where('novel_groups.user_id', $my_profile->id)->latest('recent')->take(5)->get();

        //get recently updated favourite groups of a user
        $recently_updated_favorites = NovelGroup::selectRaw('novel_groups.*,novels.novel_group_id,max(novels.created_at) as new')
            ->join('favorites', 'favorites.novel_group_id', '=', 'novel_groups.id')
            ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
            ->groupBy('novels.novel_group_id')
            ->where('favorites.user_id', $my_profile->id)->with('nicknames')
            ->orderBy('new', 'desc')->take(5)->get();

        return view('main.my_page.index', compact('my_profile', 'recently_purchased_novels', 'recently_updated_favorites'));
    }

    public function favorites(Request $request)
    {

        //Make filters
        $keyword_name = $request->get('keyword'); //Filter by keyword
        $filter = $request->get('filter'); //Filter by completed or secret


        if ($filter == 'completed') {
            if ($keyword_name) {
                //get id from keyword
                $keyword_id = Keyword::select('id')->where('name', $keyword_name)->get();
                //make the condition
                $condition = ['favorites.user_id' => Auth::user()->id, 'novel_group_keywords.keyword_id' => $keyword_id[0]->id, 'novel_groups.completed' => 1];
            } else {
                $condition = ['favorites.user_id' => Auth::user()->id, 'novel_groups.completed' => 1];
            }

        } else if ($filter == 'secret') {

            if ($keyword_name) {
                //get id from keyword
                $keyword_id = Keyword::select('id')->where('name', $keyword_name)->get();
                //make the condition
                $condition = [['favorites.user_id', '=', Auth::user()->id], ['novel_groups.secret', '<>', null], ['novel_group_keywords.keyword_id', '=', $keyword_id[0]->id]];
            } else {
                $condition = [['favorites.user_id', '=', Auth::user()->id], ['novel_groups.secret', '<>', null]];

            }
        } else { //for all
            if ($keyword_name) {
                //get id from keyword
                $keyword_id = Keyword::select('id')->where('name', $keyword_name)->get();
                //make the condition
                $condition = ['favorites.user_id' => Auth::user()->id, 'novel_group_keywords.keyword_id' => $keyword_id[0]->id];
            } else {
                $condition = ['favorites.user_id' => Auth::user()->id];
            }
        }


        //get the keywords of first category
        $keywords = Keyword::where('category', 1)->get();

        //get all favorite groups of a user based on recently updated
        $my_favorites = NovelGroup::selectRaw('novel_groups.*,novels.novel_group_id,max(novels.created_at) as new')
            ->join('favorites', 'favorites.novel_group_id', '=', 'novel_groups.id')
            ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
            ->join('novel_group_keywords', 'novel_group_keywords.novel_group_id', '=', 'novel_groups.id')
            ->groupBy('novels.novel_group_id')
            ->where($condition)->with('nicknames')
            ->orderBy('new', 'desc')->paginate(10);

        //calculate the one week gap from today to check new items within 7 days
        $week_gap = Carbon::today()->subDays(7);


        $query_string = '?filter=' . $filter . '&keyword=' . $keyword_name;
        return view('main.my_page.favorites', compact('my_favorites', 'keywords', 'query_string', 'keyword_name', 'filter', 'week_gap'));
    }


    public function new_novels(Request $request)
    {


        $new_novels=NovelGroup::selectRaw('novel_groups.*,novels.novel_group_id,max(novels.created_at) as new')
            ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
            ->groupBy('novels.novel_group_id')
            ->with('nicknames')
            ->orderBy('new', 'desc')->paginate(10);

        return view('main.my_page.novel.new_novels',compact('new_novels'));
    }




}




