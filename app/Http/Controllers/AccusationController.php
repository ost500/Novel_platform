<?php

namespace App\Http\Controllers;

use App\Accusation;
use Auth;
use Illuminate\Http\Request;
use Validator;

class AccusationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'accu_id' => 'required',
            'title' => 'required|max:2000',
            'category' => 'required',
            'contents' => 'required|max:2000',
        ],
            [
                'accu_id.required' => '신고 경로가 올바르지 않습니다. 다시 처음부터 시도해 주세요.',
                'title.required' => '제목은 필수 입니다.',
                'title.max' => '제목은 반드시 2000 자리보다 작아야 합니다.',
                'category.required' => '신고 유형은 필수 입니다.',
                'content.max' => '내용은 반드시 2000 자리보다 작아야 합니다.',
                'content.required' => '내용은 필수 입니다.',
            ]
        )->validate();

        $newAccu = new Accusation();
        $newAccu->user_id = Auth::user()->id;
        $newAccu->accu_id = $request->accu_id;
        $newAccu->title = $request->title;
        $newAccu->category = $request->category;
        $newAccu->contents = $request->contents;
        $newAccu->save();

        flash('성공적으로 신고했습니다');

        return redirect()->back();
    }
}
