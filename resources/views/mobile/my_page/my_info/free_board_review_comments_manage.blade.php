@extends('layouts.mobile_mypage_layout')
@section('content')
        <!-- 내용 -->
<div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="cont_wrap">
        <!-- 셀렉트박스 -->
        @include('mobile.my_page.select_bar')
                <!-- 셀렉트박스 //-->
        @if(Session::has('flash_message'))
            {{-- important, success, warning, danger and info --}}
            <div class="alert alert-success">
                {{Session('flash_message')}}
            </div>
            @endif
                    <!-- 댓글 관리 -->
            <div class="" id="free_board_review_comments">
                <div class="replst_head">
                    <h3 class="mlist_tit4">일반 댓글 관리<em class="repcount">({{$comments->total()}})</em></h3>

                    <div class="sort_area">
                        <a href="{{route('my_info.free_board_review_comments_manage').'?filter='.$filter.'&order=latest' }}"
                           @if($order=='latest' or $order=='' ) class="sort_btn sort_on"
                           @else class="sort_btn sort_off" @endif >최신순</a>
                        <a href="{{route('my_info.free_board_review_comments_manage').'?filter='.$filter.'&order=normal' }}"
                           @if($order=='normal') class="sort_btn sort_on" @else class="sort_btn sort_off" @endif>등록순</a>
                    </div>
                </div>
                <!-- 자유게시판, 독자추천 메뉴 버튼 -->
                <div class="padb25">
                    <ul class="tap2_mn">
                        <li class="left"><a
                                    href="{{route('my_info.free_board_review_comments_manage').'?filter=free_board_comments&order='.$order }}"
                                    @if( $filter =='free_board_comments' or $filter == null )  class="tap2_mn_on"
                                    @endif>자유게시판</a></li>
                        <li class="right"><a
                                    href="{{route('my_info.free_board_review_comments_manage').'?filter=review_comments&order='.$order }}"
                                    @if( $filter =='review_comments') class="tap2_mn_on" @endif>독자추천</a></li>
                    </ul>
                </div>
                <!-- 자유게시판, 독자추천 메뉴 버튼 //-->

                <!-- 게시글 테이블 -->
                <table class="tbl_dotline">
                    <colgroup>
                        <col width="*">
                        <col width="20%">
                    </colgroup>
                    <tbody>
                    @if(count($comments) > 0)
                        @foreach($comments as $comment)
                            <tr>
                                <td class="contxt  @if($comment->parent_id != 0) repl_lst_re @endif">

                                    @if($filter == 'free_board_comments' or $filter == '')
                                        <a href="{{ route('free_board.detail', ['id'=>$comment->free_board_id]) }}">

                                            <div class="borContTit">{{str_limit($comment->title)}} <span
                                                        class="mtbl_binfo_sl"></span>
                                                <span class="brw_24">{{$comment->user_name}}</span></div>
                                        </a>
                                    @else
                                        <a href="{{ route('reader_reco.detail', ['id'=>$comment->review_id]) }}">
                                            <div class="borContTit">{{$comment->title}} <span
                                                        class="mtbl_binfo_sl"></span>
                                                <span class="brw_24">{{$comment->user_name}}</span></div>
                                        </a>
                                    @endif


                                    <div class="tbl_binfo22" v-show="!display.status">{{$comment->comment}} </div>
                                    <div class="tbl_binfo22" id="comment_box{{$comment->id}}"
                                         v-if="display.id =={{$comment->id}} && display.status">
                                        <textarea name="comment" id="comment{{$comment->id}}"
                                                  rows="2">{{$comment->comment}}</textarea>
                                        <button name="edit" id="edit{{$comment->id}}" @if($comment->review_id)
                                        v-on:click="update_comment('{{$comment->id}}','review')"
                                                @else    v-on:click="update_comment('{{$comment->id}}','free_board')"
                                                @endif class="btn_green full">
                                            수정
                                        </button>
                                    </div>

                                    <div class="tbl_binfo22 padt10">@if(!isset($filter) or $filter =='free_board_comments' )
                                            자유게시판 @else 독자추천 @endif<span
                                                class="mtbl_binfo_sl"></span>{{time_elapsed_string($comment->created_at)}}
                                    </div>
                                </td>
                                <td class="talC">
                                    <div><a v-on:click="comment_box_show({{$comment->id}})"
                                            class="sbtn_line_gray">수정</a></div>
                                    <div class="mart8"><a
                                                @if($comment->review_id) v-on:click="remove_comment('{{$comment->id}}','review')"
                                                @else v-on:click="remove_comment('{{$comment->id}}','free_board')"
                                                @endif class="sbtn_line_gray">삭제</a></div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td style="text-align: center"> 첫 번째 댓글을 작성해 보세요.</td>
                        </tr>
                    @endif

                    </tbody>
                </table>
                <!-- 게시글 테이블 //-->

                <!-- 페이징 -->
                @include('pagination_mobile', ['collection' => $comments, 'url' => route('my_info.free_board_review_comments_manage').'?filter='.$filter.'&order='.$order.'&'])
                        <!-- 페이징 //-->
            </div>
    </div>
    <!-- 댓글 관리 //-->
</div>
</div>
<!-- 내용 //-->
<script type="text/javascript">
    var app = new Vue({
        el: '#free_board_review_comments',
        data: {
            info: {comment_id: '', comment_type: '', comment: ''},
            display: {id: '', status: false}
        },

        methods: {

            comment_box_show: function (comment_id) {
                //document.getElementById('comment_box'+comment_id).style.display='block';
                if (this.display.id == comment_id && this.display.status == true) {
                    this.display.status = false;
                    this.display.id = 0;
                } else {

                    this.display.id = comment_id;
                    this.display.status = true;
                }
            },

            remove_comment: function (comment_id, comment_type) {
                this.info.comment_id = comment_id;
                this.info.comment_type = comment_type;
                if (confirm('삭제 하시겠습니까?')) {
                    app.$http.post('{{ route('free_board_review_comments.destroy_comments') }}', this.info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {
                                location.reload();
                            }).catch(function (errors) {
                                // console.log(errors);
                            });
                }
            },
            update_comment: function (comment_id, comment_type) {

                this.info.comment_id = comment_id;
                this.info.comment_type = comment_type;
                this.info.comment = $('#comment' + comment_id).val();

                app.$http.put('{{ route('free_board_review_comments.update_comments') }}', this.info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                        .then(function (response) {
                            location.reload();

                        }).catch(function (errors) {
                            //  console.log(errors);
                        });
            }
        }
    });

    $(".alert").delay(4000).slideUp(200, function () {
        $(this).alert('close');
    });

</script>

@endsection