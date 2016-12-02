<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NovelGroup;
use Illuminate\Support\Facades\Auth;
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
        //if validation is passed then insert the record

        //upload the picture
        if($request->hasFile('cover_photo')) {

            $cover_photo = $request->file('cover_photo');
            $filename = $cover_photo->getClientOriginalName();
            //set original name for database
            $input['cover_photo'] = $filename;
            //Insert the record
            $novel_group= $request->user()->novel_groups()->create($input);
            //upload file to destination path
            $destinationPath = public_path('/img/novel_covers/');
            $cover_photo ->move($destinationPath,$novel_group->id.'_'.$filename);
        }else {
            $request->user()->novel_groups()->create($input);
        }

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
    public function edit(Request $request,$id)
    {

       // $novel_group= $request->user()->novel_groups()->with('users.nicknames')->where('id',$id)->first();
        $novel_group=NovelGroup::where('id',$id)->first();
        $nicknames=$request->user()->nicknames()->list('nickname','id');
        return \Response::json(['novel_group'=>$novel_group,'nick_names'=>$nicknames]);
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
            'cover_photo' => 'dimensions:max_width=900,max_height=900',
            'cover_photo' => 'mimes:jpeg,png',
        ]);

        //if validation fails then redirect to create page
        if ($validator->fails()) {
            return redirect('author/edit')
                ->withErrors($validator)
                ->withInput();
        }

        //if validation is passed then insert the record

        if($request->hasFile('cover_photo')) {
            $cover_photo = $request->file('cover_photo');
            $size=$cover_photo->getSize();
            if($size > 1000000){ return redirect('author/edit'); }

            $filename = $id."_".$cover_photo->getClientOriginalName();
            $db_filename =$cover_photo->getClientOriginalName();
            //set original name for database
            $input['cover_photo'] = $db_filename;
            //upload file to destination path
            $destinationPath = public_path('/img/novel_covers/');
            $cover_photo ->move($destinationPath, $filename);
        }

        NovelGroup::where('id',$id)->update($input);
        //redirect to novels
        return redirect()->route('novelgroups',['id'=>$id]);

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
