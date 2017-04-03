<?php

namespace App\Http\Controllers;

use App\NovelGroupPublishCompany;
use Illuminate\Http\Request;

class NovelGroupPublishCompanyController extends Controller
{
    public function update(Request $request, $id)
    {
        $publish_company = NovelGroupPublishCompany::find($id);
        $publish_company->status = $request->status;
        if ($request->deny_reason) {
            //if deny_reason exists
            $publish_company->reject_reason = $request->deny_reason;
        }
        $publish_company->save();
        flash('상태가 '.$publish_company->status.'로 변경 되었습니다.');
        return response()->json(['data' => $request->status, 'status' => 'ok']);
    }

}
