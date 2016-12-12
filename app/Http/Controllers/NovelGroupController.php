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
        $novel_groups = $request->user()->novel_groups()->get();
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Validator::make($request->all(), [
            'nickname' => 'required|max:255',
            'title' => 'required',
            'description' => 'required',
            'cover_photo' => 'mimes:jpeg,png|image|max:1024|dimensions:max_width=1080,max_height=1620',
            'cover_photo2' => 'mimes:jpeg,png|image|max:1024|dimensions:max_width=1080,max_height=1080',

        ], [
            'nickname.required' => '필명은 필수 입니다.',
            'title.required' => '제목은 필수 입니다.',
            'description.required' => '설명은 필수 입니다.',
            'cover_photo.dimensions' => '표지1 크기는 1080*1620 이어야 합니다',
            'cover_photo.max' => '표지1 용량은 1M를 넘지 않아야 합니다',
            'cover_photo2.dimensions' => '표지2 크기는 1080*1080 이어야 합니다',
            'cover_photo2.max' => '표지2 용량은 1M를 넘지 않아야 합니다',

        ])->validate();

        $input = $request->all();
        //if validation is passed then insert the record
        $new_novel_group = $request->user()->novel_groups()->create($input);

        //upload the picture
        if ($request->hasFile('cover_photo') or $request->hasFile('cover_photo2')) {


            if ($request->hasFile('cover_photo')) {
                $cover_photo = $request->file('cover_photo');
                $filename = $cover_photo->getClientOriginalExtension();
                //upload file to destination path
                $destinationPath = public_path('img/novel_covers/');

                $new_novel_group->cover_photo = $new_novel_group->id . 'cover_photo1.' . $filename;

                $cover_photo->move($destinationPath, $new_novel_group->id . 'cover_photo1.' . $filename);
            }

            if ($request->hasFile('cover_photo2')) {
                $cover_photo2 = $request->file('cover_photo2');
                $filename2 = $cover_photo2->getClientOriginalExtension();
                //upload file to destination path
                $destinationPath = public_path('img/novel_covers/');
                $cover_photo2->move($destinationPath, $new_novel_group->id . 'cover_photo2' . $filename2);

                $new_novel_group->cover_photo2 = $new_novel_group->id . 'cover_photo2' . $filename2;

            }

            $new_novel_group->save();


        } else if ($request->default_cover_photo) {
            // $new_novel_group = $request->user()->novel_groups()->create($input);
            $new_novel_group->cover_photo = "default_" . $request->default_cover_photo . ".jpg";
            $new_novel_group->save();
        } else {
            // $new_novel_group = $request->user()->novel_groups()->create($input);
            $new_novel_group->cover_photo = "default_.jpg";
            $new_novel_group->save();
        }

        if ($request->ajax()) {
            return "OK";
        }

        flash("생성을 성공했습니다");
        //  return redirect()->route('author_novel_group', ['id' => $new_novel_group->id]);
        return redirect()->route('author_index');
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
        $novel_group = NovelGroup::find($id);
        return \Response::json($novel_group);
    }

    public function show_novel($id)
    {
        //
        $novel_group = NovelGroup::find($id)->novels->sortByDesc('inning')->values();
        return \Response::json($novel_group);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        // $novel_group= $request->user()->novel_groups()->with('users.nicknames')->where('id',$id)->first();
        $novel_group = NovelGroup::where('id', $id)->first();
        $nicknames = $request->user()->nicknames()->get();
        return \Response::json(['novel_group' => $novel_group, 'nick_names' => $nicknames]);
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

        $input = $request->except('_token', '_method','default_cover_photo');

        Validator::make($request->all(), [
            'nickname' => 'required|max:255',
            'title' => 'required',
            'description' => 'required',
            'cover_photo' => 'mimes:jpeg,png|image|max:1024|dimensions:max_width=1080,max_height=1620',
            'cover_photo2' => 'mimes:jpeg,png|image|max:1024|dimensions:max_width=1080,max_height=1080',

        ], [
            'nickname.required' => '필명은 필수 입니다.',
            'title.required' => '제목은 필수 입니다.',
            'description.required' => '설명은 필수 입니다.',
            'cover_photo.dimensions' => '표지1 크기는 1080*1620 이어야 합니다',
            'cover_photo.max' => '표지1 용량은 1M를 넘지 않아야 합니다',
            'cover_photo2.dimensions' => '표지2 크기는 1080*1080 이어야 합니다',
            'cover_photo2.max' => '표지2 용량은 1M를 넘지 않아야 합니다',

        ])->validate();

        //if validation is passed then insert the record
        //upload the picture
        if ($request->hasFile('cover_photo') or $request->hasFile('cover_photo2')) {
            if ($request->hasFile('cover_photo')) {
                $cover_photo = $request->file('cover_photo');
                //$original_filename = $cover_photo->getClientOriginalName();
                $filename = $id . "cover_photo1." . $cover_photo->getClientOriginalExtension();
                //set file name for database
                $input['cover_photo'] = $filename;
                //upload file to destination path
                $destinationPath = public_path('/img/novel_covers/');
                $cover_photo->move($destinationPath, $filename);
            }

            if ($request->hasFile('cover_photo2')) {
                $cover_photo = $request->file('cover_photo2');
                //$original_filename = $cover_photo->getClientOriginalName();
                $filename = $id . "cover_photo2." . $cover_photo->getClientOriginalExtension();
                //set file name for database
                $input['cover_photo2'] = $filename;
                //upload file to destination path
                $destinationPath = public_path('/img/novel_covers/');
                $cover_photo->move($destinationPath, $filename);
            }

        }else if ($request->default_cover_photo) {

            $input['cover_photo'] = "default_" . $request->default_cover_photo . ".jpg";
        } else {
            // $new_novel_group = $request->user()->novel_groups()->create($input);
            $input['cover_photo']= "default_.jpg";
        }

        NovelGroup::where('id', $id)->update($input);
        //redirect to novels
        flash("수정을 성공했습니다");
        if ($request->ajax()) {
            return \Response::json(['status' => 'ok']);
        }
        return redirect()->route('author_index');

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
        $novel_group = NovelGroup::find($id);
        $novel_group->delete();
    }


}
