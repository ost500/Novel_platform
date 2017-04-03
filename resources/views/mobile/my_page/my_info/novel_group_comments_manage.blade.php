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
            <div class="" id="novel_group_comments">
                <div class="replst_head">
                    <h3 class="mlist_tit4">소설 댓글 관리<em class="repcount">({{count($novel_comments) }})</em></h3>

                    <div class="sort_area">
                        <a href="{{route('my_info.novel_comments_manage').'?order=latest' }}"
                           @if($order=='latest' or $order=='' ) class="sort_btn sort_on"
                           @else class="sort_btn sort_off" @endif >최신순</a>
                        <a href="{{route('my_info.novel_comments_manage').'?order=normal' }}"
                           @if($order=='normal') class="sort_btn sort_on" @else class="sort_btn sort_off" @endif>등록순</a>
                    </div>
                </div>

                <!-- 게시글 테이블 -->
                <table class="tbl_dotline">
                    <colgroup>
                        <col width="*">
                        <col width="20%">
                    </colgroup>
                    <tbody>
                    @if(count($novel_comments) > 0)

                        @foreach($novel_comments as $novel_comment)
                            <tr>
                                <td class="contxt  @if($novel_comment->parent_id != 0) repl_lst_re @endif">

                                    <a href="{{ route('each_novel.novel_group_inning', ['id' => $novel_comment->novels_id]) }}">

                                        <div class="borContTit">{{$novel_comment->novel_title}} <span
                                                    class="mtbl_binfo_sl"></span>
                                            <span class="brw_24">{{$novel_comment->user_name}}</span></div>
                                    </a>


                                    <div class="tbl_binfo22" v-show="!display.status">{{$novel_comment->comment}} </div>
                                    <div class="tbl_binfo22" id="comment_box{{$novel_comment->id}}"
                                         v-if="display.id =={{$novel_comment->id}} && display.status">
                                        <textarea name="comment" id="comment{{$novel_comment->id}}"
                                                  rows="2">{{$novel_comment->comment}}</textarea>
                                        <button name="edit" id="edit{{$novel_comment->id}}"
                                                v-on:click="update_comment('{{$novel_comment->id}}')"
                                                class="btn_green full">수정
                                        </button>
                                    </div>

                                    <div class="tbl_binfo22 padt10">{{$novel_comment->inning}}회 <span
                                                class="mtbl_binfo_sl"></span>{{time_elapsed_string($novel_comment->created_at)}}
                                    </div>
                                </td>
                                <td class="talC">
                                    <div><a v-on:click="comment_box_show({{$novel_comment->id}})"
                                            class="sbtn_line_gray">수정</a></div>
                                    <div class="mart8"><a v-on:click="remove_comment('{{$novel_comment->id}}')"
                                                          class="sbtn_line_gray">삭제</a></div>
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
                @include('pagination_mobile', ['collection' => $novel_comments, 'url' => route('my_info.novel_comments_manage').'?order='.$order.'&'])
            </div>        <!-- 페이징 //-->
    </div>
    <!-- 댓글 관리 //-->
</div>
</div>
<!-- 내용 //-->
<script type="text/javascript">
    var app = new Vue({
        el: '#novel_group_comments',
        data: {
            info: {comment_type: '', comment: ''},
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
            remove_comment: function (comment_id) {

                if (confirm('삭제 하시겠습니까?')) {

                    app.$http.delete('{{ url('comments') }}/' + comment_id, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {
                                location.reload();
                            }).catch(function (errors) {
                                // console.log(errors);
                            });
                }
            },

            update_comment: function (comment_id, comment_type) {

                this.info.comment_type = comment_type;
                this.info.comment = $('#comment' + comment_id).val();

                app.$http.put('{{ url('comments') }}/' + comment_id, this.info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                        .then(function (response) {
                            location.reload();

                        }).catch(function (errors) {
                            // console.log(errors);
                        });
            }
        }
    });

    $(".alert").delay(4000).slideUp(200, function () {
        $(this).alert('close');
    });

</script>

@endsection