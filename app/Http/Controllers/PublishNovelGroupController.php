<?php

namespace App\Http\Controllers;

use App\Company;
use App\Novel;
use App\NovelGroup;
use App\NovelGroupPublishCompany;
use App\PublishNovel;
use App\PublishNovelGroup;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Pagination\LengthAwarePaginator;

class PublishNovelGroupController extends Controller
{
    public function store(Request $request)
    {

        Validator::make($request->all(), [
            'initial_publish' => 'required',
            'novel_group' => 'required',
            'days' => 'required',
            'novels_per_days' => 'required',
        ], [
            'initial_publish.required' => '초기연재편수를 선택하세요',
            'novel_group.required' => '작품을 선택하세요',
            'days.required' => '일(날짜)를 입력하세요',
            'novels_per_days.required' => '편수를 입력하세요',
        ])->validate();


        $companies = Company::get();
        //company condition validation check
        $novel_group = NovelGroup::find($request->novel_group);
        foreach ($companies as $company) {
            if ($request->input('company' . $company->id)) {

                $novel_group_has_adult = Novel::where('novel_group_id', $novel_group->id)->where('adult', 1)->exists();
                // check novel_group has adult or not

                if ($company->initial_inning > $novel_group->novels->count()) {
                    $initial_inning_errors = ['initial_inning' => "연재업체 " . $company->name . "는 초기연재 " . $company->initial_inning . "회를 요구합니다. "];

                    return response()->json($initial_inning_errors, 422);
                }
                if ($company->adult == 1 && $novel_group_has_adult) {
                    $adult_errors = ['adult' => "연재업체 " . $company->name . "는 19금 작품 제휴가 불가능 합니다"];
                    return response()->json($adult_errors, 422);
                }
            }
        }

        //publish novel group generated
        $new_publish_novel_group = PublishNovelGroup::where('novel_group_id', $request->novel_group);

        if ($new_publish_novel_group->count() == 0) {
            $new_publish_novel_group = new PublishNovelGroup();
            $new_publish_novel_group->novel_group_id = $request->novel_group;
            $new_publish_novel_group->user_id = Auth::user()->id;

            $new_publish_novel_group->save();
        } else {
            $new_publish_novel_group = $new_publish_novel_group->first();
        }


        $companies = Company::get();
        //novel group publish company
        foreach ($companies as $company) {
            //only for selected companies
            if ($request->input('company' . $company->id)) {
                $new_novel_group_publish_company = new NovelGroupPublishCompany();
                $new_novel_group_publish_company->publish_novel_group_id = $new_publish_novel_group->id;
                $new_novel_group_publish_company->company_id = $company->id;
                $new_novel_group_publish_company->days = $request->days;
                $new_novel_group_publish_company->novels_per_days = $request->novels_per_days;
                $new_novel_group_publish_company->initial_novels = $request->initial_publish;
                $new_novel_group_publish_company->status = "대기중";
                $new_novel_group_publish_company->event = $request->event;
                $new_novel_group_publish_company->save();
            }

        }
//        return redirect()->route('author.partner_apply_list');
        return "OK";

    }

    public function apply_each_company($novel_group_publish_company_id, Request $request)
    {

        Validator::make($request->all(), [
            'initial_inning' => 'required|numeric',
            'days' => 'required|numeric',
            'novels_per_days' => 'required|numeric',
        ], [
            'initial_inning.required' => '초기연재편수를 입력하세요',
            'initial_inning.numeric' => '숫자를 선택하세요',
            'days.required' => '일(날짜)를 입력하세요',
            'days.numeric' => '숫자를 입력하세요',
            'novels_per_days.required' => '편수를 입력하세요',
            'novels_per_days.numeric' => '숫자를 입력하세요',
        ])->validate();

        $put_NGPC = NovelGroupPublishCompany::find($novel_group_publish_company_id);
        $put_NGPC->days = $request->days;
        $put_NGPC->initial_novels = $request->initial_inning;
        $put_NGPC->novels_per_days = $request->novels_per_days;
        $put_NGPC->status = "심사중";
        $put_NGPC->save();
//        return redirect()->back();
    }

    public function show_novels(Request $request)
    {
        // $novel_group = PublishNovelGroup::find($publish_novel_group_id)->novels()->with('companies')->get();
        // $novels= Novel::where('novel_group_id',$publish_novel_group_id)->with('publish_novels')->get();
        $company_id = $request->company_id;
        $publish_novel_group_id = $request->publish_novel_group_id;
        $novel_group_id = $request->novel_group_id;
        $publish_company_id = $request->publish_company_id;

        //get novels from a specific group_id amd company_id along with publish novels
        $novels = Novel::where('novel_group_id', $request->novel_group_id)
            ->with(['publish_novels' => function ($q) use ($company_id, $publish_novel_group_id) {
                $q->where(['company_id' => $company_id, 'publish_novel_group_id' => $publish_novel_group_id]);
            }])->get();

        //get $publish_company data[days and novel_per_days] for a specific group_id amd company_id [will be used for date suggestion]
        $publish_company = NovelGroupPublishCompany::where(['publish_novel_group_id' => $publish_novel_group_id, 'company_id' => $company_id])->first();
        $novels_per_days = $publish_company->novels_per_days;

        //get the latest published date[i.e updated_at] for a a specific group_id amd company_id
        $publish_date = PublishNovel::select('updated_at')->latest('updated_at')->where(['publish_novel_group_id' => $publish_novel_group_id, 'company_id' => $company_id])->first();

        /*
         *new publishing date [i.e. suggestion]
         *if $publish_date exists then create new publishing date [i.e. suggestion] otherwise set new publishing date to empty
        */
        if (count($publish_date) > 0) {
            // if $publish_date is not same as today then set the publish_date to today'date otherwise keep the original
            if ($publish_date->updated_at->toDateString() != Carbon::now()->toDateString()) {
                $set_publish_date = Carbon::now()->toDateString();
            } else {
                $set_publish_date = $publish_date->updated_at;
            }
            //create the new publishing date [suggestion date] by adding the days [from $publish_company] to previous publish date
            $carbon_publish_date = new Carbon($set_publish_date);
            $new_publish_date = $carbon_publish_date->addDays($publish_company->days);
        } else {
            $new_publish_date = '';
        }

        //create the array of all new publishing dates [suggestion dates] which will have suggestion date for each  novel per day
        $publish_array = array();
        $index = 1;
        //set the next limit[$next_limit] up to where suggestion is to be shown based on novels per day
        $next_limit = $novels_per_days + $publish_company->novels_per_days;

        //set the suggestion for novels based on $next_limit index [suggestion is used for showing color]
        foreach ($novels as $novel) {
            //up to novels per day
            if ($index <= $novels_per_days) {
                //if publish novel exists for the current novel  the set the suggestion date
                if (count($publish_date) > 0 && count($novel->publish_novels) > 0) {
                    // if $publish_date is not same as today then set the suggestion to today'date otherwise set from db
                    if ($publish_date->updated_at->toDateString() != Carbon::now()->toDateString()) {
                        $publish_array[$novel->id] = ['date'=> Carbon::today(),'suggestion'=>0];


                    } else {
                        $publish_array[$novel->id] =['date'=> $publish_date->updated_at,'suggestion'=>0];
                    }

                } else {
                    //if publish novel don't exists for first novel the set the suggestion date to today's date [up to novels per day]
                    $publish_array[$novel->id]=['date'=> Carbon::today(),'suggestion'=>0];
                }

            } else { //for remaining novels
                //increase the next limit [ up to where  suggestion is to be shown] if publish novel exists for the current novel
                if (count($novel->publish_novels) > 0) {
                    $next_limit = $next_limit + 1;
                }
                //now up to the  next limit  set the  new publishing date [or suggestion date] fot current novel
                if ($index <= $next_limit) {
                    $publish_array[$novel->id] =['date'=> $new_publish_date,'suggestion'=>1];

                } else {
                    //if limit is over then set date and suggestion to empty
                    $publish_array[$novel->id]=['date'=>'','suggestion'=>''];
                }
            }
            //increase the default index
            $index = $index + 1;

        }

        if (Auth::user()->name == "Admin") {
            return view('admin.partnership.novels', compact('novels', 'company_id', 'novel_group_id', 'publish_company_id', 'publish_novel_group_id', 'publish_array'));
        }

        return view('author.partnership.novels', compact('novels', 'company_id', 'novel_group_id', 'publish_company_id', 'publish_novel_group_id', 'publish_array'));
    }

    public function today_done(Request $request)
    {
        // $novel_group = PublishNovelGroup::find($publish_novel_group_id)->novels()->with('companies')->get();
        NovelGroupPublishCompany::where('id', $request->publish_company_id)->update(['today_done' => 1]);
        return \Response::json(['status' => 'ok']);
        //return view('admin.partnership.novels',compact('novels','company_id','publish_novel_group_id','publish_company_id'));
    }

    public function stop(Request $request)
    {
        NovelGroupPublishCompany::where('id', $request->publish_company_id)->update(['stop' => 1]);
        return \Response::json(['status' => 'ok']);
    }

}
