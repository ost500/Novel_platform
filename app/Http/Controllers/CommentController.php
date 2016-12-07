<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Novel;
use App\NovelGroup;
use Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class CommentController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index($id)
    {

        $my_comments = Comment::with('novels')->with('users')->get()->where('novels.user_id', Auth::user()->id);

        //?�� ?��?��?�� �?�?�? ?��?��
//        $my_novel = Novel::where('user_id', Auth::user()->id)->with('users')->get();


        $collection = new Collection();

        //?�� ?��?��?�� ?���??�� �?�?�? ?��?��

        foreach ($my_comments as $novel_comm) {
            $collection->push($novel_comm);
            foreach ($novel_comm->children as $child) {
                $collection->push($child);
            }
        }


        return response()->json($collection);
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

        $new_comment = new Comment();
        $new_comment->comment = $request->comment;
        $new_comment->parent_id = $request->parent_id;
        $new_comment->novel_id = $request->novel_id;
        $new_comment->user_id = Auth::user()->id;
        $new_comment->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group_novel = NovelGroup::find($id)->novels;

        $groups_comments = new Collection();

        $comments_count = 0;

        foreach ($group_novel as $novel) {
            foreach ($novel->comments as $comment) {
                if ($comment->parent_id == 0) {
                    $comments_count++;
                    //부모가 없는 댓글들만 불러온다
                    $single_comment = $comment->myself;
                    $single_comment->put('children', $comment->children);
                    $comments_count += $comment->children->count();
                    //자식들을 달아준다
                    $groups_comments->push($single_comment);
                    //콜렉션에 넣어준다
                }
            }
        }
//        $groups_comments = new Paginator($groups_comments, 2);


//        return response()->json($groups_comments);
        return view('author.group_comments', compact('groups_comments','comments_count'));
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
        //
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
    }
}
