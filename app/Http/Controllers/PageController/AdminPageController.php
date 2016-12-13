<?php

namespace App\Http\Controllers\PageController;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use App\MenToMenQuestionAnswer;
use App\Novel;
use App\NovelGroup;
use App\User;
use App\Mailbox;
use App\Faq;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminPageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

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

    public function novel_inning_view($id)
    {
        $novel = Novel::find($id);
        $novel_group = $novel->novel_groups;

        $reser_day = new Carbon();

        //출간예약이 없다면 null 값을 리턴한다
        if($novel->publish_reservation == null){
            $novel->reser_day = null;
            $novel->reser_time = null;
        }
        else{
            $novel->reser_day = $reser_day->toDateString();
            $novel->reser_day = $reser_day->format('h:i');
        }

        return view('admin.novel_inning_view', compact('novel', 'novel_group'));
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

    public function users()
    {
        $users = User::all('*')->paginate(10);
        return view('admin.users', compact('users', 'users'));
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function request(Request $request)
    {
        $men_to_men_requests = MenToMenQuestionAnswer::all('*')->orderBy('id', 'desc')->paginate(10);
        // return \Response::json($men_to_men_requests);
        return view('admin.request', compact('men_to_men_requests'));
    }

    public function request_view(Request $request, $id)
    {
        $men_to_men_request = MenToMenQuestionAnswer::where('id', $id)->with('users')->first();
        $men_to_men_requests = $request->user()->question_answers()->orderBy('id', 'desc')->paginate(10);
        //  return \Response::json($men_to_men_requests);
        return view('admin.request_view', compact('men_to_men_request', 'men_to_men_requests'));
    }

    public function memo(Request $request)
    {
        $novel_mail_messages= Mailbox::all('*');
        return view('admin.memo', compact('novel_mail_messages'));
    }

    public function memo_create()
    {
        return view('admin.memo_create');
    }

    public function memo_view(Request $request, $id)
    {
        $memo = Mailbox::find($id);
        return view('admin.memo_view', compact('memo'));
    }


    public function sales()
    {
        return view('admin.sales');
    }



    public function faq_create()
    {
        return view('admin.faq_create');
    }

    public function faq_edit($id)
    {
        $faq = Faq::find($id);
        return view('admin.faq_edit', compact('faq'));
    }



}
