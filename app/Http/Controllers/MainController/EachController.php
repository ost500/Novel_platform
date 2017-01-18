<?php

namespace App\Http\Controllers\MainController;

use App\Favorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\NovelGroup;
use App\Novel;
use Illuminate\Database\Eloquent\Collection;

class EachController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('novel_group_favorite');
    }

    public function novel_group($id)
    {

        $novel_group = NovelGroup::where('id', $id)->with('keywords')->with('novels')->with('nicknames')->first();

         //dd($novel_group->checkUserFavourite($novel_group->id));
        /*$novel_group = NovelGroup::selectRaw('novel_group_id, novel_groups.*, count(novel_group_id) as favourite_count')
            ->join('novels', 'favorites.novel_group_id', '=', 'novel_groups.id')
            ->join('favorites', 'favorites.novel_group_id', '=', 'novel_groups.id')
            ->groupBy('novel_group_id')
            ->where([['novel_groups.user_id', '=', $novel_group->user_id], ['novel_groups.id', '<>', $id]])
            ->orderBy('created_at', 'desc')
            ->get();*/
        $author_novel_groups = NovelGroup::selectRaw('novel_group_id, novel_groups.*, count(novel_group_id) as favorite_count')
            ->join('favorites', 'favorites.novel_group_id', '=', 'novel_groups.id')
            ->groupBy('novel_group_id')
            ->where([['novel_groups.user_id', '=', $novel_group->user_id], ['novel_groups.id', '<>', $id]])
            ->orderBy('created_at', 'desc')
            ->paginate(3);


        // return response()->json($author_novel_groups);

        return view('main.each_novel.novel_group', compact('novel_group', 'author_novel_groups'));
    }


    public function novel_group_inning($id)
    {

        $novel_group_inning = Novel::where('id', $id)->with('comments')->first();
        $novel_group_inning_comments = new Collection();
        foreach ($novel_group_inning->comments as $comment) {
            if ($comment->parent_id == 0) {
                //부모가 없는 댓글들만 불러온다
                $single_comment = $comment->myself;
                $single_comment->put('children', $comment->children);
                //자식들을 달아준다
                $novel_group_inning_comments->push($single_comment);
                //콜렉션에 넣어준다
            }
        }

        return view('main.each_novel.novel_group_inning', compact('novel_group_inning', 'novel_group_inning_comments'));
    }


}
