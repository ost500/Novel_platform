<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use App\Novel;
use App\NovelGroup;
use App\Review;
use App\ViewCount;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function main()
    {
        $recommends = NovelGroup::take(5)->with('nicknames')->get();
//        return response()->json($recommends);
//        $today_best = ViewCount::selectRaw('novel_group_id, novel_groups.*, sum(count) as sum')
//            ->join('novels', 'novels.id', '=', 'novel_id')
//            ->join('novel_groups', 'novel_groups.id', '=', 'novel_group_id')
//            ->where('separation', 1)->groupBy('novel_group_id')->orderBy('sum','desc')
//            ->get();
        $non_free_today_bests = NovelGroup::selectRaw('novel_group_id, novel_groups.*, sum(today_count) as sum, max(non_free_agreement) as non_free')
            ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
            ->groupBy('novel_group_id')->orderBy('sum', 'desc')->havingRaw('max(non_free_agreement) > 0')
            ->with('nicknames')->take(10)->get();
        $free_today_bests = NovelGroup::selectRaw('novel_group_id, novel_groups.*, sum(today_count) as sum, max(non_free_agreement) as non_free')
            ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
            ->groupBy('novel_group_id')->orderBy('sum', 'desc')->havingRaw('max(non_free_agreement) = 0')
            ->with('nicknames')->take(10)->get();

        $latests = NovelGroup::latest()->take(5)->get();

        $reader_reviews = Review::take(6)->with('novels.novel_groups')->get();

        $recommendations = NovelGroup::selectRaw('novel_group_id, novel_groups.*, sum(week_count) as sum, max(non_free_agreement) as non_free')
            ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
            ->groupBy('novel_group_id')->orderBy('sum', 'desc')->havingRaw('max(non_free_agreement) > 0')
            ->with('nicknames')->take(8)->get();

//        return response()->json($reader_reviews);
        return view('main.main', compact('recommends', 'non_free_today_bests', 'free_today_bests', 'latests', 'reader_reviews', 'recommendations'));
    }

    public function series(Request $request, $free_or_charged = false)
    {
        if (!$free_or_charged) {
            //charged
            $novel_groups = NovelGroup::selectRaw('novel_group_id, novel_groups.*, max(novels.created_at) as new, max(non_free_agreement) as non_free')
                ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
                ->groupBy('novel_group_id')->orderBy('new','desc')->havingRaw('max(non_free_agreement) > 0')
                ->with('nicknames')->withCount('novels')->paginate(3);
        } else {
            $novel_groups = NovelGroup::selectRaw('novel_group_id, novel_groups.*, max(novels.created_at) as new, max(non_free_agreement) as non_free')
                ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
                ->groupBy('novel_group_id')->orderBy('new','desc')->havingRaw('max(non_free_agreement) = 0')
                ->with('nicknames')->withCount('novels')->paginate(3);
        }
        return response()->json($novel_groups);
//        return view('main.series', compact('free_or_charged', 'novel_groups'));
    }

    public function bests(Request $request, $free_or_charged = false)
    {
        if (!$free_or_charged) {
            //charged
            $novel_groups = NovelGroup::selectRaw('novel_group_id, novel_groups.*, sum(today_count) as sum, max(non_free_agreement) as non_free')
                ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
                ->groupBy('novel_group_id')->orderBy('sum', 'desc')->havingRaw('max(non_free_agreement) > 0')
                ->with('nicknames')->paginate(10);
        } else {
            $novel_groups = NovelGroup::selectRaw('novel_group_id, novel_groups.*, max(novels.created_at) as new, max(non_free_agreement) as non_free')
                ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
                ->groupBy('novel_group_id')->orderBy('new','desc')->havingRaw('max(non_free_agreement) = 0')
                ->with('nicknames')->withCount('novels')->paginate(3);
        }
        $page = $request->page;
//        return response()->json($novel_groups);
        return view('main.bests', compact('free_or_charged', 'novel_groups','page'));
    }

}
