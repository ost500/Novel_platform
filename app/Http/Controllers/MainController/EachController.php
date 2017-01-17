<?php

namespace App\Http\Controllers\MainController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\NovelGroup;

class EachController extends Controller
{
    public function novel_group($id)
    {

        $novel_group = NovelGroup::where('id', $id)->with('novels')->with('nicknames')->first();
        /*$novel_group = NovelGroup::selectRaw('novel_group_id, novel_groups.*, count(novel_group_id) as favourite_count')
            ->join('novels', 'favorites.novel_group_id', '=', 'novel_groups.id')
            ->join('favorites', 'favorites.novel_group_id', '=', 'novel_groups.id')
            ->groupBy('novel_group_id')
            ->where([['novel_groups.user_id', '=', $novel_group->user_id], ['novel_groups.id', '<>', $id]])
            ->orderBy('created_at', 'desc')
            ->get();*/

      //  $author_novel_groups =NovelGroup::with('favorites' )->where('user_id',$novel_group->user_id)->where('id','<>', $id)->get();
        //foreach($author_novel_groups as $author_novel_group){ echo count($author_novel_group->favorites);  }
       $author_novel_groups = NovelGroup::selectRaw('novel_group_id, novel_groups.*, count(novel_group_id) as favourite_count')
            ->join('favorites', 'favorites.novel_group_id', '=', 'novel_groups.id')
            ->groupBy('novel_group_id')
            ->where([['novel_groups.user_id', '=', $novel_group->user_id], ['novel_groups.id', '<>', $id]])
            ->orderBy('created_at', 'desc')
            ->get();
       // return response()->json($author_novel_groups);

        return view('main.each_novel.novel_group', compact('novel_group', 'author_novel_groups'));
    }
}
