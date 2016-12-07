<?php

namespace App\Http\Controllers\PageController;

use App\Http\Controllers\Controller;
use App\Novel;
use App\NovelGroup;
use App\User;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function novel()
    {
        $novel_groups = NovelGroup::all("*");

        return view('admin.novel', compact('novel_groups', 'novel_groups'));
    }

    public function novel_inning($id)
    {
        $novel_group = NovelGroup::find($id);
        $novels = $novel_group->novels;
        return view('admin.novel_inning', compact('novels', 'novel_group'));
    }


    public function novel_json(Request $request)
    {
        //
        $novel_groups = NovelGroup::all("*");

        $comments_count = 0;
        $review_count = 0;
        $count_data = array();
        $review_count_data = array();
        $latested_at = array();

        foreach ($novel_groups as $novel_group) {

            foreach ($novel_group->novels as $novel) {
                foreach ($novel->comments as $commenat) {
                    $comments_count++;
                }
                foreach ($novel->reviews as $n) {
                    $review_count++;
                }

            }
            $latested_at[$novel_group->id] = $novel_group->novels->sortby('created_at')->first()->created_at->format('Y-m-d');

            $count_data[$novel_group->id] = $comments_count;
            $comments_count = 0;

            $review_count_data[$novel_group->id] = $review_count;
            $review_count = 0;

        }
        // dd($count_data);
        // $novel_group= $request->user()->novel_groups()->where('id',$user_novels->novel_group_id)->first();
        return \Response::json(['novel_groups' => $novel_groups, 'count_data' => $count_data, 'review_count_data' => $review_count_data, 'latested_at' => $latested_at]);
        // dd($user_novels);
    }

    public function user()
    {
        $users = User::all('*');
        return view('admin.user', compact('users', 'users'));
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function sales()
    {
        return view('admin.sales');
    }
}
