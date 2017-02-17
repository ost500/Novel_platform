<?php

namespace App\Http\Controllers\MainController;

use App\Favorite;
use App\RecentlyVisitedNovel;
use BrianFaust\SocialShare\Share;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\NovelGroup;
use App\Novel;
use Auth;
use Illuminate\Database\Eloquent\Collection;

class EachController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('novel_group_favorite');
    }

    public function novel_group($id)
    {

        $novel_group = NovelGroup::where('id', $id)->with('keywords')->with(['novels' => function ($query) {
            $query->orderBy('inning', 'desc');
        }])->with('nicknames')->first();
        //if user is logged in then get his recently visited novel
        if (Auth::check()) {
            //$favorite_display=$novel_group->checkUserFavourite($novel_group->id);
            $recently_visited_novel = RecentlyVisitedNovel::where(['user_id' => Auth::user()->id, 'novel_group_id' => $novel_group->id])->with('novels')->first();
        } else {
            //$favorite_display=false;
            $recently_visited_novel = '';
        }
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
        //Social Share
        $share = new Share();

        return view('main.each_novel.novel_group', compact('novel_group', 'author_novel_groups', 'recently_visited_novel', 'share'));
    }


    public function novel_group_inning(Request $request, $novel_id)
    {

        $order = $request->order;
        //get the novel data
        $novel_group_inning = Novel::where('id', $novel_id)->with(['comments' => function ($q) use ($order ){
            if($order=='older') {
                $q->oldest();
            } else {
                $q->latest();
            }

        }])->first();
        //set default value for favorite icon
        $show_favorite = false;
        //if user is logged in save this novel to recently visited
        if (Auth::check()) {
            //Check if recently visited item exists or not
            $already_have_recently_visited = RecentlyVisitedNovel::where(['user_id' => Auth::user()->id, 'novel_group_id' => $novel_group_inning->novel_group_id])->first();
            //if recently visited item already exist for a particular group and user then update the item for new visited novel, otherwise create new recently visited
            if (empty($already_have_recently_visited)) {

                RecentlyVisitedNovel::create([
                    'user_id' => Auth::user()->id,
                    'novel_id' => $novel_id,
                    'novel_group_id' => $novel_group_inning->novel_group_id
                ]);
            } else {
                RecentlyVisitedNovel::where(['user_id' => Auth::user()->id, 'novel_group_id' => $novel_group_inning->novel_group_id])->update([
                    'novel_id' => $novel_id
                ]);
            }
            //check if this novel_group is user's favorite or not
            $show_favorite = NovelGroup::find($novel_group_inning->novel_group_id)->checkUserFavourite($novel_group_inning->novel_group_id);
        }

        //get the all comments of a novel
        $novel_group_inning_comments = new Collection();
        foreach ($novel_group_inning->comments as $comment) {
            if ($comment->parent_id == 0) {

                $single_comment = $comment->myself;
                $single_comment->put('children', $comment->children);

                $novel_group_inning_comments->push($single_comment);

            }
        }

       // dd($novel_group_inning_comments);
        //Social Share
        $share = new Share();


        // Next inning
        $next_inning = Novel::where('novel_group_id', $novel_group_inning->novel_group_id)
            ->where('inning', '>', $novel_group_inning->inning)->orderBy('inning')->first();
        if ($next_inning) {
            $next_inning_id = $next_inning->id;
        } else {
            $next_inning_id = null;
        }

        // Previous inning
        $prev_inning = Novel::where('novel_group_id', $novel_group_inning->novel_group_id)
            ->where('inning', '<', $novel_group_inning->inning)->orderBy('inning', 'desc')->first();
        if ($prev_inning) {
            $prev_inning_id = $prev_inning->id;
        } else {
            $prev_inning_id = null;
        }


//        return response()->json($novel_group_inning_comments);

        return view('main.each_novel.novel_group_inning', compact('novel_group_inning', 'novel_group_inning_comments', 'show_favorite', 'share', 'next_inning_id', 'prev_inning_id','order'));
    }

    public function novel_group_review($novel_group_id)
    {
        return view('main.each_novel.novel_group_review', compact('novel_group_id'));
    }


}
