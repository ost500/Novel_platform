<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
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
            'phone_num' => 'numeric',
            'email' => 'required|max:600',
            'bank' => 'max:600',
            'account_holder' => 'max:600',
            'account_number' => 'numeric',
        ], [
            'name.required' => '이름을 입력하세요',
            'name.max' => '이름이 너무 깁니다',
            'phone_num.max' => '연락처가 너무 깁니다',
            'phone_num.numeric' => '연락처는 숫자만 입력할 수 있습니다',

            'email.required' => '이메일을 입력하세요',
            'email.max' => '이메일이 너무 깁니다',
            'bank.max' => '은행명이 너무 깁니다',
            'account_holder.max' => '예금주가 너무 깁니다',
            'account_number.numeric' => '계좌번호는 숫자만 입력할 수 있습니다',
            'account_number.max' => '계좌번호가 너무 깁니다',

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
}
