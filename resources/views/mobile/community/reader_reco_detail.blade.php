@extends('layouts.mobile_layout')
@section('content')
        <!-- 상단비주얼 -->
<div class="serial_topvs_wrap">
    <!-- 상단 비주얼 배경 이미지 -->
    <div class="stvs_bg_wrap">
        <div class="stvs_bg_img"></div>
        <!-- 배경이미지(책 표지) -->
        <div class="stvs_bg_cover"></div>
        <!-- 검은색 반투명 커버 -->
    </div>
    <!-- 상단 비주얼 배경 이미지 //-->
    <!-- 상단 비주얼 내용 -->
    <div class="stvs_cont">
        <!-- 조회수 선호작 -->
        <div class="stvs_cl">
            <div class="">
                <span>조회수</span><span class="stvs_cl_sli"></span><span>{{ $review->total_count }}</span>
            </div>
            <div class="">
                <span>선호작</span><span class="stvs_cl_sli"></span><span>{{ $review->novel_groups->favorites->count() }}
                    명</span>
            </div>
        </div>
        <!-- 조회수 선호작 //-->
        <!-- 선호작추가 공유하기 -->
       {{-- <div class="stvs_cr">
            <ul class="stvs_cr_ul">
                <li>
                    <a href="" class="stvs_cr_a">
                        <span class="stvs_cr_ico view_bm"></span>
                        <!--<span class="stvs_cr_ico view_bm_on"></span>-->
                        <span class="stvs_cr_sli"></span>
                        <span class="stvs_cr_txt">선호작추가</span>
                    </a>
                </li>
                <li>
                    <a href="" class="stvs_cr_a">
                        <span class="stvs_cr_ico view_share"></span>
                        <span class="stvs_cr_sli"></span>
                        <span class="stvs_cr_txt">공유하기</span>
                    </a>
                </li>
            </ul>
        </div>--}}
        <!-- 선호작추가 공유하기 //-->
        <div class="stvs_cc">
            <!-- 책 이미지 -->
            <span class="stvs_img"><img src="/img/novel_covers/{{$review->novel_groups->cover_photo}}"></span>
            <!-- 책 이미지 //-->
            <!-- 책 제목 -->
            <a href="{{ route('m.each_novel.novel_group', ['id' => $review->novel_groups->id]) }}">
                <div class="book_tit">{{ $review->novel_groups->title }}</div>
            </a>
            <!-- 책 제목 //-->
            <!-- 작가 및 장르 설명 -->
            <div class="book_info">
                <span class="wr_name">{{ $review->novel_groups->users->name }}</span>
                <span class="ico_note"><a href="{{ route('m.mails.create', ['id' =>$review->novel_groups->users->id]) }}"><img src="/mobile/images/ico_note.gif"></a></span>
                <span class="marL20">{{$review->novel_groups->keywords[0]->name}}</span>
                <span class="stvs_bif_sli"></span>
                <span>총 {{$review->novel_groups->novels->count()}}화</span>
            </div>
            <!-- 작가 및 장르 설명 //-->
        </div>
    </div>
    <!-- 상단 비주얼 내용 //-->
</div>
<!-- 상단비주얼 //-->

<!-- 내용 -->
<div class="container">
    <div class="cont_wrap">
        @if(Session::has('flash_message'))
            {{-- important, success, warning, danger and info --}}
            <div class="alert alert-success">
                {{Session('flash_message')}}
            </div>
            @endif
                    <!-- 타이틀 -->
            <div class="view_tit_box mart35">
                <h2 class="view_tit">{{ $review->review_title }}<span class="author">{{ $review->users->name }}</span>
                </h2>

                <div class="expatiate_wrap">
                    <span class="expatiate">작성일 {{ $review->created_at }}</span>
                    <span class="expatiate_sl"></span>
                    <span class="expatiate">조회수 {{ $review->view_count }}</span>
                </div>
            </div>
            <!-- 타이틀 //-->

            <!-- 본문 -->
            <div class="view_article_wrap">
                <div class="view_artic_cont">
                    <?php echo nl2br($review->review); ?>
                </div>
                <div class="participation_area">
                    <div class="al_right">
                        <a href="{{ route('m.accusations', ['id' => $review->users->id]) }}" class="icon_btn_a"><span
                                    class="icon ico_alert">신고</span><span class="al_right_txt">게시물 신고</span></a>
                    </div>
                </div>
                @if(Auth::check() && Auth::user()->id == $review->user_id)
                    <div class="view_admin"><a href="{{route('m.reader_reco.edit',['id' => $review->review_id ]) }}"
                                               class="view_admin_btn">관리</a></div>
                @endif
            </div>
            <!-- 본문 //-->

            <!-- 버튼 -->
            <div class="veiw_btn_wrap">
                <div class="mart20"><a href="{{ route('m.reader_reco') }}" class="btn_list_view full">목록</a></div>
                <div class="mart20">
                    <a href="{{route('m.reader_reco').'?novel_group='.$review->novel_groups->id}}"
                       class="btn_line_green floL" style="width:270px;">이 소설의 다른 추천</a>
                    <a href="{{route('m.reader_reco').'?review_user='.$review->users->id}}" class="btn_line_red floR"
                       style="width:270px;">작성자의 다른 추천 보기</a>
                </div>
            </div>
            <!-- 버튼 //-->

            <!-- 댓글 -->
            <div class="repl_lst_wrap padt50">
                <div class="replst_head">
                    <h3 class="mlist_tit4">댓글<span class="repcount">({{ $review->comments->count() }})</span></h3>
                    <div class="sort_area">
                        <a href="{{ route('m.reader_reco.detail', ['id' => $review->id]).'?order=latest' }}"
                           @if($order == 'latest' or $order == null ) class="sort_btn sort_on"
                           @else class="sort_btn sort_off" @endif>최신순</a>
                        <a href="{{ route('m.reader_reco.detail', ['id' => $review->id]).'?order=oldest' }}"
                           @if($order == 'oldest')  class="sort_btn sort_on" @else class="sort_btn sort_off" @endif>등록순</a>
                    </div>
                </div>

                <ul class="repl_lst">
                    @foreach ($review->comments as $comment)
                        <li>
                            <div class="replst_tit">{{ $comment->users->name }}<span
                                        class="replst_time">{{ $comment->created_at }}</span></div>
                            <div class="replst_cont"><?php echo nl2br($comment->comment); ?></div>
                            <div class="replst_btn_wrap">
                                <a href="" class="replst_btn">답글</a>
                                <a href="{{ route('m.accusations', ['id' => $comment->users->id]) }}"
                                   class="replst_btn">신고</a>
                            </div>
                        </li>
                    @endforeach
                    {{--<li class="repl_lst_re">
                        <div class="replst_tit">환영비화<span class="replst_time">2016-06-20 23:00</span></div>
                        <div class="replst_cont">ㅋㅋㅋㅋㅋㅋㅋㅋ왜 뼈한테 그래옄ㅋㅋㅋㅋ 뼈 얇으면 잘 뿌러짐!</div>
                        <div class="replst_btn_wrap">
                            <a href="" class="replst_btn">답글</a>
                            <a href="" class="replst_btn">신고</a>
                        </div>
                    </li>--}}
                </ul>
            </div>
            <!-- 댓글 //-->

            <!-- 댓글쓰기 -->
            <div class="repl_write_wrap mart20">
                <form method="post" action="{{route('m.reader_reco.comment',['id'=>$review->review_id])}}"
                      class="comment-form">
                    {!! csrf_field() !!}
                    <textarea class="repl_txtar" name="comment" rows="3" cols="30" placeholder="여러분의 소중한 댓글을 입력해 주세요"
                              @if($errors->count() > 0)autofocus @endif>{{ old('comment') }}</textarea>

                    <div class="padt15">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        <button type="submit" class="btn_green full">등록</button>
                    </div>
                </form>
            </div>
            <!-- 댓글쓰기 //-->
    </div>
</div>
<!-- 내용 //-->
@endsection