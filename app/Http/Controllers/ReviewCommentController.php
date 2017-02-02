<?php

namespace App\Http\Controllers;

use App\ReviewComment;
use Auth;
use Illuminate\Http\Request;
use Validator;

class ReviewCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, $id)
    {
        Validator::make($request->all(), [
            'comment' => 'required|max:1000',
        ], [
            'comment.required' => '댓글을 입력하세요',
            'comment.max' => '글이 너무 깁니다',
        ])->validate();

        $new_comment = new ReviewComment();
        $new_comment->user_id = Auth::user()->id;
        $new_comment->review_id = $id;
        $new_comment->comment = $request->comment;
        $new_comment->save();
        return redirect()->back();
    }


    public function destroy($id)
    {
        ReviewComment::find($id)->delete();
        return response()->json('ok');
    }
}
