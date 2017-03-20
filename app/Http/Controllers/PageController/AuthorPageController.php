<?php

namespace App\Http\Controllers\PageController;

use App\Calculation;
use App\CalculationEach;
use App\Company;
use App\Mailbox;
use App\MailLog;
use App\MenToMenQuestionAnswer;
use App\Novel;
use App\NovelGroup;
use App\Faq;
use App\NovelGroupPublishCompany;
use App\PublishNovelGroup;
use App\PurchasedNovel;
use App\User;
use App\Http\Controllers\Controller;
use App\ViewCount;
use Auth;
use App\Keyword;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\NovelGroupHashTag;
use App\Present;

class AuthorPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        if (Auth::user()->name == "Admin") {
            return redirect()->route('admin.index');
        }

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
        $hash_tags = Keyword::select('id', 'name')->where('category', '<>', '1')->get();
        /* $keyword3 = Keyword::select('id', 'name')->where('category', '3')->get();
         $keyword4 = Keyword::select('id', 'name')->where('category', '4')->get();
         $keyword5 = Keyword::select('id', 'name')->where('category', '5')->get();
         $keyword6 = Keyword::select('id', 'name')->where('category', '6')->get();
         $keyword7 = Keyword::select('id', 'name')->where('category', '7')->get();*/

        return view('author.create', compact('keyword1', 'hash_tags'));
    }

    public function create_inning($id)
    {
        $novel_group = NovelGroup::find($id);
        return view('author.novel_inning_write', compact('novel_group'));
    }

    public function show_inning($novel_id)
    {

        $novel = Novel::where('id', $novel_id)->first();

        $today_count = $novel->today_count = $novel->today_count + 1;
        $this_week_count = $novel->week_count = $novel->week_count + 1;
        $this_month_count = $novel->month_count = $novel->month_count + 1;
        $this_year_count = $novel->year_count = $novel->year_count + 1;
        $this_total_count = $novel->total_count = $novel->total_count + 1;
        $novel->save();


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

    public function edit(Request $request, $id)
    {
        // $novel_group=NovelGroup::find($id);
        //  return view('author.edit', compact('novel_group','id'));
        $novel_group = NovelGroup::where('id', $id)->with('nicknames', 'keywords', 'hash_tags')->first();
        $nicknames = $request->user()->nicknames()->get();
        $selected_hash_tags = NovelGroupHashTag::select('tag')->where('novel_group_id', $id)->get();

        $keyword1 = Keyword::select('id', 'name')->where('category', '1')->get();
        $hash_tag_keywords = Keyword::select('id', 'name')->where('category', '<>', '1')->get();
        return view('author.edit', compact('novel_group', 'nicknames', 'selected_hash_tags', 'keyword1', 'hash_tag_keywords'));
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
        $novel_mail_messages = Auth::user()->maillogs()->with('mailboxs')->latest()->paginate(2);
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

        $my_novel_groups = NovelGroup::where('user_id', Auth::user()->id)->with('publish_novel_groups')->get();


        return view('author.partnership.apply', compact('companies', 'my_novel_groups'));
    }

    public function partner_apply_proper_company(Request $request)
    {


        $exclude_company = NovelGroup::find($request->novel_group);

        $companies = Company::get();

        $exclude = [];

        //if the novel group includes adult version then exclude adult not allowed company

        // 2017-02-21 changed, every novel_groups can be applied even though it is an adult one

//        if ($exclude_company->novels->where('adult', 1)->count()) {
//            $exclude_adult = Company::where('adult', 1)->pluck('id');
//            foreach ($exclude_adult as $adult) {
//                $exclude[] = $adult;
//            }
//        }

        //if the novel_group already published other company, check it out
        if ($exclude_company->publish_novel_groups != null) {
            $exclude_published_company = $exclude_company->publish_novel_groups->companies;
            //companies which already published are stored into $exclude
            foreach ($exclude_published_company as $company) {
                $exclude[] = $company->id;
            }
        }

        //if count of novels are less than initail_inning of the company
        foreach ($companies as $company) {
            if ($exclude_company->novels->count() < $company->initial_inning) {
                $exclude[] = $company->id;
            }
        }


        //exclude that
        $companies = Company::whereNotIn('id', $exclude)->get();

        return response()->json($companies);
    }

    public function partner_apply_list(Request $request)
    {

        $my_publish_novel_groups = NovelGroupPublishCompany::select('publish_novel_groups.*', 'novel_group_publish_companies.*')->join('publish_novel_groups', 'publish_novel_groups.id', '=', 'novel_group_publish_companies.publish_novel_group_id')
            ->where('user_id', Auth::user()->id)->with('publish_novel_groups.novel_groups')
            ->with('companies')
            ->get();
//        return response()->json($my_publish_novel_groups);

        if ($request->order == 1) {
            //order by novel_group name
            $my_publish_novel_groups = $my_publish_novel_groups->sortBy('publish_novel_groups.novel_groups.title');
        } elseif ($request->order == 2) {
            $my_publish_novel_groups = $my_publish_novel_groups->sortBy('companies.name');
        } elseif ($request->order == 3) {
            $my_publish_novel_groups = $my_publish_novel_groups->sortBy('status');
        }


        return view('author.partnership.apply_list', compact('my_publish_novel_groups', 'companies'));
    }


    public function partner_proceed($id = null)
    {
        $companies = Company::orderBy('name')->get();
        $apply_requests = NovelGroupPublishCompany::where('status', '승인')->with('novel_groups.users')->with('publish_novel_groups')->with('companies');

        if ($id) {
            //  $apply_requests= PublishNovelGroup::with('novel_groups')->with('users')->with(['companies'=> function($q){ $q->where('company_id','2'); } ])->paginate(5);
//            $apply_requests = $apply_requests->whereHas('companies', function ($q) use ($id) {
//                    $q->where('companies.id', $id);
//            });
            $apply_requests->where('company_id', $id);

        }

        $apply_requests = $apply_requests->paginate(20);
        return view('author.partnership.proceed', compact('apply_requests', 'companies'));
    }

    public function partner_test_inning(Request $request, $id = null)
    {

        $search = $request->get('search');

        //update today_done=0 to make group visible
        /* NovelGroupPublishCompany::where('today_done', '1')->whereDate('updated_at', '!=', Carbon::today()->toDateString())->update(['today_done' => 0]);*/

        //Get companies list
        $companies = Company::orderBy('name')->get();

        // [Stop filter]

        $stop = false;

        if ($id == 'stopped') {

            $stop = true;
        }
        //where conditions based on search data
        if (!$search) { //if search is empty [default]
            $condition = [['status', '=', '승인'], ['stop', $stop]];

        } else {
            //otherwise search all
            $condition = ['status' => '승인'];
        }

        //get company wise published groups based on today's done
        $apply_requests = NovelGroupPublishCompany::where($condition)->with('publish_novel_groups.users')->with('publish_novel_groups.novel_groups')->with('companies');

        //[company id filter]
        if ($id != null and $id != 'stopped') {
            $apply_requests->where('company_id', $id);
        }

        //Search by group name
        if ($search) {
            $apply_requests = $apply_requests->whereHas('publish_novel_groups.novel_groups', function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            });

        }

        $apply_requests = $apply_requests->paginate(10);

//        return response()->json($apply_requests);
        /* $apply_requests = $apply_requests->filter(function ($item) {
             if (checkPublishNovelGroup($item->publish_novel_group_id, $item->company_id)) {
                 return $item;
             }
         });
         $total= $apply_requests->count();
         $apply_requests = new LengthAwarePaginator($apply_requests,$total,10);*/
        // dd($apply_requests);
        return view('author.partnership.test_inning', compact('apply_requests', 'companies', 'id'));

    }

    public function calculations()
    {

        $myNovelGroups = NovelGroup::where('user_id', Auth::user()->id)->withCount('calculation_eaches')->paginate(config('define.pagination_long'));
//        return response()->json($myNovelGroups);
        return view('author.calculations', compact('myNovelGroups'));
    }

    public function calculations_detail($code_num)
    {
        if (NovelGroup::where('code_number', $code_num)->first()->user_id != Auth::user()->id) {
            return response()->view('errors.503', [], 500);
        }

        $myCalculationEachs = Calculation::whereHas('calculation_eaches', function ($q) use ($code_num) {
            $q->where('code_number', $code_num);

        })
            ->with(['calculation_eaches' => function ($query) use ($code_num) {
                $query->where('code_number', $code_num);
            }])->paginate(config('define.pagination_long'));


        if ($myCalculationEachs->first() != null) {
            $myCalculations = $myCalculationEachs->first()->calculations;
        } else {
            $myCalculations = null;
        }


//        return response()->json($myCalculationEachs);

        return view('author.calculations_detail', compact('myCalculationEachs', 'myCalculations', 'code_num'));
    }

    public function benefit()
    {
        $myPurchasedNovel = PurchasedNovel::join('novels', 'novels.id', '=', 'purchased_novels.id')
            ->join('novel_groups', 'purchased_novels.user_id', '=', 'novel_groups.id')
            ->join('users', 'novels.novel_group_id', '=', 'users.id')
            ->selectRaw('novels.title as n_title, novel_groups.title as ng_title, users.name, method')
            ->where('novels.user_id', Auth::user()->id)->paginate(config('define.pagination_long'));

//        return response()->json($myPurchasedNovel);

        return view('author.benefit', compact('myPurchasedNovel'));

    }

    public function send_gift()
    {
        $user_bead = User::select('bead')->where('id', Auth::user()->id)->first();
        return view('author.send_gift', compact('user_bead'));
    }

    public function sent_gifts()
    {
        $presents = Present::where('from_id', Auth::user()->id)->latest()->paginate(config('define.pagination_long'));

        $user_bead = User::select('bead')->where('id', Auth::user()->id)->first();

        return view('author.sent_gifts', compact('presents', 'user_bead'));
    }


}
