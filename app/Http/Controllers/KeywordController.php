<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Keyword;
use Validator;

class KeywordController extends Controller
{
    //

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin'])->except('popular_keywords');
    }


    public function index()
    {
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
            'category' => 'required',
            'name' => 'required|max:255',
        ], [
            'category.required' => '범주은 필수 입니다.',
            'name.required' => '제목은 필수 입니다.',
            'name.max' => '제목은 반드시 255 자리보다 작아야 합니다.',
        ])->validate();

        $input = $request->all();
        //if validation is passed then insert the record
        Keyword::create($input);
        flash("키워드가 성공적으로 생성됐습니다");
        //redirect to faqs
        if ($request->ajax()) {
            return response()->json(['status' => 'ok']);
        }

        return redirect()->route('admin.keywords');
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
        $input = $request->except('_token', '_method');
        //Validate the request
        //
        Validator::make($request->all(), [
            'category' => 'required',
            'name' => 'required|max:255',
        ], [
            'category.required' => '범주은 필수 입니다.',
            'name.required' => '제목은 필수 입니다.',
            'name.max' => '제목은 반드시 255 자리보다 작아야 합니다.',
        ])->validate();

        //if validation is passed then insert the record
        Keyword::where('id', $id)->update($input);
        flash('Keyword 수정을 성공했습니다.');
        if ($request->ajax()) {
            return response()->json(['status' => 'ok']);
        }
        //redirect to faqs
        return redirect()->route('admin.keywords');

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
        $keyword = Keyword::find($id);
        $keyword->delete();
        flash('삭제 되었습니다');
        return response()->json(['status' => 'ok']);
    }

    public function popular_keywords(Request $request)
    {
        if ($request->search != "") {
            $searchKeyword = Keyword::where('name', 'like', "%" . $request->search . "%")->select('name')->get();
            return $searchKeyword;
        } else {


            #현대 #현대판타지 #사극 #시대 #동양판타지 #서양역사 #로맨스판타지 #메디컬 #회귀물 #남장여자 #정략결혼 #나쁜남자 #후회남주 #로맨틱코미디

            $defaults = ['현대', '현대판타지', '사극', '시대', '동양판타지', '서양역사', '로맨스판타지', '메디컬', '회귀물', '남장여자', '정략결혼', '나쁜남자', '후회남주', '로맨틱코미디'];

            $newCollection = new Collection();

            foreach ($defaults as $default) {
                $newCollection->push(['name' => $default]);
            }

            return $newCollection;
        }

    }

}
