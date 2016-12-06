<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Novel;
use Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CommentController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

        $my_comments = Comment::with('novels')->with('users')->get()->where('novels.user_id', Auth::user()->id);

        //?‚´ ?†Œ?„¤?„ ê°?ì§?ê³? ?˜¨?‹¤
//        $my_novel = Novel::where('user_id', Auth::user()->id)->with('users')->get();


        $collection = new Collection();

        //?‚´ ?†Œ?„¤?˜ ?Œ“ê¸??„ ê°?ì§?ê³? ?˜¨?‹¤

        foreach ($my_comments as $novel_comm) {
            $collection->push($novel_comm);
            foreach ($novel_comm->children as $child) {
                $collection->push($child);
            }
        }


        return response()->json($collection);
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
        //
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
        //
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
