<?php

namespace App\Http\Controllers\PageController;

use App\Http\Controllers\Controller;
use App\MenToMenQuestionAnswer;
use App\Novel;
use App\NovelGroup;
use App\User;
use App\Mailbox;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

    public function novel_inning_view($id)
    {
        $novel = Novel::find($id);
        $novel_group = $novel->novel_groups;

        $reser_day = new Carbon();

        //�Ⱓ������ ���ٸ� null ���� �����Ѵ�
        if ($novel->publish_reservation == null) {
            $novel->reser_day = null;
            $novel->reser_time = null;
        } else {
            $novel->reser_day = $reser_day->toDateString();
            $novel->reser_day = $reser_day->format('h:i');
        }

        return view('admin.novel_inning_view', compact('novel', 'novel_group'));
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
        $novel_mail_messages = Mailbox::all('*');
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
}
