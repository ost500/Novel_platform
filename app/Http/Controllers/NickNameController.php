<?php

namespace App\Http\Controllers;

use App\NickName;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

class NickNameController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nicknames = Auth::user()->nicknames;

        return response()->json($nicknames);
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

        Validator::make($request->all(), [
            'nickname' => 'required|max:255',
        ], [
            'nickname.required' => '입력하세요',
            'nickname.max' => '필명이 너무 깁니다',
        ])->validate();

        $new_nickname = new NickName();
        $new_nickname->user_id = Auth::user()->id;
        $new_nickname->nickname = $request->nickname;
        $new_nickname->save();

        if ($request->main) {
            $new_nickname->nick_main(Auth::user()->id, $new_nickname->id);
        }

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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        Validator::make($request->all(), [
            'nickname' => 'required|max:255',
        ], [
            'nickname.required' => '입력하세요',
            'nickname.max' => '필명이 너무 깁니다',
        ])->validate();


        echo $request->has('nickname');
        echo $request->nickname;
        echo $id;

        if ($request->has('nickname')) {
            $update_nick = NickName::find($id);
            $update_nick->nickname = $request->nickname;
            $update_nick->save();
            return;
        }
        //메인으로 바꾸기용
        $new_nick = new NickName();
        $new_nick->nick_main(Auth::user()->id, $id);
        //nick_main 은 해당 유저(Auth::user()->id) 에 $id 값에 해당하는 닉네임을 메인으로 바꾼다
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del_nick = NickName::find($id);
        $del_nick->delete();
    }
}
