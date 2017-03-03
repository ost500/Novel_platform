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


        if ($genre == "����θǽ�") {
            $genreArr = ['����', '������Ÿ��'];
        } else if ($genre == "�ô�θǽ�") {
            $genreArr = ['�ô�', '���', '������Ÿ��'];
        } else if ($genre == "�θǽ���Ÿ��") {
            $genreArr = ['���翪��', '�θǽ���Ÿ��'];
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
//        [����Ʈ ���� ����]
//      ������: 24�ð� ���� �� �Խ��ǿ��� ���� ��ȸ���� ���� ���� 1�� ȸ���� ��º��� �ջ�
//      �ְ�: 7�� ���� �� �Խ��ǿ��� ���� ��ȸ���� ���� ���� 7�� ȸ���� ��º��� �ջ�
//      ����: 30�� ���� �� �Խ��ǿ��� ���� ��ȸ���� ���� ���� 30�� ȸ���� ��º��� �ջ�, �� 15�� �̳� ��ϵ� ȸ�� ����.
//      ���׵�: 1�� ���� �� �Խ��ǿ��� ���� ��ȸ���� ���� ���� 30�� ȸ���� ��º��� �ջ�, �� �̿ϰ��� ����, �ֱ� 3���� �̳� ��ϵ� ȸ�� ����
//      �帣��: �����̺���Ʈ����, Ÿ�帣 ����
//      �ϰ�: ��������Ʈ����, �̿ϰ���ǰ�� ������ �ϰ�� ��ǰ�� �����ǵ���.

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
        } else if ($option == "����θǽ�" or $option == "�ô�θǽ�" or $option == "�θǽ���Ÿ��") {

            $optionArr = "";
            if ($option == "����θǽ�") {
                $optionArr = ['����', '������Ÿ��'];
            } else if ($option == "�ô�θǽ�") {
                $optionArr = ['�ô�', '���', '������Ÿ��'];
            } else if ($option == "�θǽ���Ÿ��") {
                $optionArr = ['���翪��', '�θǽ���Ÿ��'];
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
//        return response()->json($novel_groups);
        return view('mobile.bests', compact('free_or_charged', 'novel_groups', 'page', 'period', 'option', 'keywords'));
    }
}
