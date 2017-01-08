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
            'phone_num' => 'digits_between:0,20',
            'email' => 'required|max:600',
            'bank' => 'max:600',
            'account_holder' => 'max:600',
            'account_number' => 'digits_between:0,20',
        ], [
            'name.required' => '�씠由꾩쓣 �엯�젰�븯�꽭�슂',
            'name.max' => '�씠由꾩씠 �꼫臾� 源곷땲�떎',
            'phone_num.digits_between' => '�뿰�씫泥섍� �꼫臾� 源곷땲�떎',
            'phone_num.numeric' => '�뿰�씫泥섎뒗 �닽�옄留� �엯�젰�븷 �닔 �엳�뒿�땲�떎',

            'email.required' => '�씠硫붿씪�쓣 �엯�젰�븯�꽭�슂',
            'email.max' => '�씠硫붿씪�씠 �꼫臾� 源곷땲�떎',
            'bank.max' => '���뻾紐낆씠 �꼫臾� 源곷땲�떎',
            'account_holder.max' => '�삁湲덉＜媛� �꼫臾� 源곷땲�떎',
            'account_number.numeric' => '怨꾩쥖踰덊샇�뒗 �닽�옄留� �엯�젰�븷 �닔 �엳�뒿�땲�떎',
            'account_number.digits_between' => '怨꾩쥖踰덊샇媛� �꼫臾� 源곷땲�떎',

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
