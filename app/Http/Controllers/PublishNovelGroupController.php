<?php

namespace App\Http\Controllers;

use App\Company;
use App\Novel;
use App\NovelGroup;
use App\NovelGroupPublishCompany;
use App\PublishNovel;
use App\PublishNovelGroup;
use Auth;
use Illuminate\Http\Request;
use Validator;

class PublishNovelGroupController extends Controller
{
    public function store(Request $request)
    {

        print_r($request->all());
        print_r($request->companies);

        $vali = Validator::make($request->all(), [
            'novel_group' => 'required',
            'days' => 'required',
            'novels_per_days' => 'required',
        ], [
            'novel_group.required' => '작품을 선택하세요',
            'days.required' => '일(날짜)를 입력하세요',
            'novels_per_days.required' => '편수를 입력하세요',
        ]);


        $vali->validate();

        $companies = Company::get();
        //company condition validation check
        $novel_group = NovelGroup::find($request->novel_group);
        foreach ($companies as $company) {
            if ($request->input('company' . $company->id)) {

                $novel_group_has_adult = Novel::where('novel_group_id', $novel_group->id)->where('adult', 1)->exists();
                // check novel_group has adult or not

                if ($company->initial_inning > $novel_group->novels->count()) {
                    $errors = array(["연재업체 " . $company->name . "는 초기연재 " . $company->initial_inning . "회를 요구합니다. "]);

                    return redirect()->back()->withInput()->withErrors($errors);
                }
                if ($company->adult == 1 && $novel_group_has_adult) {
                    $errors = array(["연재업체 " . $company->name . "는 19금 작품 제휴가 불가능 합니다"]);
                    return redirect()->back()->withInput()->withErrors($errors);
                }
            }
        }


        $new_publish_novel_group = new PublishNovelGroup();
        $new_publish_novel_group->novel_group_id = $request->novel_group;
        $new_publish_novel_group->user_id = Auth::user()->id;
        $new_publish_novel_group->days = $request->days;
        $new_publish_novel_group->novels_per_days = $request->novels_per_days;
        $new_publish_novel_group->save();
        //publish novel group generated


        $companies = Company::get();
        //novel group publish company
        foreach ($companies as $company) {
            $new_novel_group_publish_company = new NovelGroupPublishCompany();
            $new_novel_group_publish_company->publish_novel_group_id = $new_publish_novel_group->id;
            $new_novel_group_publish_company->company_id = $company->id;
            if ($request->input('company' . $company->id)) {
                $new_novel_group_publish_company->status = "심사중";
            } else {
                $new_novel_group_publish_company->status = "신청하기";
            }
            $new_novel_group_publish_company->save();

        }
        return redirect()->route('author.partner_apply_list');

    }

    public function apply_each_company($novel_group_publish_company_id)
    {
        $put_NGPC = NovelGroupPublishCompany::find($novel_group_publish_company_id);
        $put_NGPC->status = "심사중";
        $put_NGPC->save();
//        return redirect()->back();
    }

    public function show_novels($publish_novel_group_id,$company_id,$publish_company_id )
    {
       // $novel_group = PublishNovelGroup::find($publish_novel_group_id)->novels()->with('companies')->get();
        $novels= Novel::where('novel_group_id',$publish_novel_group_id)->get();
        //return \Response::json($novels);
        return view('admin.partnership.novels',compact('novels','company_id','publish_novel_group_id','publish_company_id'));
    }

}
