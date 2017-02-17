@extends('layouts.main_layout')
@section('content')
    <!-- 컨테이너 -->
    <div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">
        <div class="wrap" id="free_board_review_comments">
            <!-- LNB -->
        @include('main.my_page.left_sidebar')
        <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 댓글목록 -->
                @if(Session::has('flash_message'))
                    {{-- important, success, warning, danger and info --}}
                    <div class="alert alert-success">
                        {{Session('flash_message')}}
                    </div>
                @endif
                <div class="comments comments--manage">
                    <div class="comment-list-header">
                        <h2 class="title">일반 댓글 관리</h2>
                        <span class="count">{{$comments->total()}}</span>
                        <!-- 댓글정렬 -->
                        <div class="sort-nav sort-nav--comment">
                            <nav>
                                <ul>
                                    <li>
                                        <a href="{{route('my_info.free_board_review_comments_manage').'?filter='.$filter.'&order=latest' }}"
                                           @if($order=='latest' or $order=='' ) class="is-active" @endif>최신순</a></li>
                                    <li>
                                        <a href="{{route('my_info.free_board_review_comments_manage').'?filter='.$filter.'&order=normal' }}"
                                           @if($order=='normal') class="is-active" @endif >등록순</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!-- //댓글정렬 -->
                    </div>
                    <div class="list-header">
                        <div class="links" style="margin-top: 5px;">
                            <a href="{{route('my_info.free_board_review_comments_manage').'?filter=free_board_comments&order='.$order }}"
                               @if( $filter =='free_board_comments' or $filter == null ) class="is-active"
                               @endif style="margin-right: 5px;">자유게시판 </a>

                            <a href="{{route('my_info.free_board_review_comments_manage').'?filter=review_comments&order='.$order }}"
                               @if( $filter =='review_comments') class="is-active" @endif>독자추천</a>
                        </div>
                    </div>
                    <ul class="comment-list">
                        @if(count($comments) > 0)
                            @foreach($comments as $comment)
                                <li>
                                    <div class="comment-wrap  @if($comment->parent_id != 0) is-reply @endif">
                                        <div class="comment-info"><span class="parent-subject">
                                                @if($filter == 'free_board_comments' or $filter == '')
                                                    <a href="{{ route('free_board.detail', ['id'=>$comment->free_board_id]) }}">{{$comment->title}}</a>
                                                @else
                                                    <a href="{{ route('reader_reco.detail', ['id'=>$comment->review_id]) }}">{{$comment->title}}</a>
                                                @endif

                                                                </span>
                                            <span class="writer">{{$comment->user_name}}</span></div>
                                        <div class="comment-btns">
                                            <a href="#mode_nav" v-on:click="comment_box_show({{$comment->id}})">수정</a>
                                            <a href="#mode_nav"
                                               @if($comment->review_id) v-on:click="remove_comment('{{$comment->id}}','review')"
                                               @else v-on:click="remove_comment('{{$comment->id}}','free_board')" @endif >
                                                삭제 </a>
                                        </div>
                                        <div class="comment-content" v-show="!display.status">
                                            <p>{{$comment->comment}}</p>
                                        </div>
                                        <div class="comment-content " id="comment_box{{$comment->id}}"
                                             v-if="display.id =={{$comment->id}} && display.status">
                                    <textarea name="comment" id="comment{{$comment->id}}" rows="3"
                                              style="width:65%;">{{$comment->comment}}</textarea>

                                            <button name="edit" id="edit{{$comment->id}}" @if($comment->review_id)
                                            v-on:click="update_comment('{{$comment->id}}','review')"
                                                    @else    v-on:click="update_comment('{{$comment->id}}','free_board')"
                                                    @endif
                                                    class="btn btn-primary inline"
                                                    style="width:100px;height:51px;vertical-align: top;">
                                                Edit
                                            </button>
                                        </div>

                                        <div class="comment-etc-info">@if(!isset($filter) or $filter =='free_board_comments' )
                                                자유게시판 @else 독자추천 @endif<span
                                                    class="datetime">{{time_elapsed_string($comment->created_at)}}</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <div class="comment-wrap" style="text-align: center"> 첫 번째 댓글을 작성해 보세요.</div>
                        @endif
                    </ul>
                </div>
                <!-- //댓글목록 -->
                <!-- 페이징 -->
            @include('pagination_front', ['collection' => $comments, 'url' => route('my_info.free_board_review_comments_manage').'?filter='.$filter.'&order='.$order.'&'])

            <!-- //페이징 -->
            </div>
            <!-- //서브컨텐츠 -->
            <!-- 따라다니는퀵메뉴 -->
        @include('main.quick_menu')
        <!-- //따라다니는퀵메뉴 -->
        </div>
    </div>
    <!-- //컨테이너 -->
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
                            console.log(errors);
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
                        console.log(errors);
                    });
                }
            }
        });

        $(".alert").delay(4000).slideUp(200, function () {
            $(this).alert('close');
        });

    </script>
@endsection