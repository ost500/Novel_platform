<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NovelGroup;
use Validator;
class NovelGroupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $novel_groups= $request->user()->novel_groups()->get();
        return \Response::json($novel_groups);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'nickname' => 'required|max:255',
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('author/create')
                ->withErrors($validator)
                ->withInput();
        }
        $input=$request->all();
        $cover_photo = $request->file('cover_photo');
        $filename = $cover_photo->getClientOriginalName();
        //set original name for database
        $input['cover_photo']=$filename;
        // dd($input);
        $request->user()->novel_groups()->create($input);
        return redirect('novelgroups');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $novel_group=NovelGroup::find($id);
        return \Response::json($novel_group);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $input=$request->except('_token','_method');
        //Validate the request
        $validator = Validator::make($request->all(), [
            'nickname' => 'required|max:255',
            'title' => 'required',
            'description' => 'required',
        ]);
        //if validation fails then redirect to create page
        if ($validator->fails()) {
            return redirect('author/create')
                ->withErrors($validator)
                ->withInput();
        }

        //if validation is passed then insert the record

        if($request->hasFile('cover_photo')) {
            $cover_photo = $request->file('cover_photo');
            $filename = $cover_photo->getClientOriginalName();
            //set original name for database
            $input['cover_photo'] = $filename;
        }

        NovelGroup::where('id',$id)->update($input);
        //redirect to novels
        return redirect('novelgroups');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $novel_group=NovelGroup::find($id);
        $novel_group->delete();
    }
}
