<?php

namespace App\Http\Controllers;

use App\Piece;
use App\User;
use Illuminate\Http\Request;
use Auth;

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

        Piece::create($request->all());

        $gift_user = User::find($request->get('user_id'));

        $gift_user->piece = $gift_user->piece + $request->get('numbers');
        $gift_user->save();

        Auth::user()->bead = Auth::user()->bead - $request->get('numbers');
        Auth::user()->save();

        flash('Gift!!');
        return redirect()->route('my_info.sent_gift');
        /*return response()->json(['data' => $request->status, 'status' => 'ok']);*/
    }
}
