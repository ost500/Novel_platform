<?php

namespace App\Http\Controllers;

use App\Company;
use App\NovelGroupPublishCompany;
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

        Validator::make($request->all(), [
            'novel_group' => 'required',
            'days' => 'required',
            'novels_per_days' => 'required',
        ], [
            'novel_group.required' => '작품을 선택하세요',
            'days.required' => '일(날짜)를 입력하세요',
            'novels_per_days.required' => '편수를 입력하세요',
        ])->validate();

        $new_publish_novel_group = new PublishNovelGroup();
        $new_publish_novel_group->novel_group_id = $request->novel_group;
        $new_publish_novel_group->user_id = Auth::user()->id;
        $new_publish_novel_group->days = $request->days;
        $new_publish_novel_group->novels_per_days = $request->novels_per_days;
        $new_publish_novel_group->save();

        $companies = Company::get();
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
}
