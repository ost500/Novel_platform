<?php

namespace App\Http\Controllers;

use App\Present;
use Illuminate\Http\Request;

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

    public function update(Request $request, $id)
    {
         $present = Present::find($id);
         $present->status=$request->status;
         $present->save();

        flash('받으신 선물을 '. $present->status.'했습니다.');
        return response()->json(['data' => $request->status, 'status' => 'ok']);
    }
}
