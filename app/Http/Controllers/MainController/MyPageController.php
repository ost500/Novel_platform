<?php

namespace App\Http\Controllers\MainController;

use App\Keyword;
use App\NewSpeed;
use App\NewSpeedLog;
use App\Notification;

use App\NovelGroupNotification;
use App\PurchasedNovel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\NovelGroup;
use Auth;
use App\Favorite;
use Jenssegers\Agent\Agent;

class MyPageController extends Controller
{

    /**
     * Create a new controller instance.
     *
     */
    var $agent;

    public function __construct()
    {
        $this->middleware('auth');
        $this->agent = new Agent();
    }


    public function index(Request $request)
    {

        $my_profile = $request->user();
        //get recent groups having non-free novels of a user

        $recently_purchased_novels = PurchasedNovel::where('purchased_novels.user_id', $request->user()->id)
            ->join('novels', 'novels.id', '=', 'purchased_novels.novel_id')
            ->join('novel_groups', 'novels.novel_group_id', '=', 'novel_groups.id')
            ->join('nick_names', 'novel_groups.nickname_id', '=', 'nick_names.id')
            ->join('novel_group_keywords', 'novel_groups.id', '=', 'novel_group_keywords.novel_group_id')
            ->join('keywords', 'novel_group_keywords.keyword_id', '=', 'keywords.id')
            ->selectRaw('novel_groups.*, nickname, keywords.name as keyword_name, novels.id')->groupBy('novel_group_keywords.id', 'novels.id', 'novels.novel_group_id')->latest()->take(5)->get();

        //get recently updated favourite groups of a user
        $recently_updated_favorites = NovelGroup::selectRaw('novel_groups.*,novels.novel_group_id,max(novels.created_at) as new')
            ->join('favorites', 'favorites.novel_group_id', '=', 'novel_groups.id')
            ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
            ->groupBy('novels.novel_group_id')
            ->where('favorites.user_id', $my_profile->id)->with('nicknames')->with('keywords')
            ->orderBy('new', 'desc')->take(5)->get();

        $favorites_count = $my_profile->favorites->count();

        //Detect mobile
        if ($this->agent->isMobile()) {
            return view('mobile.my_page.index', compact('my_profile', 'recently_purchased_novels', 'recently_updated_favorites', 'favorites_count'));
        }

        return view('main.my_page.index', compact('my_profile', 'recently_purchased_novels', 'recently_updated_favorites', 'favorites_count'));
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


        //get all favorite groups of a user based on recently updated
        $my_favorites = NovelGroup::selectRaw('novel_groups.*,novels.novel_group_id,max(novels.created_at) as new')
            ->join('favorites', 'favorites.novel_group_id', '=', 'novel_groups.id')
            ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
            ->join('novel_group_keywords', 'novel_group_keywords.novel_group_id', '=', 'novel_groups.id')
            ->groupBy('novels.novel_group_id')
            ->where($condition)->with('nicknames')
            ->orderBy('new', 'desc');

        $option = isset($request->option) ? $request->option : false;
        if ($option == "현대로맨스" or $option == "시대로맨스" or $option == "로맨스판타지") {

            $optionArr = "";
            if ($option == "현대로맨스") {
                $optionArr = ['현대', '현대판타지'];
            } else if ($option == "시대로맨스") {
                $optionArr = ['시대', '사극', '동양판타지'];
            } else if ($option == "로맨스판타지") {
                $optionArr = ['서양역사', '로맨스판타지'];
            }

            //option is equal to keyword
            //get id from keyword
            $keyword_id = Keyword::select('id')->where(function ($q) use ($optionArr) {
                $q->whereIn('name', $optionArr);
            })->get();

            //make the condition
            // $condition[] = ['novel_group_keywords.keyword_id', '=', $keyword_id];

            $my_favorites = $my_favorites->where(function ($q) use ($keyword_id) {
                $q->whereIn('novel_group_keywords.keyword_id', $keyword_id);
            });
        }

        $my_favorites = $my_favorites->paginate(config('define.pagination_long'));

        //calculate the one week gap from today to check new items within 7 days
        $week_gap = Carbon::today()->subDays(7);


        $query_string = '?filter=' . $filter . '&option=' . $option;
        //Detect mobile
        if ($this->agent->isMobile()) {
            return view('mobile.my_page.favorites', compact('my_favorites', 'keywords', 'query_string', 'option', 'filter', 'week_gap'));
        }
        return view('main.my_page.favorites', compact('my_favorites', 'keywords', 'query_string', 'option', 'filter', 'week_gap'));
    }


    public function new_novels(Request $request)
    {
        //Get the authors who's novel groups are users favorite
        $authors = NovelGroupNotification::select('novel_groups.user_id', 'users.nickname')->join('novel_groups', 'novel_groups.id', '=', 'novel_group_notifications.novel_group_id')
            ->join('users', 'users.id', '=', 'novel_groups.user_id')
            ->where('novel_group_notifications.user_id', Auth::User()->id)
            ->distinct('user_id')->get();

        //get notifications for each author
        $notifications = array();
        foreach ($authors as $author) {
            $notifications[$author->user_id] = NovelGroupNotification::select('novel_group_notifications.id as novel_group_notification_id', 'novel_group_notifications.created_at as notification_date', 'novel_groups.*')
                ->join('novel_groups', 'novel_groups.id', '=', 'novel_group_notifications.novel_group_id')
                ->where(['novel_group_notifications.user_id' => Auth::User()->id, 'novel_groups.user_id' => $author->user_id])
                ->orderBy('notification_date', 'desc')->get();
        }


        //return response()->json(['aa'=>$new_novels,'bb'=>$other_novels]);

        //Detect mobile
        if ($this->agent->isMobile()) {
            return view('mobile.my_page.novel.new_novels', compact('new_novels', 'other_novels'));
        }
        return view('main.my_page.novel.new_novels', compact('authors', 'notifications'));
    }

    public function new_speed()
    {


        $new_speeds = NewSpeedLog::join('new_speeds', 'new_speeds.id', '=', 'new_speed_logs.new_speed_id')
            ->where('new_speed_logs.user_id', Auth::user()->id)
            ->select('new_speed_logs.user_id', 'new_speed_logs.user_id', 'new_speed_logs.created_at', 'new_speeds.title', 'new_speeds.link', 'new_speeds.image', 'new_speed_logs.id', 'new_speed_logs.read')
            ->latest()
            ->paginate(config('define.pagination_long'));

//        return response()->json($new_novel);
        //Detect mobile
        if ($this->agent->isMobile()) {
            return view('mobile.my_page.novel.new_speed', compact('new_speeds'));
        }
        return view('main.my_page.novel.new_speed', compact('new_speeds'));
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




