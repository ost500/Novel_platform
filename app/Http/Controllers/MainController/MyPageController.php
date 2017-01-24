<?php

namespace App\Http\Controllers\MainController;

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

    public function favourites(Request $request)
    {

        //get all favourite groups of a user based on recently updated
        $my_favorites = NovelGroup::selectRaw('novel_groups.*,novels.novel_group_id,max(novels.created_at) as new')
            ->join('favorites', 'favorites.novel_group_id', '=', 'novel_groups.id')
            ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
            ->groupBy('novels.novel_group_id')
            ->where('favorites.user_id', Auth::user()->id)->with('nicknames')
            ->orderBy('new', 'desc')->paginate(10);

        return view('main.my_page.favourites', compact('my_favorites'));
    }
}
