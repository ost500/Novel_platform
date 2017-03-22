@extends('layouts.mobile_layout')
@section('content')
        <!-- 내용 -->
<div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="cont_wrap" id="free_board">
        @if(Session::has('flash_message'))
            {{-- important, success, warning, danger and info --}}
            <div class="alert alert-success" style="margin-top: 15px;">
                {{Session('flash_message')}}
            </div>
            @endif
                    <!-- 타이틀 -->
            <div class="view_tit_box mart20" style="border-top:0;">
                <h2 class="view_tit">{{ $article->title }}<span class="author">{{ $article['users']['name'] }}</span>
                </h2>

                <div class="expatiate_wrap">
                    <span class="expatiate">작성일 {{ $article->created_at }}</span>
                    <span class="expatiate_sl"></span>
                    <span class="expatiate">조회수 {{$article->view_count }}</span>
                </div>
            </div>
            <!-- 타이틀 //-->

            <!-- 본문 -->
            <div class="view_article_wrap">
                <div class="view_artic_cont">
                    <?php echo nl2br($article->content); ?>
                </div>
                <div class="participation_area">
                    @if(!$show_liked)
                        <div class="al_left">
                            <a v-on:click="freeBoardLike('{{$article->id}}')" style="cursor:pointer;"
                               class="icon_btn_a"><span class="icon ico_love">좋아요</span>
                                <span class="gray2">{{ $article->likes_count }}</span>
                            </a>
                            <!--<a href="" class="icon_btn_a"><span class="icon ico_love_on">좋아요</span> <span class="red">10</span></a>-->
                        </div>
                    @else
                        <a v-on:click="freeBoardDislike('{{$article->id}}')" style="cursor:pointer;" class="icon_btn_a"><span
                                    class="icon ico_love_on">좋아요</span>
                            <span class="gray2">{{ $article->likes_count }}</span>
                        </a>
                    @endif
                    <div class="al_right">
                        <a href="{{ route('accusations', ['id' => $article->users->id]) }}" class="icon_btn_a"><span
                                    class="icon ico_alert">신고</span><span class="al_right_txt">게시물 신고</span></a>
                    </div>
                </div>
                @if(Auth::check() && Auth::user()->id == $article->user_id)
                    <div class="view_admin"><a href="{{route('free_board.edit',['id' => $article->id ]) }}"
                                               class="view_admin_btn">관리</a></div>
                @endif
            </div>
            <!-- 본문 //-->

            <!-- 버튼 -->
            <div class="veiw_btn_wrap">
                <div class="mart20"><a href="{{ route('free_board') }}" class="btn_list_view full">목록</a></div>
            </div>
            <!-- 버튼 //-->

            <!-- 댓글 -->
            <div class="repl_lst_wrap padt50">
                <div class="replst_head">
                    <h3 class="mlist_tit4">댓글<span class="repcount">({{$article->comments_count}})</span></h3>

                    <div class="sort_area">
                        <a href="{{ route('free_board.detail', ['id' => $article->id]).'?order=latest' }}"
                           @if($order == 'latest' or $order == null ) class="sort_btn sort_on"
                           @else class="sort_btn sort_off" @endif>최신순</a>
                        <a href="{{ route('free_board.detail', ['id' => $article->id]).'?order=oldest' }}"
                           @if($order == 'oldest')  class="sort_btn sort_on"
                           @else class="sort_btn sort_off" @endif>등록순</a>
                    </div>
                </div>
                <ul class="repl_lst">
                    @foreach($article_comments as $comment)
                        <li>
                            <div class="replst_tit">{{ $comment[0]->users->name  }}<span
                                        class="replst_time">{{ $comment[0]->created_at }}</span></div>
                            <div class="replst_cont"><?php echo nl2br($comment[0]->comment); ?></div>
                            <div class="replst_btn_wrap">
                                <a v-on:click="new_box_show({{$comment[0]->id}})" style="cursor: pointer;"
                                   class="replst_btn">답글</a>
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
                        @foreach($article_comments[$loop->index]['children'] as $comment_reply)
                            <li class="repl_lst_re">
                                <div class="replst_tit">{{ $comment_reply->users->name }}
                                    <span class="replst_time">{{ $comment_reply->created_at }}</span></div>
                                <div class="replst_cont"><?php echo nl2br($comment_reply->comment); ?></div>
                                <div class="replst_btn_wrap">
                                    <a href="{{ route('accusations', ['id' => $comment_reply->users->id]) }}"
                                       class="replst_btn">신고</a>
                                </div>
                            </li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
            <!-- 댓글 //-->

            <!-- 댓글쓰기 -->
            <div class="repl_write_wrap mart20">
                <form method="post" action="{{route('freeboard.comment',['id'=>$article->id])}}"
                      class="comment-form">
                    {!! csrf_field() !!}
                    <textarea name="comment" class="repl_txtar" rows="3" cols="30" placeholder="여러분의 소중한 댓글을 입력해 주세요"
                              @if($errors->count() > 0)autofocus @endif>{{ old('comment') }}</textarea>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    <div class="padt15">
                        <button type="submit" class="btn_green full">등록</button>
                    </div>
                </form>
            </div>
            <!-- 댓글쓰기 //-->
    </div>
</div>
<!-- 내용 //-->
<script type="text/javascript">
    var app_free_board = new Vue({
        el: '#free_board',
        data: {
            like_info: {free_board_id: ''},
            add_favorite_disp: true,
            remove_favorite_disp: false,
            sub_info: {comment: '', parent_id: ''},
            new_box_display: {id: '', status: false},
            errorsInfo: {}

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
                app_free_board.sub_info.parent_id = $('#parent_id' + comment_id).val();
                app_free_board.$http.post('{{ route('freeboard.comment',['id'=>$article->id]) }}', app_free_board.sub_info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
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
            },

            freeBoardLike: function (free_board_id) {
                app_free_board.like_info.free_board_id = free_board_id;
                app_free_board.$http.post('{{ route('free_board_likes.store') }}', app_free_board.like_info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                        .then(function (response) {
                            //  document.getElementById('tab' + publish_company_id).style.display = 'none';
                            /* app.add_favorite_disp = false;
                             app.remove_favorite_disp = true;*/
                            location.reload();
                        })
                        .catch(function (errors) {
                            //  console.log(errors);
                            window.location.assign('{{ url('/login')}}');
                        });
            },
            freeBoardDislike: function () {
                app_free_board.$http.delete('{{ route('free_board_likes.destroy',['id'=>$article->id]) }}', {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                        .then(function (response) {
                            //  document.getElementById('tab' + publish_company_id).style.display = 'none';
                            /* app.add_favorite_disp = false;
                             app.remove_favorite_disp = true;*/
                            location.reload();
                        })
                        .catch(function (errors) {
                            window.location.assign('{{ url('/login')}}');
                        });
            }
        }
    });
</script>
@endsection