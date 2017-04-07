<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Events\NewSpeedEvent;
use App\Novel;
use App\NovelGroup;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use App\Mailbox;
use App\MailLog;
use App\Favorite;
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
        if (Auth::user()->isAdmin()) {
            //if you are admin
            $novel_groups = NovelGroup::with('novels')->get();
        } else {
            //if you are user
            $novel_groups = $request->user()->novel_groups()->with('novels')->get();
        }

        $author = User::select('author_agreement')->where('id', Auth::user()->id)->first();


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
            //소설이 없다면
            if ($novel_group->novels->count() != 0) {
                $latested_at[$novel_group->id] = $novel_group->novels->sortby('created_at')->first()->created_at->format('Y-m-d');
            } else {
                $latested_at[$novel_group->id] = "0000-00-00";
            }


            $count_data[$novel_group->id] = $comments_count;
            $comments_count = 0;

            $review_count_data[$novel_group->id] = $review_count;
            $review_count = 0;

        }
        // dd($count_data);
        // $novel_group= $request->user()->novel_groups()->where('id',$user_novels->novel_group_id)->first();
        return \Response::json(['novel_groups' => $novel_groups, 'count_data' => $count_data, 'review_count_data' => $review_count_data, 'latested_at' => $latested_at, 'author' => $author]);
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

        Validator::make($request->all(), [
            'title' => 'required|max:255',
            'novel_content' => 'required',
            'author_comment' => 'required',
        ],
            [
                'title.required' => '제목은 필수 입니다.',
                'title.max' => '제목은 반드시 255 자리보다 작아야 합니다.',
                'novel_content.required' => '내용은 필수 입니다.',
                'author_comment.required' => '작가의 말은 필수 입니다.',
            ]
        )->validate();


        $new_novel = new Novel();
        $new_novel->user_id = Auth::user()->id;
        $new_novel->novel_group_id = $request->novel_group_id;
        $new_novel->title = $request->title;
        $new_novel->content = $request->novel_content;


        if ($request->publish_reservation == "on" && $request->reser_day && $request->reser_time) {
            // echo $request->reser_day . " " . $request->reser_time;
            $new_novel->publish_reservation = $request->reser_day . " " . $request->reser_time;
        } else {
            $new_novel->publish_reservation = null;
        }

        $new_novel->author_comment = $request->author_comment;

        $new_novel->save();

        $new_novel->inning = Novel::where('novel_group_id', $request->novel_group_id)->max('inning') + 1;

        if ($request->adult == "on") {
            $new_novel->adult = $new_novel->inning;
        }

        $new_novel->save();

//        $this->inning_order($new_novel->novel_groups->id);


        flash("회차 저장을 성공했습니다");

        event(new NewSpeedEvent("novel", "소설 '" . $new_novel->novel_groups->title . "'의 " . $new_novel->inning . "회 신규 회차가 등록 되었습니다.", "link", $new_novel->novel_groups->cover_photo, $new_novel->novel_groups->id));

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
        $novel = Novel::find($id);
        $novel_group = $novel->novel_groups;

        $reser_day = new Carbon($novel->publish_reservation);

        //출간예약이 없다면 null 값을 리턴한다
        if ($novel->publish_reservation == null) {
            $novel->reser_day = null;
            $novel->reser_time = null;
        } else {
            $novel->reser_day = $reser_day->toDateString();
            $novel->reser_time = $reser_day->format('h:i');
        }


        return \Response::json(['novel' => $novel, 'novel_group' => $novel_group]);
        // return view('author.novel_inning_update', compact('novel', 'novel_group'));
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

        Validator::make($request->all(), [
            'title' => 'required|max:255',
            'content' => 'required',
            'author_comment' => 'required',
        ],
            [
                'title.required' => '제목은 필수 입니다.',
                'title.max' => '제목은 반드시 255 자리보다 작아야 합니다.',
                'content.required' => '내용은 필수 입니다.',
                'author_comment.required' => '작가의 말은 필수 입니다.',
            ]
        )->validate();


        $update_novel = Novel::find($id);

        $update_novel->title = $request->title;
        $update_novel->content = $request->get('content');
        if ($request->adult == "on") {
            $update_novel->adult = true;

        } else {
            $update_novel->adult = false;
        }

        if ($request->publish_reservation == "on" && $request->reser_day && $request->reser_time) {
            // echo $request->reser_day . " " . $request->reser_time;
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

        if ($request->path == "admin") {
            return redirect()->route('admin.novel_inning_view', ['id' => $id]);
        } else {

            // return "ddsfdsfdsf";
            return redirect()->route('author_novel_group', ['id' => $update_novel->novel_group_id]);
            // return view('author.novel_group', compact('update_novel', 'novel_group'));
        }
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
//            if ($novel->adult != 0) {
//                // this is adult version
//                $novel->inning = $novel->adult;
//                $novel->save();
//                continue;
//            }
            $novel->inning = $index;
            $novel->save();
            $index++;
            if ($novel == end($novels)) {
                $novel_group->latest_at = $novel->created_at;
            }
        }
        $novel_group->max_inning = --$index;
        $novel_group->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update_agreement(Request $request, $id)
    {
        $novel = Novel::find($id);

        $novel->non_free_agreement = $request->non_free_agreement;
        $novel->save();
        return response()->json($request);
    }

    public function make_adult($id)
    {
        $novel = Novel::find($id);

        $novel->adult = 1;
        $novel->save();

    }

    public function cancel_adult($id)
    {
        $novel = Novel::find($id);

        $novel->adult = 0;
        $novel->save();

    }


    public function make_closed($id)
    {
        $novel = Novel::findOrFail($id);
        $novel->closed = Carbon::now();
        $novel->save();

    }
    public function cancel_closed($id)
    {

        $novel = Novel::findOrFail($id);
        $novel->closed = null;
        $novel->save();

    }


}
