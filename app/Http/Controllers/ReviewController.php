<?php

namespace App\Http\Controllers;

use App\NovelGroup;
use App\Review;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Validator;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        Validator::make($request->all(), [
            'title' => 'required|max:255',
            'review' => 'required',
        ], [
            'title.required' => '제목은 필수 입니다.',
            'title.max' => '제목은 반드시 255 자리보다 작아야 합니다.',
            'review.required' => '내용은 필수 입니다.',

        ])->validate();

        $request->user()->reviews()->create($request->all());
        flash('독자추천 글이 성공적으로 등록 되었습니다');
        return redirect()->route('reader_reco');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $groups_reviews = Review::where('novel_group_id', $id)->with('users')->with('novel_groups')->get();


//        return response()->json($groups_reviews);
        return view('author.review_show', compact('groups_reviews'));
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
        Review::destroy($id);
        return response()->json(['status' => 'ok']);
    }
}
