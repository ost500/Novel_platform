<?php

namespace App\Http\Controllers\MobileController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Comment;
use App\FreeBoard;
use App\FreeBoardComment;
use App\Payment;
use App\Piece;
use App\Present;
use App\PurchasedNovel;
use App\Review;
use App\ReviewComment;
use App\User;
use Auth;
use Hash;
use Validator;
use Illuminate\Database\Eloquent\Collection;

class MyInfoController extends Controller
{
    public function password_again()
    {
        return view('mobile.my_page.my_info.password_again');
    }

    public function member_leave_password_again()
    {
        return view('mobile.my_page.my_info.member_leave_password_again');
    }

    public function password_again_post(Request $request)
    {
        Validator::make($request->all(), [
            'password' => 'required',
        ], [
            'password.required' => '비밀번호를 입력해 주세요'
        ])->validate();

        if (Hash::check($request->password, Auth::user()->password)) {
            return redirect()->route('my_info.edit');
        }

        $error = ['password' => "비밀번호가 일치하지 않습니다."];

        return redirect()->back()->withErrors($error);

    }

    public function edit(Request $request)
    {
        $me = Auth::user();

        return view('mobile.my_page.my_info.edit', compact('me'));
    }

    public function post_manage(Request $request)
    {

        $articles = FreeBoard::where('user_id', Auth::user()->id)->withCount('comments');

        $articles = $articles->paginate(config('define.pagination_long'));

        return view('mobile.my_page.my_info.post_manage', compact('articles'));
    }

    public function review_manage()
    {
        $articles = Review::where('user_id', Auth::user()->id)->withCount('comments');

        $articles = $articles->paginate(config('define.pagination_long'));

        return view('mobile.my_page.my_info.review_manage', compact('articles'));
    }

    public function novel_comments_manage(Request $request)
    {
        //  $novel_comments = $request->user()->comments()->with('users')->with('novels')->paginate(config('define.pagination_long'))->count();

        //get data
        $novel_comments = Comment::join('users', 'users.id', '=', 'comments.user_id')
            ->join('novels', 'novels.id', '=', 'comments.novel_id')
            ->join('novel_groups', 'novel_groups.id', '=', 'novels.novel_group_id')
            ->select(['comments.*', 'users.name as user_name', 'novels.title as novel_title', 'novels.inning', 'novel_groups.title as novel_group_title', 'novels.id as novels_id'])
            ->where('comments.user_id', Auth::user()->id);

        //Set the Order
        $order = $request->get('order');

        if ($order == 'latest' or $order == '') {
            $novel_comments = $novel_comments->latest();
        } else {
            $novel_comments->orderBy('created_at');
        }

        //Apply Pagination
        $novel_comments = $novel_comments->paginate(config('define.pagination_long'));
        return view('mobile.my_page.my_info.novel_group_comments_manage', compact('novel_comments', 'order'));

    }

    public function free_board_review_comments_manage(Request $request)
    {
        //get data based on filter
        $filter = $request->get('filter');
        if ($filter == 'free_board_comments' or $filter == '') {
            /*  $comments = $request->user()->free_board_comments();*/
            $comments = FreeBoardComment::join('users', 'users.id', '=', 'free_board_comments.user_id')
                ->join('free_boards', 'free_boards.id', '=', 'free_board_comments.free_board_id')
                ->select(['free_board_comments.*', 'users.name as user_name', 'free_boards.title'])
                ->where('free_board_comments.user_id', Auth::user()->id);


        } else {
            /*$comments = $request->user()->review_comments();*/
            $comments = ReviewComment::join('users', 'users.id', '=', 'review_comments.user_id')
                ->join('reviews', 'reviews.id', '=', 'review_comments.review_id')
                ->select(['review_comments.*', 'users.name as user_name', 'reviews.title'])
                ->where('review_comments.user_id', Auth::user()->id);
        }

        //Set the Order
        $order = $request->get('order');

        if ($order == 'latest' or $order == '') {
            $comments = $comments->latest();
        } else {
            $comments->orderBy('created_at');
        }

        //Apply Pagination
        $comments = $comments->paginate(config('define.pagination_long'));

        /*     //get the all comments of  with child
             if($filter == 'review_comments') {
                 $child_comments = new collection();
                 foreach ($comments as $comment) {
                     echo $comment->id;
                     if ($comment->parent_id == 0) {
                         $single_comment=$comment->myself;
                         $single_comment->put('children',$comment->children);
                         $child_comments->push($single_comment);

                     }
                 }
             }*/

        return view('mobile.my_page.my_info.free_board_review_comments_manage', compact('comments', 'filter', 'order'));
    }


    public function destroy_comments(Request $request)
    {
        if ($request->get('comment_type') == 'review') {

            ReviewComment::find($request->get('comment_id'))->delete();
            ReviewComment::where('parent_id', $request->get('comment_id'))->delete();
        } else {

            FreeBoardComment::find($request->get('comment_id'))->delete();
        }

        flash('댓글이 삭제 되었습니다.');
        return response()->json('ok');
    }

    public function update_comments(Request $request)
    {


        if ($request->get('comment_type') == 'review') {

            ReviewComment::where('id', $request->get('comment_id'))->update(['comment' => $request->get('comment')]);

        } else {

            FreeBoardComment::where('id', $request->get('comment_id'))->update(['comment' => $request->get('comment')]);
        }

        flash('댓글이 수정 되었습니다.');
        return response()->json('ok');
    }


    public function charge_bead()
    {
        $user = Auth::user();
        return view('mobile.my_page.use_info.charge_bead', compact('user'));
    }

    public function charge_list()
    {
        $pays = Payment::where('user_id', Auth::user()->id)->paginate(config('define.pagination_long'));

        return view('mobile.my_page.use_info.charge_list', compact('pays'));
    }

    public function manage_piece()
    {
        $pieces = Piece::where('user_id', Auth::user()->id)->paginate(config('define.pagination_long'));

        return view('mobile.my_page.use_info.manage_piece', compact('pieces'));
    }

    public function purchased_novel_list()
    {
        $purchasedNovels = PurchasedNovel::where('user_id', Auth::user()->id)->with('novels')->latest()->paginate(config('define.pagination_long'));

        return view('mobile.my_page.use_info.purchased_novel_list', compact('purchasedNovels'));
    }

    public function received_gift()
    {
        $presents = Present::where('user_id', Auth::user()->id)->with('users')->with('fromUser')->paginate(config('define.pagination_long'));

//        return response()->json($presents);

        return view('mobile.my_page.use_info.received_gift', compact('presents'));
    }

    public function sent_gift()
    {
        $presents = Present::where('from_id', Auth::user()->id)->paginate(config('define.pagination_long'));

        $user_bead = User::select('bead')->where('id', Auth::user()->id)->first();

        return view('mobile.my_page.use_info.sent_gift', compact('presents', 'user_bead'));
    }
}
