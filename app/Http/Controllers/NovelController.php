<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Novel;
use App\NovelGroup;
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
        $novel_groups = $request->user()->novel_groups()->with('novels')->get();

        $comments_count = 0;
        $review_count = 0;
        $count_data = array();
        $review_count_data = array();

        foreach ($novel_groups as $novel_group) {

            foreach ($novel_group->novels as $novel) {
                foreach ($novel->comments as $commenat) {
                    $comments_count++;
                }
                foreach ($novel->reviews as $n){
                    $review_count++;
                }

            }
            $count_data[$novel_group->id] = $comments_count;
            $comments_count = 0;

            $review_count_data[$novel_group->id] = $review_count;
            $review_count = 0;

        }
        // dd($count_data);
        // $novel_group= $request->user()->novel_groups()->where('id',$user_novels->novel_group_id)->first();
        return \Response::json(['novel_groups' => $novel_groups, 'count_data' => $count_data, 'review_count_data' => $review_count_data]);
        // dd($user_novels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(Request $request)
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
        } else {
            $new_novel->publish_reservation = null;
        }

        $new_novel->author_comment = $request->author_comment;

        $new_novel->save();

        $new_novel->inning = Novel::find($request->novel_group_id)->novel_groups->novels->count();

        $new_novel->save();

        $this->inning_order($new_novel->novel_groups->id);


        flash("회차 저장을 성공했습니다");


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
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
    public
    function edit($id)
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
    public
    function update(Request $request, $id)
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
        } else {
            $update_novel->publish_reservation = null;
        }

        $update_novel->author_comment = $request->author_comment;


        //upload the picture
        if ($request->hasFile('cover_photo')) {

            $cover_photo = $request->file('cover_photo');
            $filename = $cover_photo->getClientOriginalName();
            //set original name for database
            $update_novel->cover_photo = $filename;
            //Insert the record

            //upload file to destination path
            $destinationPath = public_path('/img/novel_covers/');
            $cover_photo->move($destinationPath, $update_novel->id . '_' . $filename);
        }


        $update_novel->save();

//        dd($update_novel);
        $novel_group = $update_novel->novel_groups;
        flash("회차 수정을 성공했습니다");
        return view('author.novel_group', compact('update_novel', 'novel_group'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
        $novel = Novel::find($id);
        $novel->delete();

        $this->inning_order($novel->novel_groups->id);

//        $my_novel = Novel::where('user_id',Auth::user()->id)->orderBy('created_at')->get();
//
//        $index = 1;
//        foreach($my_novel as $novel){
//            $novel->inning = $index;
//            $novel->save();
//            $index++;
//        }

    }

    public
    function inning_order($id)
    {
        $novel_group = NovelGroup::find($id);
        $novels = $novel_group->novels;

        $index = 1;
        foreach ($novels as $novel) {
            if ($novel->adult != 0) {
                $novel->inning = $novel->adult;
                $novel->save();
                continue;
            }
            $novel->inning = $index;
            $novel->save();
            $index++;
        }
    }
}
