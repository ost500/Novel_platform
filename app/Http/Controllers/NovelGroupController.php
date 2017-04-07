<?php

namespace App\Http\Controllers;

use App\Events\NewSpeedEvent;
use App\Favorite;
use App\Keyword;
use App\Mailbox;
use App\MailLog;
use App\Novel;
use App\NovelGroupHashTag;
use App\NovelGroupKeyword;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\NovelGroup;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Mockery\CountValidator\Exception;
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
        if (Auth::user()->isAdmin()) {
            //if you are admin
            $novel_groups = NovelGroup::with('novels')->latest()->paginate(10);

            if ($request->url('/admin/recommendations')) {
                $novel_groups = NovelGroup::with('novels')->orderBy('recommend_order', 'asc')->latest()->paginate(10);

                //make recommend_order to null when recommend_order > 5 [max valid order is 5]
                foreach( $novel_groups as  $novel_group){
                    if($novel_group->recommend_order > 5) $novel_group->recommend_order = null;
                }
            }

        } else {
            //if you are user
            $novel_groups = $request->user()->novel_groups()->with('novels')->latest()->paginate(10);
        }

        //check an agreement agreed or not
        $author = User::select('author_agreement')->where('id', Auth::user()->id)->first();

        // sorting
        if ($request->order == "secret") {
            $novel_groups = $novel_groups->where('secret', 1);
        } else if ($request->order == "completed") {
            $novel_groups = $novel_groups->where('completed', 1);
        } else if ($request->order == "running") {
            $novel_groups = $novel_groups->where('completed', 0);
        }


        $comments_count = 0;
        $review_count = 0;
        $count_data = array();
        $review_count_data = array();
        $latested_at = array();
        $novel_groups_count = $novel_groups->count();

        foreach ($novel_groups as $novel_group) {

            foreach ($novel_group->novels as $novel) {
                foreach ($novel->comments as $commenat) {
                    $comments_count++;
                }
            }
            foreach ($novel_group->reviews as $n) {
                $review_count++;
            }
            // 소설이 없다면
            if ($novel_group->novels->count() != 0) {
                $latested_at[$novel_group->id] = $novel_group->novels->sortby('created_at')->first()->created_at->format('Y-m-d');
            } else {
                $latested_at[$novel_group->id] = "0000-00-00";
            }


            $count_data[$novel_group->id] = $comments_count;
            $comments_count = 0;

            $review_count_data[$novel_group->id] = $review_count;
            $review_count = 0;

        }


        // pagination
        if (!isset($request->page)) {
            $request->page = 1;
        }


        return \Response::json(['novel_groups' => $novel_groups, 'count_data' => $count_data, 'review_count_data' => $review_count_data, 'latested_at' => $latested_at, 'author' => $author]);
        // dd($user_novels);
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

        //   dd($request->all());


        Validator::make($request->all(), [
            'nickname_id' => 'required',
            'title' => 'required|max:255',
            'description' => 'required',
            'hash_tags' => 'required',
            /* 'keyword2' => 'required',
             'keyword3' => 'required',
             'keyword4' => 'required',
             'keyword5' => 'required',
             'keyword6' => 'required',
             'keyword7' => 'required',*/
            'cover_photo' => 'mimes:jpeg,png|image|max:1024|dimensions:max_width=1080,max_height=1620',
            'cover_photo2' => 'mimes:jpeg,png|image|max:1024|dimensions:max_width=1080,max_height=1080',

        ], [
            'nickname_id.required' => '필명은 필수 입니다.',
            'title.required' => '제목은 필수 입니다.',
            'title.max' => '제목이 너무 깁니다.',
            'description.required' => '설명은 필수 입니다.',
            'cover_photo.dimensions' => '표지1 크기는 1080*1620 이어야 합니다',
            'cover_photo.max' => '표지1 용량은 1M를 넘지 않아야 합니다',
            'cover_photo2.dimensions' => '표지2 크기는 1080*1080 이어야 합니다',
            'cover_photo2.max' => '표지2 용량은 1M를 넘지 않아야 합니다',
            'hash_tags.required' => '첫번째 키워드를 입력해 주세요',
            /*  'keyword2.required' => '두번째 키워드를 입력해 주세요',
              'keyword3.required' => '세번째 키워드를 입력해 주세요',
              'keyword4.required' => '네번째 키워드를 입력해 주세요',
              'keyword5.required' => '다섯번째 키워드를 입력해 주세요',
              'keyword6.required' => '여섯번째 키워드를 입력해 주세요',
              'keyword7.required' => '일곱번째 키워드를 입력해 주세요',*/

        ])->validate();

        $input = $request->all();
        //if validation is passed then insert the record
//        $new_novel_group = $request->user()->novel_groups()->create($input);

        $new_novel_group = new NovelGroup();
        $new_novel_group->nickname_id = $request->nickname_id;
        $new_novel_group->user_id = $request->user()->id;
        $new_novel_group->title = $request->title;
        $new_novel_group->description = $request->description;
        $new_novel_group->cover_photo = $request->cover_photo;
        $new_novel_group->cover_photo2 = $request->cover_photo2;
        $new_novel_group->secret = Carbon::now();
        $new_novel_group->save();


        //save the type
        $new_novel_group_keyword = new NovelGroupKeyword();
        $new_novel_group_keyword->novel_group_id = $new_novel_group->id;
        $new_novel_group_keyword->keyword_id = $request->input('keyword1');
        $new_novel_group_keyword->save();

        //save the has tags
        //  for ($i = 2; $i <= 7; $i++) {
        foreach ($input['hash_tags'] as $hash_tag) {
            $new_novel_group_hash_tag = new NovelGroupHashTag();
            $new_novel_group_hash_tag->novel_group_id = $new_novel_group->id;
            $new_novel_group_hash_tag->tag = $hash_tag;
            $new_novel_group_hash_tag->save();
        }
        //  }


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


        flash("생성을 성공했습니다");
        //  return redirect()->route('author_novel_group', ['id' => $new_novel_group->id]);

        event(new NewSpeedEvent("new_novel_group", "작가 " . $new_novel_group->nicknames->nickname . "의 신작 " . $new_novel_group->title . " 이(가) 신규 등록 되었습니다.", route('each_novel.novel_group', ['id' => $new_novel_group->id]), "/img/novel_covers/" . $new_novel_group->cover_photo, $new_novel_group->id));

        if ($request->ajax()) {
            return "OK";
        }

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
        $novel_group = NovelGroup::where('id', $id)->with('nicknames', 'keywords', 'hash_tags')->first();
        $nicknames = $request->user()->nicknames()->get();

        $selected_hash_tags = NovelGroupHashTag::where('novel_group_id', $id)->pluck('tag');
        $keyword1 = Keyword::select('id', 'name')->where('category', '1')->get();
        $hash_tag_keywords = Keyword::select('id', 'name')->where('category', '<>', '1')->get();
        /* $keyword3 = Keyword::select('id', 'name')->where('category', '3')->get();
         $keyword4 = Keyword::select('id', 'name')->where('category', '4')->get();
         $keyword5 = Keyword::select('id', 'name')->where('category', '5')->get();
         $keyword6 = Keyword::select('id', 'name')->where('category', '6')->get();
         $keyword7 = Keyword::select('id', 'name')->where('category', '7')->get();*/


        return \Response::json([
            'novel_group' => $novel_group,
            'nick_names' => $nicknames,
            'selected_hash_tags' => $selected_hash_tags,
            'keyword1' => $keyword1,
            'hash_tag_keywords' => $hash_tag_keywords,
            /* 'keyword3' => $keyword3,
              'keyword4' => $keyword4, 'keyword5' => $keyword5,
              'keyword6' => $keyword6, 'keyword7' => $keyword7,*/


        ]);
        //return redirect()->route('author.edit',compact('novel_group','nicknames','selected_hash_tags','keyword1', 'hash_tag_keywords'));
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
        //$input = $request->except('_token', '_method', 'default_cover_photo');
        $input = $request->only('nickname_id', 'title', 'description', 'cover_photo', 'cover_photo2');
        $hash_tags = $request->only('hash_tags');
        $keywords = $request->only('keyword1');

        Validator::make($request->all(), [
            'nickname_id' => 'required',
            'title' => 'required|max:255',
            'description' => 'required',
            'cover_photo' => 'mimes:jpeg,png|image|max:1024|dimensions:max_width=1080,max_height=1620',
            'cover_photo2' => 'mimes:jpeg,png|image|max:1024|dimensions:max_width=1080,max_height=1080',

        ], [
            'nickname_id.required' => '필명은 필수 입니다.',
            'title.required' => '제목은 필수 입니다.',
            'title.max' => '제목이 너무 깁니다.',
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

        } else if ($request->default_cover_photo) {
            $input['cover_photo'] = "default_" . $request->default_cover_photo . ".jpg";
        } else {
            // $new_novel_group = $request->user()->novel_groups()->create($input);
            $novel_group = NovelGroup::find($id);

            if ($novel_group->cover_photo == null) {

                $input['cover_photo'] = "default_.jpg";
            } else {
                $input['cover_photo'] = $novel_group->cover_photo;
            }
        }

        //update the novel_group
        NovelGroup::where('id', $id)->update($input);

        //update the novel_group type
        NovelGroupKeyword::where('novel_group_id', $id)->update(['keyword_id' => $keywords['keyword1']]);

        //Delete the hash tags which are removed by user
        // get all group hash tags
        $selected_hash_tags = NovelGroupHashTag::where('novel_group_id', $id)->get();
        $deleteFlag = false;
        //if a selected hash tag is not in new group hash tags [updated hash tags] then delete that from db
        foreach ($selected_hash_tags as $selected_hash_tag) {
            foreach ($hash_tags['hash_tags'] as $hash_tag) {
                if ($selected_hash_tag->tag != $hash_tag) {
                    $deleteFlag = true;

                } else {
                    $deleteFlag = false;
                    break;
                }
            }

            if ($deleteFlag) {
                NovelGroupHashTag::where('id', $selected_hash_tag->id)->delete();
            }

        }

//Update and Insert new Tags
        foreach ($hash_tags['hash_tags'] as $hash_tag) {
            //Check if already exists or not
            $already_exists = NovelGroupHashTag::where(['novel_group_id' => $id, 'tag' => $hash_tag])->first();
            //if don't exist then insert it
            if (!$already_exists) {
                NovelGroupHashTag::create(['novel_group_id' => $id, 'tag' => $hash_tag]);
            }

        }


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
    public
    function destroy($id)
    {
        $novel = Novel::where('novel_group_id', $id)->first();
        if ($novel == null) {
            $novel_group = NovelGroup::find($id);
            $novel_group->delete();
        } else {
            return response()->json(['error' => 1, 'message' => '해당 소설을 삭제할 수 없습니다. 각 회차를 먼저 삭제해 주십시오.']);
        }

        return response()->json(['error' => 0, 'message' => '삭제 되었습니다.']);
    }

    public
    function secret($id)
    {
        $novel_group = NovelGroup::findOrFail($id);

        //if there is paid novel, 1 month will be given to readers.
        $non_free = $novel_group->novels->where('non_free_agreement', 1)->count();
        if ($non_free == 0) {
            $novel_group->secret = Carbon::now();
        } else {
            $novel_group->secret = Carbon::now()->addMonth();
        }
        $novel_group->save();


        $new_mail = new Mailbox();
        $new_mail->subject = "'" . $novel_group->title . "'이(가) 비밀 글이 됩니다.";
        $new_mail->body = $novel_group->secret . " 이후로 '" . $novel_group->title . "'이(가) 비밀 글이 됩니다.";
        $new_mail->from = Auth::user()->id;
        $new_mail->novel_group_id = $novel_group->id;
        $new_mail->save();


        $favorites = Favorite::where('novel_group_id', $id)->pluck('user_id');

        foreach ($favorites as $favorite) {
            $new_mail_log = new MailLog();
            $new_mail_log->user_id = $favorite;
            $new_mail_log->mailbox_id = $new_mail->id;
            $new_mail_log->novel_group_id = $novel_group->id;
            $new_mail_log->save();
        }

    }

    public
    function non_secret($id)
    {

        $novel_group = NovelGroup::findOrFail($id);


        $novel_group->secret = null;

        $novel_group->save();


        $new_mail = new Mailbox();
        $new_mail->subject = "'" . $novel_group->title . "'이(가) 비밀 해제 됩니다.";
        $new_mail->body = $novel_group->secret . " 이후로'" . $novel_group->title . "'이(가) 비밀 해제 됩니다.";
        $new_mail->from = Auth::user()->id;
        $new_mail->novel_group_id = $novel_group->id;
        $new_mail->save();


        $favorites = Favorite::where('novel_group_id', $id)->pluck('user_id');

        foreach ($favorites as $favorite) {
            $new_mail_log = new MailLog();
            $new_mail_log->user_id = $favorite;
            $new_mail_log->mailbox_id = $new_mail->id;
            $new_mail_log->novel_group_id = $novel_group->id;
            $new_mail_log->save();
        }
    }

    public
    function clone_for_publish($id)
    {
        try {
            $cloning_novel_group = NovelGroup::find($id);
            // novel_group to clone
            $new_novel_group = $cloning_novel_group->replicate();
            $new_novel_group->secret = Carbon::now();
            $new_novel_group->title = $new_novel_group->title . " [클린 버젼]";
            $new_novel_group->push();
            // novel_group cloned

            $cloning_novels = Novel::where('novel_group_id', $cloning_novel_group->id)->orderBy('inning')->get();
            foreach ($cloning_novels as $cloning_novel) {
                if ($cloning_novel->adult == 1) {
                    break;
                }
                $new_novel = $cloning_novel->replicate();
                $new_novel->novel_group_id = $new_novel_group->id;
                $new_novel->push();
            }
        } catch (Exception $e) {
            abort(403, '처리 중 에러가 발생했습니다 관리자에게 문의하세요.');
        }

    }

    public function code_num_save(Request $request)
    {
        foreach ($request->all() as $item) {
            $novel_group_code = NovelGroup::findOrFail($item['id']);
            $novel_group_code->code_number = $item['code_number'];
            $novel_group_code->save();
        }

        return response()->json($request);
    }


    public function recommend_order(Request $request)
    {

        foreach ($request->all() as $item) {
            //999 used for sorting  asc in index method for admin
            if($item['recommend_order'] ==null) $item['recommend_order']=999;

            $novel_group_recommend_order = NovelGroup::findOrFail($item['id']);
            $novel_group_recommend_order->recommend_order = $item['recommend_order'];
            $novel_group_recommend_order->save();
        }

        return response()->json($request);
    }


}
