<?php

namespace App\Http\Controllers;

use App\NovelGroupPublishCompany;
use Illuminate\Http\Request;

class NovelGroupPublishCompanyController extends Controller
{
    public function update(Request $request,$id)
    {
        $publish_company=NovelGroupPublishCompany::find($id);
        $publish_company->status=$request->status;
        $publish_company->save();
        return response()->json(['data'=>$request->status,'status'=>'ok']);
    }

}
