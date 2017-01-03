<?php

namespace App\Http\Controllers\PageController;

use App\NovelGroupPublishCompany;
use App\Company;
use App\Http\Controllers\Controller;
use App\Keyword;
use App\MailLog;
use App\PublishNovel;
use DateTime;
use Illuminate\Pagination\Paginator;
use App\MenToMenQuestionAnswer;
use App\Novel;
use App\NovelGroup;
use App\User;
use App\Mailbox;
use App\Faq;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;


class AdminPageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
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
        $users = User::paginate(10);
        return view('admin.users', compact('users', 'users'));
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function request(Request $request)
    {
        $men_to_men_requests = MenToMenQuestionAnswer::orderBy('id', 'desc')->paginate(10);
        // return \Response::json($men_to_men_requests);
        return view('admin.request', compact('men_to_men_requests'));
    }

    public function request_view(Request $request, $id)
    {
        $men_to_men_request = MenToMenQuestionAnswer::where('id', $id)->with('users')->first();
        $men_to_men_requests = MenToMenQuestionAnswer::orderBy('id', 'desc')->paginate(5);
        return view('admin.request_view', compact('men_to_men_request', 'men_to_men_requests'));
    }

    public function memo(Request $request)
    {
        $novel_mail_messages = Auth::user()->maillogs()->with('mailboxs')->latest()->paginate(2);
        $page = $request->page;
//        $page = new Paginator($novel_mail_messages, 2);
//        return response()->json($novel_mail_messages);
        return view('admin.novel_memo', compact('novel_mail_messages', 'page'));
    }

    public function memo_create()
    {
        $my_novel_groups = NovelGroup::get();
        return view('admin.memo_create', compact('my_novel_groups'));
    }

    public function memo_view(Request $request, $id)
    {

//        $mailbox_message = Mailbox::where('id', $id)->with('users')->first();
        $men_to_men_request = MailLog::where('id', $id)->with('mailboxs.users')->with('users')->first();
        $men_to_men_requests = $request->user()->maillogs()->with('mailboxs.users')->orderBy('id', 'desc')->paginate(2);
        $page = $request->page;
//                return response()->json($men_to_men_request);
        return view('admin.mailbox_message', compact('men_to_men_request', 'men_to_men_requests', 'page'));
    }

    public function mailbox_send(Request $request)
    {
        $novel_mail_messages = Mailbox::where('from', Auth::user()->id)->with('users')->orderBy('created_at', 'desc')->paginate(2);
        $page = $request->page;
//                return response()->json($novel_mail_messages);
        return view('admin.novel_memo_send', compact('novel_mail_messages', 'page'));
    }

    public function mailbox_send_message_show($id, Request $request)
    {

//        $mailbox_message = Mailbox::where('id', $id)->with('users')->first();
        $men_to_men_request = Mailbox::where('id', $id)->with('users')->with('maillogs.users')->with('novel_groups')->first();
        $men_to_men_requests = $request->user()->mailbox()->orderBy('id', 'desc')->paginate(2);
        $page = $request->page;
        $maillog_page = $request->maillog_page;

        $mail_logs = MailLog::where('mailbox_id', $id)->with('users')->with('novel_groups')->paginate(5, ["*"], "maillog_page");
//        return response()->json($men_to_men_request);
        return view('admin.mailbox_send_message', compact('men_to_men_request', 'men_to_men_requests', 'page', 'mail_logs', 'maillog_page'));
    }


    public function sales()
    {
        return view('admin.sales');
    }

    public function faq_index()
    {

        $faq_reader = Faq::where('faq_category', 1)->get();
        $faq_author = Faq::where('faq_category', 2)->get();
        $faq_etc = Faq::where('faq_category', 3)->get();

        return view('admin.faq_index', compact('faq_reader', 'faq_author', 'faq_etc'));
    }

    public function faq_create()
    {
        return view('admin.faq_create');
    }

    public function keyword_index()
    {

        $keyword1 = Keyword::where('category', 1)->get();
        $keyword2 = Keyword::where('category', 2)->get();
        $keyword3 = Keyword::where('category', 3)->get();
        $keyword4 = Keyword::where('category', 4)->get();
        $keyword5 = Keyword::where('category', 5)->get();
        $keyword6 = Keyword::where('category', 6)->get();
        $keyword7 = Keyword::where('category', 7)->get();

        return view('admin.keyword_index', compact('keyword1', 'keyword2', 'keyword3', 'keyword4', 'keyword5', 'keyword6', 'keyword7'));
    }

    public function keyword_create()
    {
        return view('admin.keyword_create');
    }

    public function partner_create_company()
    {
        return view('admin.partnership.create_company');
    }

    public function partner_edit_company($company_id)
    {
        $company = Company::where('id', $company_id)->first();
        return view('admin.partnership.edit_company', compact('company'));
    }

    public function partner_manage_company()
    {
        $companies = Company::get();
        return view('admin.partnership.manage_company', compact('companies'));
    }

    /**
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function partner_manage_apply($id = null)
    {

        $companies = Company::orderBy('name')->get();
        $apply_requests = NovelGroupPublishCompany::where('status', '!=', '신청하기')->with('novel_groups.users')->with('publish_novel_groups')->with('companies');

        if ($id) {
            //  $apply_requests= PublishNovelGroup::with('novel_groups')->with('users')->with(['companies'=> function($q){ $q->where('company_id','2'); } ])->paginate(5);
//            $apply_requests = $apply_requests->whereHas('companies', function ($q) use ($id) {
//                    $q->where('companies.id', $id);
//            });
            $apply_requests->where('company_id', $id);

        }

        $apply_requests = $apply_requests->paginate(10);
        return view('admin.partnership.manage_apply', compact('apply_requests', 'companies'));

    }

    public function partner_test_inning($id = null)
    {

        $companies = Company::orderBy('name')->get();
        $apply_requests = NovelGroupPublishCompany::where('status', '!=', '신청하기')->with('novel_groups.users')->with('publish_novel_groups')->with('companies');

        if ($id) {
            //  $apply_requests= PublishNovelGroup::with('novel_groups')->with('users')->with(['companies'=> function($q){ $q->where('company_id','2'); } ])->paginate(5);
//            $apply_requests = $apply_requests->whereHas('companies', function ($q) use ($id) {
//                    $q->where('companies.id', $id);
//            });
            $apply_requests->where('company_id', $id);

        }

        $apply_requests = $apply_requests->paginate(10);
        return view('admin.partnership.test_inning', compact('apply_requests', 'companies','id'));

    }

    public function partner_approve_inning($id = null)
    {

        $apply_requests = PublishNovel::with('companies')->with('publish_novel_groups.novel_groups.users')->with('novels');


        $companies = Company::orderBy('name')->get();
//        $apply_requests = NovelGroupPublishCompany::where('status', '!=', '신청하기')->with('novel_groups.users')->with('publish_novel_groups')->with('companies');

        if ($id) {

            $apply_requests->where('company_id', $id)->where('status','심사');

        }





        $apply_requests = $apply_requests->paginate(20);

        //time pass put
        foreach ($apply_requests as $apply_request) {
            $apply_request->pass = $this->time_elapsed_string($apply_request->created_at);

        }

        return view('admin.partnership.approve_inning', compact('apply_requests', 'companies'));
    }

    function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => '년',
            'm' => '월',
            'w' => '주',
            'd' => '일',
            'h' => '시간',
            'i' => '분',
            's' => '초',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' 전' : '방금 전';
    }


}
