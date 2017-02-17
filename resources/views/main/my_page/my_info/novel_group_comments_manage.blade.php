@extends('layouts.main_layout')
@section('content')
        <!-- 컨테이너 -->
<div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="wrap" id="novel_group_comments">
        <!-- LNB -->
        @include('main.my_page.left_sidebar')
                <!-- //LNB -->

        <!-- 서브컨텐츠 -->
        <div class="content" id="content">
            @if(Session::has('flash_message'))
                {{-- important, success, warning, danger and info --}}
                <div class="alert alert-success">
                    {{Session('flash_message')}}
                </div>
                @endif
                        <!-- 댓글목록 -->
                <div class="comments comments--manage">
                    <div class="comment-list-header">
                        <h2 class="title">소설 댓글 관리</h2>
                        <span class="count">{{count($novel_comments) }}</span>
                        <!-- 댓글정렬 -->
                        <div class="sort-nav sort-nav--comment">
                            <nav>
                                <ul>
                                    <li><a href="{{route('my_info.novel_comments_manage').'?order=latest' }}"
                                           @if($order=='latest' or $order=='' ) class="is-active" @endif>최신순</a></li>
                                    <li><a href="{{route('my_info.novel_comments_manage').'?order=normal' }}"
                                           @if($order=='normal') class="is-active" @endif >등록순</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!-- //댓글정렬 -->
                    </div>
                    <ul class="comment-list">
                        @if(count($novel_comments) > 0)
                            @foreach($novel_comments as $novel_comment)
                                <li>
                                    <div class="comment-wrap">
                                        <div class="comment-info"><span
                                                    class="parent-subject">{{$novel_comment->inning}} {{$novel_comment->novel_title}}</span><span
                                                    class="writer">{{$novel_comment->user_name}}</span></div>
                                        <div class="comment-btns"><a href="#mode_nav"
                                                                     v-on:click="comment_box_show({{$novel_comment->id}})">수정</a><a
                                                    href="#mode_nav"
                                                    v-on:click="remove_comment('{{$novel_comment->id}}')">삭제</a>
                                        </div>
                                        <div class="comment-content" v-show="!display.status">
                                            <p>{{$novel_comment->comment}}</p>
                                        </div>
                                        <div class="comment-content " id="comment_box{{$novel_comment->id}}"
                                             v-if="display.id =={{$novel_comment->id}} && display.status">

                                         <textarea name="comment" id="comment{{$novel_comment->id}}" rows="3"
                                                   style="width:65%;">{{$novel_comment->comment}}</textarea>

                                            <button name="edit" id="edit{{$novel_comment->id}}"
                                                    v-on:click="update_comment('{{$novel_comment->id}}')"
                                                    class="btn btn-primary inline"
                                                    style="width:100px;height:51px;vertical-align: top;">
                                                Edit
                                            </button>
                                        </div>

                                        <div class="comment-etc-info">{{str_limit($novel_comment->novel_group_title,70)}}
                                            <span
                                                    class="datetime">{{time_elapsed_string($novel_comment->created_at)}}</span>
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
                <div class="page-nav">
                    @include('pagination_front', ['collection' => $novel_comments, 'url' => route('my_info.novel_comments_manage').'?order='.$order.'&'])
                </div>
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
                                console.log(errors);
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