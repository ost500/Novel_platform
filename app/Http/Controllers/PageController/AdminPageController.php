<?php

namespace App\Http\Controllers\PageController;

use App\Accusation;
use App\Calculation;
use App\CalculationEach;
use App\Configuration;
use App\NickName;
use App\Notification;
use App\NovelGroupPublishCompany;
use App\Company;
use App\Http\Controllers\Controller;
use App\Keyword;
use App\MailLog;
use App\PublishNovel;
use DateTime;
use Illuminate\Pagination\LengthAwarePaginator;
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
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;


class AdminPageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(Request $request)
    {

        if ($request->style == "simple") {
            return view('admin.index_simple');
        }

        return view('admin.index');
    }

    public function code_num()
    {
        return view('admin.index_simple');
    }

    public function recommendations()
    {
        $recommends = NovelGroup::where([['secret', '=', null], ['recommend_order', '<>', null]])->with('nicknames')->orderBy('recommend_order', 'asc')->take(5)->get();
        return view('admin.recommendations', compact('recommends'));
    }

    public function novel(Request $request)
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
        $users = User::paginate(config('define.pagination_long'));
        return view('admin.users', compact('users'));
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function request(Request $request)
    {
        $men_to_men_requests = MenToMenQuestionAnswer::orderBy('id', 'desc')->paginate(config('define.pagination_long'));
        // return \Response::json($men_to_men_requests);
        return view('admin.request', compact('men_to_men_requests'));
    }

    public function request_view(Request $request, $id)
    {
        $men_to_men_request = MenToMenQuestionAnswer::where('id', $id)->with('users')->first();
        $men_to_men_requests = MenToMenQuestionAnswer::orderBy('id', 'desc')->paginate(config('define.pagination_long'));
        return view('admin.request_view', compact('men_to_men_request', 'men_to_men_requests'));
    }

    public function memo(Request $request)
    {
        $novel_mail_messages = Auth::user()->maillogs()->with('mailboxs')->latest()->paginate(config('define.pagination_long'));
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
        $men_to_men_requests = $request->user()->maillogs()->with('mailboxs.users')->orderBy('id', 'desc')->paginate(config('define.pagination_long'));
        $page = $request->page;
//                return response()->json($men_to_men_request);
        return view('admin.mailbox_message', compact('men_to_men_request', 'men_to_men_requests', 'page'));
    }


    public function specific_mailbox_create($id = null)
    {
        if ($id) {
            $user = User::where('id', $id)->first();

        } else {
            $user = null;
        }
        return view('admin.specific_mail', compact('user'));

    }

    public function mailbox_send(Request $request)
    {
        $novel_mail_messages = Mailbox::where('from', Auth::user()->id)->with('users')->orderBy('created_at', 'desc')->paginate(config('define.pagination_long'));
        $page = $request->page;
//                return response()->json($novel_mail_messages);
        return view('admin.novel_memo_send', compact('novel_mail_messages', 'page'));
    }

    public function mailbox_send_message_show($id, Request $request)
    {

//        $mailbox_message = Mailbox::where('id', $id)->with('users')->first();
        $men_to_men_request = Mailbox::where('id', $id)->with('users')->with('maillogs.users')->with('novel_groups')->first();
        $men_to_men_requests = $request->user()->mailbox()->orderBy('id', 'desc')->paginate(config('define.pagination_long'));
        $page = $request->page;
        $maillog_page = $request->maillog_page;

        $mail_logs = MailLog::where('mailbox_id', $id)->with('users')->with('novel_groups')->paginate(config('define.pagination_long'), ["*"], "maillog_page");
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
    public function partner_manage_apply(Request $request, $id = null)
    {

        $companies = Company::orderBy('name')->get();
        $apply_requests = NovelGroupPublishCompany::select('publish_novel_groups.*', 'novel_group_publish_companies.*')->join('publish_novel_groups', 'publish_novel_groups.id', '=', 'novel_group_publish_companies.publish_novel_group_id')
            ->where('status', '!=', '신청하기')->with('publish_novel_groups.users')->with('publish_novel_groups.novel_groups')->with('companies');

//        return response()->json($apply_requests->get());
        if ($id) {
            $apply_requests->where('company_id', $id);
        }
        if ($request->order == "event") {
            $apply_requests->orderBy('event', 'desc');
        }

        $apply_requests = $apply_requests->paginate(config('define.pagination_long'));
        return view('admin.partnership.manage_apply', compact('apply_requests', 'companies'));

    }

    public function partner_test_inning(Request $request, $id = null)
    {

        $search = $request->get('search');

        //update today_done=0 to make company visible after days would be over
        // NovelGroupPublishCompany::where('today_done', '1')->whereDate('updated_at', '!=', Carbon::today()->toDateString())->update(['today_done' => 0]);
        $todays_done_publish_company = NovelGroupPublishCompany::where('today_done', '1')->whereDate('updated_at', '!=', Carbon::today()->toDateString())->get();
        $todays_done_publish_company->filter(function ($item) {
            $carbon_date = new Carbon($item->updated_at);
            if ($carbon_date->toDateString() == Carbon::today()->subDays($item->days)->toDateString()) {
                $item->today_done = 0;
                $item->save();
            }
        });

        //Get companies list
        $companies = Company::orderBy('name')->get();

        //whether show today's done or not [Today's done filter]

        $today_done = false;

        if ($id == 'today_done') {

            $today_done = true;
        }
        //where conditions based on search data
        if (!$search) { //if search is empty [default]
            $condition = [['status', '=', '승인'], ['today_done', $today_done]];

        } else {
            //otherwise search all
            $condition = ['status' => '승인'];
        }

        //get company wise published groups based on today's done
        $apply_requests = NovelGroupPublishCompany::where($condition)->with('publish_novel_groups.users')->with('publish_novel_groups.novel_groups')->with('companies');

        //[company id filter]
        if ($id != null and $id != 'today_done') {
            /*  $apply_requests= PublishNovelGroup::with('novel_groups')->with('users')->with(['companies'=> function($q){ $q->where('company_id','2'); } ])->paginate(5);
             $apply_requests = $apply_requests->whereHas('companies', function ($q) use ($id) {
                    $q->where('companies.id', $id);
             });*/
            $apply_requests->where('company_id', $id);

        }
        // dd($apply_requests->get());
        //Search by group name
        if ($search) {
            $apply_requests = $apply_requests->whereHas('publish_novel_groups.novel_groups', function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            });

        }

        $apply_requests = $apply_requests->paginate(config('define.pagination_long'));

//        return response()->json($apply_requests);
        /*  $apply_requests = $apply_requests->filter(function ($item) {
              if (checkPublishNovelGroup($item->publish_novel_group_id, $item->company_id)) {
                  return $item;
              }
          });
          $total= $apply_requests->count();
          $apply_requests = new LengthAwarePaginator($apply_requests,$total,10);*/
        // dd($apply_requests);
        return view('admin.partnership.test_inning', compact('apply_requests', 'companies', 'id'));

    }


    public function partner_approve_inning($id = null)
    {

        $apply_requests = PublishNovel::with('companies')->with('publish_novel_groups.novel_groups.users')->with('novels');


        $companies = Company::orderBy('name')->get();
//        $apply_requests = NovelGroupPublishCompany::where('status', '!=', '신청하기')->with('novel_groups.users')->with('publish_novel_groups')->with('companies');

        if ($id) {

            $apply_requests->where('company_id', $id)->where('status', '심사중');

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

    public function notifications()
    {
        $notis = Notification::latest()->paginate(config('define.pagination_long'));

        return view('admin.notification.notifications', compact('notis'));
    }

    public function notifications_create()
    {

        return view('admin.notification.create');
    }

    public function notifications_detail(Request $request, $id)
    {

        $noti = Notification::find($id);
        $notifications = Notification::latest()->paginate(config('define.pagination_long'));

        $page = $request->page;

        return view('admin.notification.detail', compact('noti', 'notifications', 'page'));
    }

    public function notifications_update($id)
    {
        $noti = Notification::find($id);

        return view('admin.notification.update', compact('noti'));
    }

    public function accusations()
    {
        $accus = Accusation::latest()->paginate(config('define.pagination_long'));

        return view('admin.accusation.accusations', compact('accus'));
    }

    public function accusations_detail(Request $request, $id)
    {
        $accu = Accusation::with('user')->with('accuUser')->findOrFail($id);

        $accus = Accusation::latest()->paginate(config('define.pagination_long'));

        $page = $request->page;

        $user = $accu->accuUser;

//        return response()->json($accu);

        return view('admin.accusation.detail', compact('accu', 'accus', 'page', 'user'));
    }

    public function calculation_create()
    {
        return view('admin.calculation.create');
    }

    public function calculation_edit($id)
    {
        $calculation = Calculation::where('id', $id)->first();
//dd($calculation);
//dd($calculation);
        return view('admin.calculation.edit', compact('calculation'));
    }

    public function calculations()
    {
        $cals = Calculation::paginate(config('define.pagination_long'));

        return view('admin.calculation.calculations', compact('cals'));
    }

    public function all_calculations(Request $request)
    {
        $nickname_id = $request->nickname_id;
        $novel_group_id = $request->novel_group_id;
        $year = $request->year;
        $month = $request->month;

        $myNovelGroups = NovelGroup::withCount('calculation_eaches');

        //Search Filters
        if ($nickname_id) {
            $myNovelGroups = $myNovelGroups->where('nickname_id', $nickname_id);
        }
        if ($novel_group_id) {
            $myNovelGroups = $myNovelGroups->where('id', $novel_group_id);
        }
        if ($year) {
            $myNovelGroups = $myNovelGroups->whereYear('created_at', $year);
            if ($month) {
                $myNovelGroups = $myNovelGroups->whereMonth('created_at', $month);
            }
        }


        $myNovelGroups = $myNovelGroups->paginate(config('define.pagination_long'));
//        return response()->json($myNovelGroups);
        //For drop downs
        $nicknames = NickName::select('id','nickname')->get();
        $allNovelGroups = NovelGroup::select(['id', 'title'])->get();
        $current_year = Carbon::now()->year;
        return view('admin.calculation.all_calculations', compact('myNovelGroups', 'nicknames', 'allNovelGroups', 'current_year','nickname_id', 'novel_group_id', 'year', 'month'));
    }


    public function calculation_eaches($id)
    {
        $calculation = Calculation::findOrFail($id);
        $calEaches = $calculation->calculation_eaches;

        $calculationColumnNames = explode(",", $calculation->column_names);
        $calEachesData = explode(",", $calculation->data);

        return view('admin.calculation.calculation_eaches', compact('calculation', 'calEaches', 'calculationColumnNames', 'calEachesData'));
    }

    public function calculation_create1()
    {

        $path = public_path() . '/excel/' . 'naver.xlsx';

        $newCalculation = Calculation::find(1);


        // fetch column names
        $newCalculation->column_names = str_replace(" ", "", $newCalculation->column_names);
        $newValueArray = explode(",", $newCalculation->column_names);

        Excel::load($path, function ($reader) use ($newCalculation, $newValueArray) {
            $objExcel = $reader->getExcel();
            $sheet = $objExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            // data name

            //  Read a row of data into an array
            $column = $newCalculation->columnX;
            $row = $newCalculation->columnY;
            // from columnX to $highestColumn
            $keyData = $sheet->rangeToArray($column . $row . ':' . $highestColumn . $row,
                NULL, TRUE, FALSE);


            print_r($newValueArray);
            $keys = array();
            $extraKeys = array();

            // result is $keyData[0]
            foreach ($keyData[0] as $key => $value) {
                if (in_array($value, $newValueArray)) {
                    // save keys which we need
                    $keys[] = $key;
                } else {
                    $extraKeys[] = $value;
                }
            }

//            print_r($keys);

            // from dataX to highestColumn
            // fetch all data
            for ($row = $newCalculation->dataY; $row <= $highestRow; $row++) {
                //  Read a row of data into an array
                echo 'A' . $row . ':' . $highestColumn . $row;
                $rowData = $sheet->rangeToArray($newCalculation->dataX . $row . ':' . $highestColumn . $row,
                    NULL, TRUE, FALSE);

                $excel[] = $rowData[0];
            }


            foreach ($excel as $rowData) {
                $newCalculationEach = new CalculationEach();
                $newCalculationEach->calculation_id = $newCalculation->id;
                $extraKeysIndex = 0;
//                print_r($rowData);
                foreach ($rowData as $key => $value) {


                    if (in_array($key, $keys)) {
                        // save keys which we need
                        $newCalculationEach->data = $newCalculationEach->data . $value . ",";
                    } else {
                        $newCalculationEach->extra_data = $newCalculationEach->extra_data . $extraKeys[$extraKeysIndex] . ":" . $value . ",";
                        $extraKeysIndex = $extraKeysIndex + 1;
                    }

//                    print_r($key . "=>" . $value . "\n");
//                    print_r(in_array($key, $keys));

                }
                print_r($newCalculationEach->extra_data . "\n");

                // erase last ","
                $newCalculationEach->data = rtrim($newCalculationEach->data, ",");
                $newCalculationEach->extra_data = rtrim($newCalculationEach->extra_data, ",");

                $newCalculationEach->save();

            }


//            for ($row = 1; $row <= $highestRow; $row++) {
//                //  Read a row of data into an array
//                echo 'A' . $row . ':' . $highestColumn . $row;
//                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
//                    NULL, TRUE, FALSE);
//
//                $excel[] = $rowData[0];
//            }

//            print_r($excel);
        })->get();


    }

    public function commissions()
    {
        $users = User::orderBy('commission', 'desc')->paginate(config('define.pagination_long'));
        $commission_default = Configuration::where('config_name', 'commission')->first()->config_value;
        return view('admin.commissions', compact('users', 'commission_default'));
    }

}
