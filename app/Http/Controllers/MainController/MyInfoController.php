<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Validator;

class MyInfoController extends Controller
{
    public function password_again()
    {
        return view('main.my_page.my_info.password_again');
    }
    public function member_leave_password_again()
    {
        return view('main.my_page.my_info.member_leave_password_again');
    }

    public function password_again_post(Request $request)
    {
        Validator::make($request->all(), [
            'password' => 'required',
        ], [
            'password.required' => '비밀번호를 입력해 주세요'
        ])->validate();

        if (Hash::check($request->password, Auth::user()->password)) {
            return redirect()->route('my_info.edit');
        }

        $error = ['password' => "비밀번호가 일치하지 않습니다."];

        return redirect()->back()->withErrors($error);

    }

    public function edit(Request $request)
    {
        $me = Auth::user();

        return view('main.my_page.my_info.edit', compact('me'));
    }
}
