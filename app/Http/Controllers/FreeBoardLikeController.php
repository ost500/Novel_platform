<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\FreeBoardLike;

class FreeBoardLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {

        $request->user()->free_board_likes()->create([
            'user_id' => Auth::user()->id,
            'free_board_id' => $request->get('free_board_id')
        ]);
      //  flash('�����Խ��� ���� ���������� ��� �Ǿ����ϴ�');
        return response()->json(['success' => 'ok']);
    }

    public function destroy($id)
    {

        FreeBoardLike::where(['user_id' => Auth::user()->id, 'free_board_id' => $id])->delete();
        return response()->json('success');

    }
}
