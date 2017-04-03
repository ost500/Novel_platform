<?php

namespace App\Http\Controllers;

use App\Events\NewSpeedEvent;
use App\Piece;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Validator;

class PieceController extends Controller
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


        Piece::create($request->all());

        $gift_user = User::find($request->get('user_id'));

        $gift_user->piece = $gift_user->piece + $request->get('numbers');
        $gift_user->save();

        Auth::user()->bead = Auth::user()->bead - $request->get('numbers');
        Auth::user()->save();

        flash($gift_user->name . " 님에게 구슬을 선물했습니다.");
        

        event(new NewSpeedEvent("gift", "[구슬선물] " . Auth::user()->name . '님으로부터 구슬을 선물 받았습니다', route('my_info.received_gift'), "/front/imgs/thumb/alarm2.png", null, $gift_user->id));

        return response()->json(['message' => Auth::user()->name . '님에게 구슬을 선물했습니다.', 'status' => 'ok']);
    }
}
