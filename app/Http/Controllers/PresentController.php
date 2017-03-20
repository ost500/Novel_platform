<?php

namespace App\Http\Controllers;

use App\Present;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\User;
class PresentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'user_id' => 'required',
            'content' => 'required',
            'numbers' => 'required|numeric',

        ], [
            'user_id.required' => '받는사람은 필수 입니다.',
            'content.required' => '전할문구는 필수 입니다.',
            'numbers.required' => '선물할 구슬 개수를 입력하세요.',
            'numbers.numeric' => '숫자만 입력 가능합니다.',


        ])->validate();


        Present::create([
            'from_id'=>Auth::user()->id,
            'user_id'=>$request->get('user_id'),
            'content'=>$request->get('content'),
            'numbers'=>$request->get('numbers'),

        ]);

        //Update the beads anf pieces
        $gift_user = User::find($request->get('user_id'));

        $gift_user->piece = $gift_user->piece + $request->get('numbers');
        $gift_user->save();

        Auth::user()->bead = Auth::user()->bead - $request->get('numbers');
        Auth::user()->save();

        flash(Auth::user()->name . " 님에게 구슬을 선물했습니다.");

        return response()->json(['message' => Auth::user()->name . '님에게 구슬을 선물했습니다.', 'status' => 'ok']);
    }
    
    public function update(Request $request, $id)
    {
         $present = Present::find($id);
         $present->status=$request->status;
         $present->save();

        flash('받으신 선물을 '. $present->status.'했습니다.');
        return response()->json(['data' => $request->status, 'status' => 'ok']);
    }
}
