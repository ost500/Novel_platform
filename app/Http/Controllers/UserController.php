<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use App\User;
use Auth;
use Carbon\Carbon;
use Exception;
use Hash;
use Illuminate\Http\Request;
use Mail;
use Session;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('auth');
        $user = Auth::user();
        return response()->json($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|max:600',
            'phone_num' => 'digits_between:0,20',
            'email' => 'required|max:600',
            'bank' => 'max:600',
            'account_holder' => 'max:600',
            'account_number' => 'digits_between:0,20',
        ], [
            'name.required' => '이름을 입력하세요',
            'name.max' => '이름이 너무 깁니다',
            'phone_num.digits_between' => '연락처가 너무 깁니다',
            'phone_num.numeric' => '연락처는 숫자만 입력할 수 있습니다',

            'email.required' => '이메일을 입력하세요',
            'email.max' => '이메일이 너무 깁니다',
            'bank.max' => '은행명이 너무 깁니다',
            'account_holder.max' => '예금주가 너무 깁니다',
            'account_number.numeric' => '계좌번호는 숫자만 입력할 수 있습니다',
            'account_number.digits_between' => '계좌번호가 너무 깁니다',

        ])->validate();

        $user = Auth::user();
        $user->name = $request->name;
        $user->phone_num = $request->phone_num;
        $user->email = $request->email;
        $user->bank = $request->bank;
        $user->account_holder = $request->account_holder;
        $user->account_number = $request->account_number;
        $user->save();
//        return response()->json($request);
    }

    public function my_info_update(Request $request)
    {


        $user = Auth::user();


        if ($request->password != null && $request->current_password != null) {

            Validator::make($request->all(), [
                'password' => 'min:6|confirmed',

            ], [
                'password.min' => '비밀번호는 6자리 이상만 가능합니다',
                'password.confirmed' => '비밀번호가 일치하지 않습니다',

            ])->validate();

            //request of password and current_password exist
            //check the password
            if (Hash::check($request->current_password, $user->password)) {
                //if it is right
                $user->password = bcrypt($request->password);
            } else {
                // if it is not
                $error = ['current_password' => "비밀번호가 일치하지 않습니다."];
                return redirect()->back()->withErrors($error);
            }
        }


        if ($user->nickname != $request->nickname) {
            Validator::make($request->all(), [
                'nickname' => 'min:1|max:8',
            ], [
                'nickname.min' => '닉네임은 1자리 이상만 가능합니다',
                'nickname.max' => '닉네임은 8자리 이하만 가능합니다',
            ])->validate();


            // if nickname refreshed
            if ($user->nickname_at > Carbon::now()->addMonth(1) || $user->nickname_at == null) {
                // if nickname edited time took more than 1 month || nickname first changed
                $user->nickname = $request->nickname;
                $user->nickname_at = Carbon::now();
            } else {
                // else editing now allowed
                $error = ['nickname' => "닉네임은 2회부터 30일에 한번만 변경 가능합니다"];
                return redirect()->back()->withErrors($error);
            }
        }

        $user->comment_show = $request->comment_show;
        $user->mail_available = $request->mail_available;
        $user->event_mail_available = $request->event_mail_available;

        $user->save();
        flash('성공적으로 정보를 변경했습니다');
        return redirect()->back();
//        return response()->json($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update_agreement(Request $request)
    {
        $user = Auth::user();

        $user->author_agreement = $request->author_agreement;
        $user->save();
        return response()->json($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function member_leave(Request $request)
    {
        Validator::make($request->all(), [
            'password' => 'required',
        ], [
            'password.required' => '비밀번호를 입력해 주세요'
        ])->validate();

        if (Hash::check($request->password, Auth::user()->password)) {
            Auth::user()->delete();
            flash('회원 탈퇴 했습니다');
            return redirect()->route('root');
        }

        $error = ['password' => "비밀번호가 일치하지 않습니다."];

        return redirect()->back()->withErrors($error);


    }

    public function confirm($confirmation_code, $user_id)
    {
        if (!$confirmation_code) {
            return view('errors.503');
        }

//        $user = User::where('auth_mail_code', $confirmation_code)->get()->first();
        $user = User::findOrFail($user_id);

        if ($user->auth_mail_code == $confirmation_code) {
            $user->auth_email = 1;
            $user->auth_mail_code = null;
            $user->save();
            flash('이메일 인증에 성공했습니다. 로그인해 주세요');
            if (Auth::check()) {
                return redirect()->route('my_info.edit');
            } else {
                return redirect()->route('root', ['login' => $user->name]);
            }

        } else {
            return view('errors.503');
        }

    }

    public function again()
    {
        try {
            $user = Auth::user();

            Mail::to($user)->send(new VerifyEmail($user));

            return view('auth.auth_mail_send', compact('user'));

        } catch (Exception $e) {
            return view('errors.503');
        }

    }
}
