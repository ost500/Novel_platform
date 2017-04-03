@extends('layouts.mobile_layout')
@section('content')
        <!-- 상단비주얼 -->
<div class="serial_topvs_wrap" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml">
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
            <a href="{{ route('each_novel.novel_group', ['id' => $review->novel_groups->id]) }}">
                <div class="book_tit">{{ $review->novel_groups->title }}</div>
            </a>
            <!-- 책 제목 //-->
            <!-- 작가 및 장르 설명 -->
            <div class="book_info">
                <span class="wr_name">{{ $review->novel_groups->users->name }}</span>
                <span class="ico_note"><a href="{{ route('mails.create', ['id' =>$review->novel_groups->users->id]) }}"><img src="/mobile/images/ico_note.gif"></a></span>
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
    <div class="cont_wrap" >
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
                        <a href="{{ route('accusations', ['id' => $review->users->id]) }}" class="icon_btn_a"><span
                                    class="icon ico_alert">신고</span><span class="al_right_txt">게시물 신고</span></a>
                    </div>
                </div>
                @if(Auth::check() && Auth::user()->id == $review->user_id)
                    <div class="view_admin"><a href="{{route('reader_reco.edit',['id' => $review->review_id ]) }}"
                                               class="view_admin_btn">관리</a></div>
                @endif
            </div>
            <!-- 본문 //-->

            <!-- 버튼 -->
            <div class="veiw_btn_wrap">
                <div class="mart20"><a href="{{ route('reader_reco') }}" class="btn_list_view full">목록</a></div>
                <div class="mart20">
                    <a href="{{route('reader_reco').'?novel_group='.$review->novel_groups->id}}"
                       class="btn_line_green floL" style="width:270px;">이 소설의 다른 추천</a>
                    <a href="{{route('reader_reco').'?review_user='.$review->users->id}}" class="btn_line_red floR"
                       style="width:270px;">작성자의 다른 추천 보기</a>
                </div>
            </div>
            <!-- 버튼 //-->

            <!-- 댓글 -->
            <div class="repl_lst_wrap padt50" id="review_comments">
                <div class="replst_head">
                    <h3 class="mlist_tit4">댓글<span class="repcount">({{ $review->comments->count() }})</span></h3>
                    <div class="sort_area">
                        <a href="{{ route('reader_reco.detail', ['id' => $review->review_id]).'?order=latest' }}"
                           @if($order == 'latest' or $order == null ) class="sort_btn sort_on"
                           @else class="sort_btn sort_off" @endif>최신순</a>
                        <a href="{{ route('reader_reco.detail', ['id' => $review->review_id]).'?order=oldest' }}"
                           @if($order == 'oldest')  class="sort_btn sort_on" @else class="sort_btn sort_off" @endif>등록순</a>
                    </div>
                </div>

                <ul class="repl_lst">
                    @foreach ($review_comments as $comment)
                        <li>
                            <div class="replst_tit">{{ $comment[0]->users->name }}<span
                                        class="replst_time">{{ $comment[0]->created_at }}</span></div>
                            <div class="replst_cont"><?php echo nl2br($comment[0]->comment); ?></div>
                            <div class="replst_btn_wrap">
                                <a v-on:click="new_box_show({{$comment[0]->id}})"  style="cursor:pointer;" class="replst_btn">답글</a>

                                <a href="{{ route('accusations', ['id' => $comment[0]->users->id]) }}"
                                   class="replst_btn">신고</a>
                            </div>
                            <div class="replst_cont" style="display:none;"
                                 v-show="new_box_display.status"
                                 id="comment_box{{$comment[0]->id}}"
                                 v-if="new_box_display.id =={{$comment[0]->id}}">

                                      <textarea name="comment" id="comment{{$comment[0]->id}}"
                                                v-model="sub_info.comment" rows="3"
                                                placeholder="여러분의 소중한 댓글을 입력해 주세요">{{ old('comment') }}</textarea>
                                <span style="margin-left: 2%;" id="error{{$comment[0]->id}}"></span>
                                <input type="hidden" name="parent_id" id="parent_id{{$comment[0]->id}}"
                                       value="{{$comment[0]->id}}"/>
                                <div class="padtb15">
                                    <button type="submit" id="edit{{$comment[0]->id}}"
                                            v-on:click="subCommentStore('{{$comment[0]->id}}')"
                                            class="btn_green full">답글
                                    </button>
                                </div>
                            </div>
                        </li>
                        @foreach($review_comments[$loop->index]['children'] as $comment_reply)
                            <li class="repl_lst_re">
                                <div class="replst_tit">{{ $comment_reply->users->name }}<span
                                            class="replst_time">{{ $comment_reply->created_at }}</span></div>
                                <div class="replst_cont"><?php echo nl2br($comment_reply->comment); ?></div>
                                <div class="replst_btn_wrap">
                                    <a href="{{ route('accusations', ['id' => $comment_reply->users->id]) }}"
                                       class="replst_btn">신고</a>
                                </div>
                            </li>
                        @endforeach
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
                <form method="post" action="{{route('reader_reco.comment',['id'=>$review->review_id])}}"
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
<script type="text/javascript">
    var app = new Vue({
        el: '#review_comments',
        data: {

            sub_info: {comment: '', parent_id: ''},
            new_box_display: {id: '', status: false}
        },
        methods: {


            new_box_show: function (comment_id) {

                if (this.new_box_display.id == comment_id && this.new_box_display.status == true) {
                    //Hide new comment box if already shown
                    this.new_box_display.status = false;
                    this.new_box_display.id = 0;
                } else {
                    //Show new comment box
                    this.new_box_display.id = comment_id;
                    this.new_box_display.status = true;

                }


            },
            subCommentStore: function (comment_id) {
                app.sub_info.parent_id = $('#parent_id' + comment_id).val();
                app.$http.post('{{route('reader_reco.comment',['id'=>$review->review_id])}}', app.sub_info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                        .then(function (response) {
                            location.reload();

                        }).catch(function (errors) {
                            this.errorsInfo = errors.data;
                            if (this.errorsInfo.error) {
                                window.location.assign('{{ url('/login')}}');
                                exit();
                            }
                            $("#error" + comment_id).text(errors.data['comment']);
                            //  $('#validateError').show();
                        });
            }
        }
    });
</script>
@endsection