<?php

namespace App\Http\Controllers\MainController;

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
        //get recent groups having non-free novels of a user
        $recently_purchased = NovelGroup::join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
            ->selectRaw('novel_groups.*,novels.updated_at as recent,max(non_free_agreement) as non_free')
            ->groupBy('novel_group_id','recent')->havingRaw('max(non_free_agreement) > 0')
            ->with('nicknames')->where('novel_groups.user_id',Auth::user()->id)->latest('recent')->take(5)->get();

        //get recently updated favourite groups of a user
     /*   $recently_favorite_updated= NovelGroup::join('favorites', 'favorites.novel_group_id', '=', 'novel_groups.id')
            ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
            ->selectRaw('novel_groups.*,novels.updated_at as recent')
            ->groupBy('novels.novel_group_id','favorites.novel_group_id','recent')
            ->where([['favorites.user_id','=',Auth::user()->id]])->latest('recent')->orderBy('updated_at')->take(5)->get();*/

        $recently_favorite_updated= Favorite::join('novel_groups', 'favorites.novel_group_id', '=', 'novel_groups.id')
            ->where([['favorites.user_id','=',Auth::user()->id]])->latest('novel_groups.updated_at')->take(5)->get();

        return view('main.my_page.index',compact('recently_purchased','recently_favorite_updated'));
    }
    public function favourites(Request $request)
    {
        return view('main.my_page.favourites');
    }
}
