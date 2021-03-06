<?php

namespace App\Http\Controllers\MobileController;

use App\NovelGroupKeyword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Keyword;
use App\NewSpeed;
use App\NewSpeedLog;
use App\Notification;
use App\NovelGroup;
use Auth;
use App\Favorite;
use App\PurchasedNovel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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

        $recently_purchased_novels = PurchasedNovel::where('purchased_novels.user_id', $request->user()->id)
            ->join('novels', 'novels.id', '=', 'purchased_novels.novel_id')
            ->join('novel_groups', 'novels.novel_group_id', '=', 'novel_groups.id')
            ->join('nick_names', 'novel_groups.nickname_id', '=', 'nick_names.id')
            ->join('novel_group_keywords','novel_groups.id','=','novel_group_keywords.novel_group_id')
            ->join('keywords','novel_group_keywords.keyword_id','=','keywords.id')
            ->selectRaw('novel_groups.*, nickname, keywords.name as keyword_name ,novels.id')->groupBy('novel_group_keywords.id','novels.id','novels.novel_group_id')->latest()->take(5)->get();

        //NovelGroupKeyword::whre
        //get recently updated favourite groups of a user
        $recently_updated_favorites = NovelGroup::selectRaw('novel_groups.*,novels.novel_group_id, max(novels.created_at) as new')
            ->join('favorites', 'favorites.novel_group_id', '=', 'novel_groups.id')
            ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
            ->groupBy('novels.novel_group_id')
            ->where('favorites.user_id', $my_profile->id)->with('nicknames')->with('keywords')
            ->orderBy('new', 'desc')->take(5)->get();

        $favorites_count = $my_profile->favorites->count();

        return view('mobile.my_page.index', compact('my_profile', 'recently_purchased_novels', 'recently_updated_favorites', 'favorites_count'));
    }

    public function favorites(Request $request)
    {

        //Make filters
        $keyword_name = $request->get('keyword'); //Filter by keyword
        $filter = $request->get('filter'); //Filter by completed or secret

        if ($filter == 'completed') {
            $condition = [['favorites.user_id', '=', Auth::user()->id], ['novel_groups.completed', '=', 1]];
        } else if ($filter == 'secret') {
            $condition = [['favorites.user_id', '=', Auth::user()->id], ['novel_groups.secret', '<>', null]];
        } else {
            $condition = [['favorites.user_id', '=', Auth::user()->id]];
        }

        if ($keyword_name) {
            //get id from keyword
            $keyword_id = Keyword::select('id')->where('name', $keyword_name)->get();
            //make the condition
            $condition[] = ['novel_group_keywords.keyword_id', '=', $keyword_id[0]->id];
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
        return view('mobile.my_page.favorites', compact('my_favorites', 'keywords', 'query_string', 'keyword_name', 'filter', 'week_gap'));
    }


    public function new_novels(Request $request)
    {

        //get new novels
        $new_novels = NovelGroup::selectRaw('novel_groups.*,novels.novel_group_id,max(novels.created_at) as new')
            ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
            ->groupBy('novels.novel_group_id')
            ->with('nicknames')
            ->orderBy('new', 'desc')->paginate(10)->unique('user_id');

        //get other novels of each author
        $other_novels = array();
        foreach ($new_novels as $novel) {

            $other_novels[$novel->user_id] = NovelGroup::selectRaw('novel_groups.*,novels.novel_group_id,max(novels.created_at) as new')
                ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
                ->groupBy('novels.novel_group_id')
                ->where([['novel_groups.user_id', '=', $novel->user_id], ['novel_groups.id', '<>', $novel->id]])
                ->with('nicknames')
                ->orderBy('new', 'desc')->take(2)->get();
        }
        // return response()->json(['aa'=>$new_novels,'bb'=>$other_novels]);
        return view('mobile.my_page.novel.new_novels', compact('new_novels', 'other_novels'));
    }

    public function new_speed()
    {


        $new_speeds = NewSpeedLog::join('new_speeds', 'new_speeds.id', '=', 'new_speed_logs.new_speed_id')
            ->where('new_speed_logs.user_id', Auth::user()->id)
            ->select('new_speed_logs.user_id', 'new_speed_logs.user_id', 'new_speed_logs.created_at', 'new_speeds.title', 'new_speeds.link', 'new_speeds.image', 'new_speed_logs.id', 'new_speed_logs.read')
            ->latest()
            ->paginate(config('define.pagination_long'));

//        return response()->json($new_novel);

        return view('mobile.my_page.novel.new_speed', compact('new_speeds'));
    }

    public function new_speed_read($id)
    {
        $new_speed_log = NewSpeedLog::find($id);

        $new_speed_log->read = true;
        $new_speed_log->save();

        $link = $new_speed_log->new_speed->link;

        return redirect()->to($link);
    }

}
