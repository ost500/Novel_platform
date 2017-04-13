<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Novel;
use App\NovelGroup;
use Auth;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Validator;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('store', 'update', 'destroy');
    }

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

        Validator::make($request->all(), [
            'comment' => 'required|max:1000',
        ], [
            'comment.required' => '입력하세요',
            'comment.max' => '댓글이 너무 깁니다',
        ])->validate();


        //if commenting is blocked then redirect
        if (Auth::user()->isCommentBlocked()) {
            flash('댓글 기능이 관리자에 의해 금지 됐습니다', 'danger');
            return response()->json(['error' => 1, 'message' => '댓글 기능이 관리자에 의해 금지 됐습니다']);
        }

        $new_comment = new Comment();
        $new_comment->comment = $request->comment;
        $new_comment->parent_id = $request->parent_id;
        $new_comment->novel_id = $request->novel_id;
        $new_comment->comment_secret = $request->comment_secret;
        $new_comment->user_id = Auth::user()->id;
        $new_comment->save();
        return response()->json(['error' => 0, 'status' => 'ok']);


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
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
                    $single_comment->put('children', $comment->children->sortByDesc('created_at'));
                    $comments_count += $comment->children->count();
                    //자식들을 달아준다
                    $groups_comments->put($comments_count, $single_comment);
                    //콜렉션에 넣어준다
                }
            }
        }
//        $groups_comments = new Paginator($groups_comments, 2);

        $groups_comments = new LengthAwarePaginator($groups_comments, $comments_count, 2, $request->page);

//        return response()->json($groups_comments);
        return view('author.group_comments', compact('groups_comments', 'comments_count'));
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

        Validator::make($request->all(), [
            'comment' => 'required|max:1000',
        ], [
            'comment.required' => '입력하세요',
            'comment.max' => '댓글이 너무 깁니다',
        ])->validate();

        Comment::where('id', $id)->update([
            'comment' => $request->get('comment'),
        ]);
        flash('댓글이 수정 되었습니다.', 'success');
        return response()->json(['status' => 'ok']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Comment::destroy($id);
        Comment::where('parent_id', $id)->delete();
        return response()->json(['status' => 'ok']);
    }
}
