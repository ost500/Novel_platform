<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Novel;
use Auth;
use Illuminate\Http\Request;

class NovelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user_novels = $request->user()->novel_groups()->with('novels')->get();
        // $novel_group= $request->user()->novel_groups()->where('id',$user_novels->novel_group_id)->first();
        return \Response::json($user_novels);
        // dd($user_novels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_novel = new Novel();
        $new_novel->user_id = Auth::user()->id;
        $new_novel->novel_group_id = $request->novel_group_id;
        $new_novel->title = $request->title;
        $new_novel->content = $request->novel_content;
        if ($request->adult == "on") {
            $new_novel->adult = true;
        }
        if ($request->publish_reservation == "on" && $request->reser_day && $request->reser_time) {
            echo $request->reser_day . " " . $request->reser_time;
            $new_novel->publish_reservation = $request->reser_day . " " . $request->reser_time;
        } else{
            $new_novel->publish_reservation = null;
        }

        $new_novel->author_comment = $request->author_comment;
        $new_novel->save();

        dd($new_novel);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $novel = Novel::find($id);
        return response()->json($novel);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update_novel = Novel::find($id);

        $update_novel->title = $request->title;
        $update_novel->content = $request->novel_content;
        if ($request->adult == "on") {
            $update_novel->adult = true;
        }
        if ($request->publish_reservation == "on" && $request->reser_day && $request->reser_time) {
            echo $request->reser_day . " " . $request->reser_time;
            $update_novel->publish_reservation = $request->reser_day . " " . $request->reser_time;
        } else{
            $update_novel->publish_reservation = null;
        }

        $update_novel->author_comment = $request->author_comment;
        $update_novel->save();

        dd($update_novel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $novel = Novel::find($id);
        $novel->delete();
    }
}
