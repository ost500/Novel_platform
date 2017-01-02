<?php

namespace App\Http\Controllers\PageController;

use App\Company;
use App\Mailbox;
use App\MailLog;
use App\MenToMenQuestionAnswer;
use App\Novel;
use App\NovelGroup;
use App\Faq;
use App\NovelGroupPublishCompany;
use App\PublishNovelGroup;
use App\User;
use App\Http\Controllers\Controller;
use App\ViewCount;
use Auth;
use App\Keyword;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthorPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $novel_groups = $request->user()->novel_groups()->with('novels')->get();
        return view('author.index', compact('novel_groups'));
    }

    public function novel_gorup($id)
    {
        $novel_group = NovelGroup::find($id);
        $novels = $novel_group->novels;
        return view('author.novel_group', compact('novels', 'novel_group'));
    }

    public function profile()
    {
        return view('author.profile');
    }

    public function create()
    {

        $keyword1 = Keyword::select('id', 'name')->where('category', '1')->get();
        $keyword2 = Keyword::select('id', 'name')->where('category', '2')->get();
        $keyword3 = Keyword::select('id', 'name')->where('category', '3')->get();
        $keyword4 = Keyword::select('id', 'name')->where('category', '4')->get();
        $keyword5 = Keyword::select('id', 'name')->where('category', '5')->get();
        $keyword6 = Keyword::select('id', 'name')->where('category', '6')->get();
        $keyword7 = Keyword::select('id', 'name')->where('category', '7')->get();

        return view('author.create', compact('keyword1', 'keyword2', 'keyword3', 'keyword4', 'keyword5', 'keyword6', 'keyword7'));
    }

    public function create_inning($id)
    {
        $novel_group = NovelGroup::find($id);
        return view('author.novel_inning_write', compact('novel_group'));
    }

    public function show_inning($novel_id)
    {

        $novel = Novel::where('id', $novel_id)->first();

        //Create or update today's views
        $today = Carbon::now()->toDateString();
        $view_count_instance = new ViewCount();
        //check if today's view for this novel_id already exists or not
        $view_count_today = $view_count_instance->viewCountToday($novel_id);
        //if exists, then update the today's view count otherwise create new view count
        if ($view_count_today) {
            $view_count_today->count = $view_count_today->count + 1;
            $view_count_today->save();
            $today_count = $view_count_today->count;

        } else {
            $novel->view_counts()->create([
                'date' => $today,
                'count' => '0',
                'separation' => 1,
            ]);
            $today_count = 0;
        }

        //Create or update week's views
        $start_of_week = Carbon::now()->startOfWeek()->toDateString();
        $view_count_instance1 = new ViewCount();
        //check if week's view for this novel_id already exists or not
        $view_count_week = $view_count_instance1->viewCountWeek($novel_id);
        //if exists, then update the week's view count otherwise create new view count
        if ($view_count_week) {
            $view_count_week->count = $view_count_week->count + 1;
            $view_count_week->save();
            $this_week_count = $view_count_week->count;
        } else {
            $novel->view_counts()->create([
                'date' => $start_of_week,
                'count' => '0',
                'separation' => 2,
            ]);
            $this_week_count = 0;
        }

        //Create or update month's views
        $start_of_month = Carbon::now()->startOfMonth()->toDateString();
        $view_count_instance2 = new ViewCount();
        //check if month's view for this novel_id already exists or not
        $view_count_month = $view_count_instance2->viewCountMonth($novel_id);
        //if exists, then update the month's view count otherwise create new view count
        if ($view_count_month) {
            $view_count_month->count = $view_count_month->count + 1;
            $view_count_month->save();
            $this_month_count = $view_count_month->count;
        } else {
            $novel->view_counts()->create([
                'date' => $start_of_month,
                'count' => '0',
                'separation' => 3,
            ]);
            $this_month_count = 0;
        }

        return view('author.novel_inning_show', compact('novel', 'today_count', 'this_week_count', 'this_month_count'));
    }


    public function update_inning($id)
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
        return view('author.novel_inning_update', compact('novel', 'novel_group'));

    }

    public function edit($id)
    {
        // $novel_group=NovelGroup::find($id);
        //  return view('author.edit', compact('novel_group','id'));
        return view('author.edit', compact('id'));
    }

    public function specific_mailbox_create($id = null)
    {
        if ($id) {
            $user = User::where('id', $id)->first();

        } else {
            $user = null;
        }
        return view('author.specific_mail', compact('user'));

    }

    public function mailbox_index(Request $request)
    {
        $novel_mail_messages = Auth::user()->maillogs()->with('mailboxs')->paginate(2);
        $page = $request->page;
//        return response()->json($novel_mail_messages);
        return view('author.novel_memo', compact('novel_mail_messages', 'page'));
    }

    public function mailbox_create()
    {
        $my_novel_groups = NovelGroup::where('user_id', Auth::user()->id)->get();
        return view('author.novel_memo_create', compact('my_novel_groups'));
    }

    public function mailbox_message_show($id, Request $request)
    {

//        $mailbox_message = Mailbox::where('id', $id)->with('users')->first();
        $men_to_men_request = MailLog::where('id', $id)->with('mailboxs.users')->with('users')->first();
        //update the read status
        if (!$men_to_men_request->read) {
            //$maillog = new MailLog();
            $men_to_men_request->read = Carbon::now();
            $men_to_men_request->save();
        }
        $men_to_men_requests = $request->user()->maillogs()->with('mailboxs.users')->orderBy('created_at', 'desc')->paginate(2);
//                return response()->json($men_to_men_request);
        $page = $request->page;
        return view('author.mailbox_message', compact('men_to_men_request', 'men_to_men_requests', 'page'));
    }

    public function mailbox_send(Request $request)
    {
        $novel_mail_messages = Mailbox::where('from', Auth::user()->id)->with('users')->orderBy('created_at', 'desc')->paginate(2);
        $page = $request->page;
//                return response()->json($novel_mail_messages);
        return view('author.novel_memo_send', compact('novel_mail_messages', 'page'));
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
        return view('author.mailbox_send_message', compact('men_to_men_request', 'men_to_men_requests', 'page', 'mail_logs', 'maillog_page'));
    }

    public function novel_memo_send($id)
    {
        $mailbox_message = Mailbox::where('id', $id)->with('users')->first();
        return view('author.mailbox_message', compact('mailbox_message'));
    }

    public function men_to_men_create()
    {
        return view('author.novel_request');
    }

    public function men_to_men_index(Request $request)
    {
        $men_to_men_requests = $request->user()->question_answers()->orderBy('id', 'desc')->paginate(10);
        // return \Response::json($men_to_men_requests);
        return view('author.novel_request_list', compact('men_to_men_requests'));
    }

    public function men_to_men_show(Request $request, $id)
    {
        $men_to_men_request = MenToMenQuestionAnswer::where('id', $id)->with('users')->first();
        $men_to_men_requests = $request->user()->question_answers()->orderBy('id', 'desc')->paginate(10);
        //  return \Response::json($men_to_men_requests);
        return view('author.novel_request_view', compact('men_to_men_request', 'men_to_men_requests'));
    }

    public function faq_index()
    {

        $faq_reader = Faq::where('faq_category', 1)->get();
        $faq_author = Faq::where('faq_category', 2)->get();
        $faq_etc = Faq::where('faq_category', 3)->get();

        return view('author.novel_faq', compact('faq_reader', 'faq_author', 'faq_etc'));
    }


    public function nickname()
    {
        return view('author.nick_name');
    }

    public function partner_apply()
    {
        $companies = Company::get();

        $my_novel_groups = NovelGroup::where('user_id', Auth::user()->id)->with('publish_novel_groups')->get()->where('publish_novel_groups', null);


        return view('author.partnership.apply', compact('companies', 'my_novel_groups'));
    }

    public function partner_apply_list()
    {
        $my_publish_novel_groups = PublishNovelGroup::where('user_id', Auth::user()->id)
            ->with('novel_groups')
            ->with('companies')->get();


//            ->join('publish_novel_groups', 'novel_groups.id', '=', 'publish_novel_groups.novel_group_id')

//            ->where('publish_novel_groups', '!=', null);

//        $my_publish_novel_groups =
//            PublishNovelGroup::join('novel_groups', 'novel_groups.id', '=', 'publish_novel_groups.novel_group_id')
//                ->join('novel_group_publish_companies', 'novel_group_publish_companies.publish_novel_group_id', '=', 'publish_novel_groups.id')
//                ->join('companies', 'companies.id', '=', 'novel_group_publish_companies.company_id')
//                ->where('user_id', Auth::user()->id)->get();

        $companies = Company::get();
        return view('author.partnership.apply_list', compact('my_publish_novel_groups', 'companies'));
    }

    public function partner_manage_company()
    {
        $companies = Company::get();
        return view('author.partnership.manage_company', compact('companies'));
    }

    public function partner_create_company()
    {
        return view('author.partnership.create_company');
    }

    public function partner_edit_company($company_id)
    {
        $company = Company::where('id', $company_id)->first();
        return view('author.partnership.edit_company', compact('company'));
    }

    /**
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function partner_manage_apply($id = null)
    {

        $companies = Company::orderBy('name')->get();
        $apply_requests = NovelGroupPublishCompany::with('novel_groups.users')->with('publish_novel_groups')->with('companies');

        if ($id) {
            //  $apply_requests= PublishNovelGroup::with('novel_groups')->with('users')->with(['companies'=> function($q){ $q->where('company_id','2'); } ])->paginate(5);
//            $apply_requests = $apply_requests->whereHas('companies', function ($q) use ($id) {
//                    $q->where('companies.id', $id);
//            });
              $apply_requests->where('company_id',$id);

        }

        $apply_requests =$apply_requests->paginate(20);
        return view('author.partnership.manage_apply', compact('apply_requests', 'companies'));

    }

}
