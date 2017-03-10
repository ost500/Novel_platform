<?php

namespace App\Http\Controllers\MobileController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Keyword;
use App\NovelGroup;

class SearchController extends Controller
{
    public function index(Request $request)
    {

        //get all favorite groups of a user based on recently updated
        $novel_groups = NovelGroup::selectRaw('novel_groups.*, novels.novel_group_id, max(novels.created_at) as new, nick_names.nickname,sum(total_count) as total_count')
            ->join('novels', 'novels.novel_group_id', '=', 'novel_groups.id')
            ->join('nick_names', 'nick_names.id', '=', 'novel_groups.nickname_id')
            ->join('novel_group_keywords', 'novel_group_keywords.novel_group_id', '=', 'novel_groups.id')
            ->join('novel_group_hash_tags', 'novel_group_hash_tags.novel_group_id', '=', 'novel_groups.id')
            ->groupBy('novels.novel_group_id');

        //get search criteria
        $nickname_id = $request->get('nickname_id');
        $search_type = $request->get('search_type');
        $title = $request->get('title');
        $keyword_name = $request->get('keyword_name');


    /*    if ($search_type=='�ٸ� ��ǰ') {
            return response()->json($search_type);
            // search in novel_groups for author's other novels
            $novel_groups = $novel_groups->where('novel_groups.nickname_id', $nickname_id);
        }
        dd($search_type);*/

        if ($search_type == '�Ҽ�') {
            // search in novel_groups
            $novel_groups = $novel_groups->where([['novel_groups.title', 'like', '%' . $title . '%']]);

        } else if ($search_type == '�Ҽ� ȸ��') {
            // search in novels
            $novel_groups = $novel_groups->where([['novels.title', 'like', '%' . $title . '%']]);

        } else if ($search_type == '�۰�') {
            // search in novel_groups or novels
            $novel_groups = $novel_groups->where([['nick_names.nickname', 'like', '%' . $title . '%']]);

        } else if ($search_type == '�ٸ� ��ǰ') {
            dd($search_type);
            // search in novel_groups for author's other novels
            $novel_groups = $novel_groups->where('novel_groups.nickname_id', $nickname_id);
        } else {
            // search in novel_groups or novels
            $novel_groups = $novel_groups->where(function ($query) use ($title) {
                $query->where([['novel_groups.title', 'like', '%' . $title . '%']])->orWhere([['novels.title', 'like', '%' . $title . '%']]);
            });
        }

        //Search if Hash tag or keyword is there
        if ($keyword_name) {
            //get id from keyword_name so that we can search it in novel_group_keywords
            $keyword_id = Keyword::select('id')->where('name', $keyword_name)->first();

            if (!$keyword_id) {
                $novel_groups->where([['novel_group_hash_tags.tag', 'like', '']])->orWhere([['novel_group_keywords.keyword_id', '=', '']]);
            } else {
                //search in both novel_group_keywords and novel_group_hash_tags
                $novel_groups = $novel_groups->where(function ($query) use ($keyword_name, $keyword_id) {
                    $query->where([['novel_group_hash_tags.tag', 'like', '%' . $keyword_name . '%']])->orWhere([['novel_group_keywords.keyword_id', '=', $keyword_id->id]]);
                });
            }
        }


        $novel_groups = $novel_groups->with('nicknames')->with('keywords')->withCount('novels')->orderBy('new', 'desc')->paginate(config('define.pagination_long'));
        //  return response()->json($novel_groups);
        return view('mobile.search.index', compact('novel_groups', 'search_type', 'title', 'keyword_name'));
    }
}
