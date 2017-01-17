<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use App\Novel;
use App\NovelGroup;
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
        $today_best = NovelGroup::selectRaw('novel_group_id, novel_groups.*, sum(today_count) as sum, max(non_free_agreement) as non_free')
            ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
            ->groupBy('novel_group_id')->orderBy('sum', 'desc')->havingRaw('max(non_free_agreement) > 0')
            ->get();
//        return response()->json($today_best);
        return view('main.main', compact('recommends', 'today_best'));
    }
}
