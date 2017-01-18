<?php

namespace App\Http\Controllers;

use App\Favorite;
use Auth;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store the data.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        Favorite::create([
            'user_id'=>Auth::user()->id,
            'novel_group_id'=>$request->get('novel_group_id')
        ]);
        return response()->json('success');
    }


    public function destroy($novel_group_id)
    {
       // return response()->json($novel_group_id);

        Favorite::where(['user_id' => Auth::user()->id, 'novel_group_id' => $novel_group_id])->delete();
        return response()->json('success');

    }

}
