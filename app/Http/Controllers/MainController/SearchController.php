<?php

namespace App\Http\Controllers\MainController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Keyword;
use App\NovelGroup;

class SearchController extends Controller
{
    public function index(Request $request)
    {

        //get all favorite groups of a user based on recently updated
        $novel_groups = NovelGroup::selectRaw('novel_groups.*,novels.novel_group_id,max(novels.created_at) as new')
            ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
            ->join('novel_group_keywords', 'novel_group_keywords.novel_group_id', '=', 'novel_groups.id')
            ->groupBy('novels.novel_group_id');

        //get search criteria
        $search_type = $request->get('search_type');
        $title = $request->get('title');
        $keyword_name = $request->get('keyword_name');
        $condition = [];

        if ($search_type == '서브') {
            // search in novel_groups
            $novel_groups = $novel_groups->where([['novel_groups.title', 'like', '%' . $title . '%']]);

        } else if ($search_type == '서브2') {
            // search in novels
            $novel_groups = $novel_groups->where([['novels.title', 'like', '%' . $title . '%']]);

        } else {
            // search in novel_groups or novels
            $novel_groups = $novel_groups->where(function ($query) use ($title) {
                $query->where([['novel_groups.title', 'like', '%' . $title . '%']])->orWhere([['novels.title', 'like', '%' . $title . '%']]);
            });
        }

        if ($keyword_name) { //get id from keyword

            $keyword_id = Keyword::select('id')->where('name', $keyword_name)->first();

            if (!$keyword_id) {
                $condition = [['novel_group_keywords.keyword_id', '=', '']];
            } else {
                //make the condition}
                $condition = [['novel_group_keywords.keyword_id', '=', $keyword_id->id]];
            }
        }

        if ($title != '' && $keyword_name != '') {
            //[where title or keyword]
            $novel_groups = $novel_groups->where($condition);

        } else if ($keyword_name) {
            //[where title is empty and keyword]
            $novel_groups = $novel_groups->where($condition);
        }


        $novel_groups = $novel_groups->with('nicknames')->with('keywords')->orderBy('new', 'desc')->paginate(10);
        /* dd($condition);*/

        /* //get all favorite groups of a user based on recently updated
         $novel_groups = NovelGroup::selectRaw('novel_groups.*,novels.novel_group_id,max(novels.created_at) as new')
             ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
             ->join('novel_group_keywords', 'novel_group_keywords.novel_group_id', '=', 'novel_groups.id')
             ->groupBy('novels.novel_group_id')
             ->where($condition)->with('nicknames')
             ->orderBy('new', 'desc')->paginate(50);*/
        //  return response()->json($novel_groups);
        return view('main.search.index', compact('novel_groups', 'search_type', 'title', 'keyword_name'));
    }
}
