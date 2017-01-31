<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class FreeBoardController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Validator::make($request->all(), [
            'title' => 'required|max:255',
            'content' => 'required',
        ], [
            'title.required' => '제목은 필수 입니다.',
            'title.max' =>   '제목은 반드시 255 자리보다 작아야 합니다.',
            'content.required' => '내용은 필수 입니다.',

        ])->validate();

        $request->user()->free_boards()->create($request->all());
        flash('자유게시판 글이 성공적으로 등록 되었습니다');
        return redirect()->route('free_board');
    }

}
