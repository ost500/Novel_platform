<?php

namespace App\Http\Controllers\MobileController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PurchasedNovel;
use App\RecentlyVisitedNovel;
use BrianFaust\SocialShare\Share;
use Carbon\Carbon;
use App\NovelGroup;
use App\Novel;
use Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Routing\Redirector;
use Session;

class EachController extends Controller
{

    public function novel_group($id)
    {

        $novel_group = NovelGroup::where('id', $id)->with('users')->with('keywords')->with('hash_tags')->with(['novels' => function ($query) {
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
            ->leftjoin('favorites', 'favorites.novel_group_id', '=', 'novel_groups.id')
            ->groupBy('novel_groups.id')
            ->where([['novel_groups.nickname_id', '=', $novel_group->nickname_id], ['novel_groups.id', '<>', $id]])
            ->orderBy('created_at', 'desc')
            ->paginate(3);
        //Social Share
        $share = new Share();
        //For checking publishing time for novel inning
        $latest_time = Carbon::now();

        return view('mobile.each_novel.novel_group', compact('novel_group', 'author_novel_groups', 'recently_visited_novel', 'share', 'latest_time'));
    }

    public function novel_group_inning(Request $request, $novel_id)
    {

        $increment = true;

        //Get the session data and Check if session has data i.e viewed novels
        $viewed_novels = Session::get('viewed_novels');

        if ($viewed_novels) {
            //if novel id exist in the session already viewed set increment to false
            foreach ($viewed_novels as $viewed_novel) {
                if ($viewed_novel == $novel_id) {

                    $increment = false;
                }
            }
        } else {
            $viewed_novels = array();
        }

        if ($increment) {

            //increase the view counts
            $novel = Novel::where('id', $novel_id)->first();
            $today_count = $novel->today_count = $novel->today_count + 1;
            $this_week_count = $novel->week_count = $novel->week_count + 1;
            $this_month_count = $novel->month_count = $novel->month_count + 1;
            $this_year_count = $novel->year_count = $novel->year_count + 1;
            $this_total_count = $novel->total_count = $novel->total_count + 1;
            $novel->save();

            //Append the clicked novel id to array
            $viewed_novels = array_prepend($viewed_novels, $novel_id);

            //Add the array to session
            Session::put(['viewed_novels' => $viewed_novels, 'viewed_at' => Carbon::now()]);

        }


        $order = $request->order;
        //get the novel data
        $novel_group_inning = Novel::where('id', $novel_id)->with(['comments' => function ($q) use ($order) {
            if ($order == 'older') {
                $q->oldest();
            } else {
                $q->latest();
            }

        }])->first();


// if it is not free
        if ($novel_group_inning->non_free_agreement) {

            // not allow people who didn't log in
            if (!Auth::check()) {

                redirect()->guest($request->geturi());

                $request->session()->flash('login', true);
                return redirect()->back();
            }

            $my_purchased_novel = PurchasedNovel::where('user_id', Auth::user()->id)
                ->where('novel_id', $novel_id)->get();
            if ($my_purchased_novel->isEmpty()) {
                return redirect()->route('m.each_novel.novel_group_inning.purchase', ['id' => $novel_id]);
            }
        }


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

        return view('mobile.each_novel.novel_group_inning', compact('novel_group_inning', 'novel_group_inning_comments', 'show_favorite', 'share', 'next_inning_id', 'prev_inning_id', 'order'));
    }

    public function novel_group_review($novel_group_id)
    {
        return view('mobile.each_novel.novel_group_review', compact('novel_group_id'));
    }

    public  function purchase($id)
    {

        $novel = Novel::find($id);

        $novel_group = NovelGroup::where('id', $novel->novel_group_id)->with('users')->with('keywords')->with(['novels' => function ($query) {
            $query->orderBy('inning', 'desc');
        }])->with('nicknames')->first();


        $author_novel_groups = NovelGroup::selectRaw('novel_group_id, novel_groups.*, count(novel_group_id) as favorite_count')
            ->join('favorites', 'favorites.novel_group_id', '=', 'novel_groups.id')
            ->groupBy('novel_group_id')
            ->where([['novel_groups.user_id', '=', $novel_group->user_id], ['novel_groups.id', '<>', $novel_group->id]])
            ->orderBy('created_at', 'desc')
            ->paginate(3);
        //Social Share
        $share = new Share();
        //For checking publishing time for novel inning
        $latest_time = Carbon::now();

        return view('main.each_novel.purchase', compact('novel_group', 'author_novel_groups', 'novel', 'share', 'latest_time'));
    }

    public  function purchase_post(Request $request)
    {

        $new_purchased_novel = new PurchasedNovel();
        $new_purchased_novel->user_id = Auth::user()->id;
        $new_purchased_novel->novel_id = $request->novel_id;
        if ($request->BeadOrPiece == 'Bead') {

            if ($request->user()->bead < 1) {
                $errors = '구슬이 부족합니다';
                return response()->json($errors, 400);
            }

            $new_purchased_novel->method = '구슬';

            $request->user()->bead -= 1;
            $request->user()->save();

        } else {
            $new_purchased_novel->method = '조각';

            if ($request->user()->piece < 1) {
                $errors = '조각이 부족합니다';
                return response()->json('조각이 부족합니다', 400);
            }

            $request->user()->piece -= 1;
            $request->user()->save();
        }

        $new_purchased_novel->save();

        flash($new_purchased_novel->method . '이(가) 사용 됐습니다');

        return ['status' => 'OK'];
    }
}
