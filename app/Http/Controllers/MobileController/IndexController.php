<?php

namespace App\Http\Controllers\MobileController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\NovelGroup;
use App\Review;
use App\Notification;
use App\Keyword;
use Carbon\Carbon;


class IndexController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recommends = NovelGroup::take(3)->where('secret', null)->with('nicknames')->get();
//        return response()->json($recommends);
//        $today_best = ViewCount::selectRaw('novel_group_id, novel_groups.*, sum(count) as sum')
//            ->join('novels', 'novels.id', '=', 'novel_id')
//            ->join('novel_groups', 'novel_groups.id', '=', 'novel_group_id')
//            ->where('separation', 1)->groupBy('novel_group_id')->orderBy('sum','desc')
//            ->get();
        $non_free_today_bests = NovelGroup::selectRaw('novel_group_id, novel_groups.*, sum(today_count) as sum, max(non_free_agreement) as non_free')
            ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
            ->groupBy('novel_group_id')->where('secret', null)->orderBy('sum', 'desc')->havingRaw('max(non_free_agreement) > 0')
            ->with('nicknames')->take(5)->get();
        $free_today_bests = NovelGroup::selectRaw('novel_group_id, novel_groups.*, sum(today_count) as sum, max(non_free_agreement) as non_free')
            ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
            ->groupBy('novel_group_id')->where('secret', null)->orderBy('sum', 'desc')->havingRaw('max(non_free_agreement) = 0')
            ->with('nicknames')->take(5)->get();

        $latests = NovelGroup::where('secret', null)->latest()->take(5)->get();

        //$reader_reviews = Review::take(6)->with('novel_groups')->get();
        $reader_reviews = Review::selectRaw('reviews.*')
            ->join('novel_groups', 'reviews.novel_group_id', '=', 'novel_groups.id')
            ->where('secret', null)->take(5)->get();

        $recommendations = NovelGroup::selectRaw('novel_group_id, novel_groups.*, sum(week_count) as sum, max(non_free_agreement) as non_free')
            ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
            ->groupBy('novel_group_id')->where('secret', null)->orderBy('sum', 'desc')->havingRaw('max(non_free_agreement) > 0')
            ->with('nicknames')->take(8)->get();

        $notification_popups = Notification::where('popup', true)->latest()->get();

        //when it has to be logged in
        $login = $request->login;
        $loginView = $request->loginView;
//        return response()->json($reader_reviews);
        return view('mobile.index', compact('recommends', 'non_free_today_bests', 'free_today_bests', 'latests', 'reader_reviews', 'recommendations', 'login', 'loginView', 'notification_popups'));
    }

    public function series(Request $request, $free_or_charged = false)
    {

        if (!$free_or_charged) {
            //charged
            $novel_groups = NovelGroup::selectRaw('novel_group_id, novel_groups.*, max(novels.created_at) as new, max(non_free_agreement) as non_free, sum(total_count) as total_count')
                ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
                ->where([['completed', '=', 0], ['secret', '=', null]])
                ->groupBy('novel_group_id')->havingRaw('max(non_free_agreement) > 0');

        } else {
            //free
            $novel_groups = NovelGroup::selectRaw('novel_group_id, novel_groups.*, max(novels.created_at) as new, max(non_free_agreement) as non_free, sum(total_count) as total_count')
                ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
                ->where([['completed', '=', 0], ['secret', '=', null]])
                ->groupBy('novel_group_id')->havingRaw('max(non_free_agreement) = 0');

        }


        //genre
        $genre = isset($request->genre) ? $request->genre : '%';


        if ($genre == "현대로맨스") {
            $genreArr = ['현대', '현대판타지'];
        } else if ($genre == "시대로맨스") {
            $genreArr = ['시대', '사극', '동양판타지'];
        } else if ($genre == "로맨스판타지") {
            $genreArr = ['서양역사', '로맨스판타지'];
        } else {
            $genreArr = ["%"];
        }


        $novel_groups->whereHas('keywords', function ($q) use ($genreArr, $genre) {
            if ($genre == "%") {
                //if it is all
                $q->where('name', 'like', '%');
            } else {
                //if it is not all
                $q->WhereIn('name', $genreArr);
            }
        });


        //order
        $order = $request->order;
        if ($order == "view") {
            $novel_groups = $novel_groups->orderBy('total_count', 'desc');
        } elseif ($order == "favorite") {
            $novel_groups = $novel_groups->withCount('favorites');
            $novel_groups = $novel_groups->orderBy('favorites_count', 'desc');
        } else {
            $novel_groups = $novel_groups->orderBy('new', 'desc');
        }

        //nickname, keyword, novels_count
        $novel_groups = $novel_groups->with('nicknames')->with('keywords')->withCount('novels')->paginate(config('define.pagination_long'));
//        return response()->json($novel_groups);
        return view('mobile.series', compact('free_or_charged', 'novel_groups', 'genre', 'order'));
    }

    public function bests(Request $request, $free_or_charged = false)
    {
//        [베스트 산정 수식]
//      투데이: 24시간 동안 각 게시판에서 가장 조회수가 많이 오른 1개 회차의 상승분을 합산
//      주간: 7일 동안 각 게시판에서 가장 조회수가 많이 오른 7개 회차의 상승분을 합산
//      월간: 30일 동안 각 게시판에서 가장 조회수가 많이 오른 30개 회차의 상승분을 합산, 단 15일 이내 등록된 회차 제외.
//      스테디: 1년 동안 각 게시판에서 가장 조회수가 많이 오른 30개 회차의 상승분을 합산, 단 미완결작 제외, 최근 3개월 이내 등록된 회차 제외
//      장르별: 투데이베스트에서, 타장르 제외
//      완결: 월간베스트에서, 미완결작품은 빠지고 완결된 작품만 나열되도록.

        $period = isset($request->period) ? $request->period : 'today_count';

        if (!$free_or_charged) {
            //charged
            $novel_groups = NovelGroup::selectRaw('novels.novel_group_id, novel_groups.*, max(novels.created_at) as new, sum(' . $period . ') as view_count, max(non_free_agreement) as non_free, sum(today_count) as total_count')
                ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
                ->join('novel_group_keywords', 'novel_group_keywords.novel_group_id', '=', 'novel_groups.id')
                ->groupBy('novels.novel_group_id')
                ->where('secret', null)
                ->orderBy('view_count', 'desc')
                ->havingRaw('max(non_free_agreement) > 0');
        } else {
            $novel_groups = NovelGroup::selectRaw('novels.novel_group_id, novel_groups.*, max(novels.created_at) as new, sum(' . $period . ') as view_count, max(non_free_agreement) as non_free, sum(today_count) as total_count')
                ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
                ->join('novel_group_keywords', 'novel_group_keywords.novel_group_id', '=', 'novel_groups.id')
                ->groupBy('novels.novel_group_id')
                ->where('secret', null)
                ->orderBy('view_count', 'desc')
                ->havingRaw('max(non_free_agreement) = 0');
            //havingRaw max(non_free_agreement) == 0 means it's free
        }

        //get the keywords of first category
        $keywords = Keyword::where('category', 1)->get();

        $option = isset($request->option) ? $request->option : false;


        if ($option == "steady") {
            $three_month_before = Carbon::today()->subMonth(3)->format('Ymd');
            $novel_groups = $novel_groups->havingRaw("min(novels.created_at)  < '" . $three_month_before . "'");
        } else if ($option == "completed") {
            //completed
            $novel_groups = $novel_groups->where('completed', 1);
        } else if ($option == "현대로맨스" or $option == "시대로맨스" or $option == "로맨스판타지") {

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
            $novel_groups = $novel_groups->where(function ($q) use ($keyword_id) {
                $q->whereIn('novel_group_keywords.keyword_id', $keyword_id);
            });

        }


        $page = isset($request->page) ? $request->page : '1';
//        $novel_groups = $novel_groups->toSql();
//        echo $novel_groups;
        $novel_groups = $novel_groups->with('nicknames')->with('keywords')->withCount('novels')->paginate(config('define.pagination_long'));

//        echo $keyword_id[0]->id;
      //return response()->json($novel_groups);
        return view('mobile.bests', compact('free_or_charged', 'novel_groups', 'page', 'period', 'option', 'keywords'));
    }

    public function completed(Request $request, $free_or_charged = false)
    {

        if (!$free_or_charged) {
            //charged
            $novel_groups = NovelGroup::selectRaw('novel_group_id, novel_groups.*, max(novels.created_at) as new, max(non_free_agreement) as non_free, sum(total_count) as total_count')
                ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
                ->where([['completed', '=', 1], ['secret', '=', null]])
                ->groupBy('novel_group_id')->havingRaw('max(non_free_agreement) > 0');

        } else {
            //free
            $novel_groups = NovelGroup::selectRaw('novel_group_id, novel_groups.*, max(novels.created_at) as new, max(non_free_agreement) as non_free, sum(total_count) as total_count')
                ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
                ->where([['completed', '=', 1], ['secret', '=', null]])
                ->groupBy('novel_group_id')->havingRaw('max(non_free_agreement) = 0');

        }

        //genre
        $genre = isset($request->genre) ? $request->genre : '%';


        if ($genre == "현대로맨스") {
            $genreArr = ['현대', '현대판타지'];
        } else if ($genre == "시대로맨스") {
            $genreArr = ['시대', '사극', '동양판타지'];
        } else if ($genre == "로맨스판타지") {
            $genreArr = ['서양역사', '로맨스판타지'];
        } else {
            $genreArr = ["%"];
        }


        $novel_groups->whereHas('keywords', function ($q) use ($genreArr, $genre) {
            if ($genre == "%") {
                //if it is all
                $q->where('name', 'like', '%');
            } else {
                //if it is not all
                $q->WhereIn('name', $genreArr);
            }
        });

        //order
        $order = $request->order;
        if ($order == "view") {
            $novel_groups = $novel_groups->orderBy('total_count', 'desc');
        } elseif ($order == "favorite") {
            $novel_groups = $novel_groups->withCount('favorites');
            $novel_groups = $novel_groups->orderBy('favorites_count', 'desc');
        } else {
            $novel_groups = $novel_groups->orderBy('new', 'desc');
        }

        //nickname, keyword, novels_count
        $novel_groups = $novel_groups->with('nicknames')->with('keywords')->withCount('novels')->paginate(config('define.pagination_long'));
//        return response()->json($novel_groups);
        return view('mobile.completed', compact('free_or_charged', 'novel_groups', 'genre', 'order'));
    }

}
