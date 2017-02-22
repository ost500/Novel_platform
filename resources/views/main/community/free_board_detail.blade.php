@extends('layouts.main_layout')
@section('content')
        <!-- 컨테이너 -->
<div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="wrap" id="free_board">
        <!-- LNB -->
        @include('main.community.LNB')
                <!-- //LNB -->

        <!-- 서브컨텐츠 -->
        <div class="content" id="content">
            @if(Session::has('flash_message'))
                {{-- important, success, warning, danger and info --}}
                <div class="alert alert-success">
                    {{Session('flash_message')}}
                </div>
                @endif
            <!-- 게시판상세 -->
            <article class="bbs-view">
                <h2 class="bbs-view-title">{{ $article->title }}</h2>

                <div class="bbs-view-info">
                    <div class="writer">{{ $article['users']['name'] }}</div>
                    <div class="etc"><span>작성일 {{ $article->created_at }}</span>
                        <span>조회수 {{ $article->view_count }}</span></div>
                </div>
                @if(Auth::check() && Auth::user()->id == $article->user_id)
                <div class="bbs-view-manage"><a href="{{route('free_board.edit',['id' => $article->id ]) }}"><i class="setup-icon">수정</i></a></div>
                @endif
                <!-- 게시물본문 -->
                <div class="bbs-view-content">
                    <p>
                        <?php echo nl2br($article->content); ?>
                    </p>
                </div>
                <!-- //게시물본문 -->
                <div class="bbs-view-content-btns">

                    @if(!$show_liked)
                        <a class="like-btn" v-on:click="freeBoardLike('{{$article->id}}')" style="cursor:pointer;">
                            <i class="fa fa-heart-o fa-2x" aria-hidden="true"> </i>
                            <span class="like-count" style="vertical-align:super;">{{ $article->likes_count }}</span>
                        </a>
                    @else
                        <a class="like-btn" v-on:click="freeBoardDislike()" style="cursor:pointer;"><i
                                    class="fa fa-heart fa-2x" aria-hidden="true"></i>
                            <span class="like-count" style="vertical-align:super;">{{ $article->likes_count }}</span>
                        </a>
                    @endif


                    <div class="right-btns">
                        <a href="{{ route('accusations', ['id' => $article->users->id]) }}" class="report-btn"><i
                                    class="report-icon"></i> 게시물 신고</a>
                    </div>
                </div>
                <div class="bbs-view-btns"><a href="{{ route('free_board') }}" class="btn">목록</a></div>
                <!-- 댓글목록 -->
                <section class="bbs-comment">
                    <div class="comments">
                        <div class="comment-list-header">
                            <h2 class="title">댓글</h2>
                            <span class="count">{{$article->comments_count}}</span>
                        </div>
                        <ul class="comment-list">
                            @foreach($article->comments as $comment)
                                <li>
                                    <div class="comment-wrap">
                                        <div class="comment-info"><span
                                                    class="writer">{{ $comment['users']['name'] }}</span><span
                                                    class="datetime">{{ $comment->created_at }}</span></div>
                                        <div class="comment-btns"><a href="#mode_nav">답글</a><a
                                                    href="{{ route('accusations', ['id' => $comment->users->id]) }}">신고</a>
                                        </div>
                                        <div class="comment-content">
                                            <p><?php echo nl2br($comment->comment); ?></p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <!-- //댓글목록 -->
                <!-- 댓글쓰기 -->
                <div class="bbs-comment-form">
                    <form
                            method="post"
                            action="{{route('freeboard.comment',['id'=>$article->id])}}"

                            class="comment-form">
                        {!! csrf_field() !!}
                        <div class="comment-form-wrap">
                                <textarea name="comment" class="textarea2" placeholder="남을 상처주지 않는 바르고 고운 말을 씁시다."
                                          title="댓글내용"
                                          @if($errors->count() > 0)autofocus @endif>{{ old('comment') }}</textarea>

                            <div class="comment-form-btns">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                <span class="submit">
                                    <button type="submit" class="btn">등록</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- //댓글쓰기 -->
            </article>
            <!-- //게시판상세 -->
            <!-- 이전글다음글 -->
            <ul class="prev-next">
                @if($prev_article != null)
                    <li>
                        <span class="head head--prev">이전글</span>
                            <span class="subject"><a
                                        href="{{ route('free_board.detail',['id'=>$prev_article->id]) }}">{{$prev_article->title}}</a></span>
                        <span class="writer">{{$prev_article['users']['name']}}</span>
                        <span class="datetime">{{ $prev_article->created_at->format('Y-m-d') }}</span>
                    </li>
                @endif
                @if($next_article != null)
                    <li>
                        <span class="head head--next">다음글</span>
                            <span class="subject"><a
                                        href="{{ route('free_board.detail',['id'=>$next_article->id]) }}">{{$next_article->title}}</a></span>
                        <span class="writer">{{$next_article['users']['name']}}</span>
                        <span class="datetime">{{ $next_article->created_at->format('Y-m-d') }}</span>
                    </li>
                @endif
            </ul>
            <!-- //이전글다음글 -->
        </div>
        <!-- //서브컨텐츠 -->
        <!-- 따라다니는퀵메뉴 -->
        @include('main.quick_menu')
                <!-- //따라다니는퀵메뉴 -->
    </div>
</div>
<!-- //컨테이너 -->
<script type="text/javascript">
    var app_free_board = new Vue({
        el: '#free_board',
        data: {
            like_info: {free_board_id: ''},
            add_favorite_disp: true,
            remove_favorite_disp: false

        },
        methods: {

            freeBoardLike: function (free_board_id) {
                app_free_board.like_info.free_board_id = free_board_id;
                app_free_board.$http.post('{{ route('free_board_likes.store') }}', app_free_board.like_info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                        .then(function (response) {
                            //  document.getElementById('tab' + publish_company_id).style.display = 'none';
                            console.log(response);
                            /* app.add_favorite_disp = false;
                             app.remove_favorite_disp = true;*/
                            location.reload();
                        })
                        .catch(function (errors) {
                            console.log(errors);
                            window.location.assign('/login?loginView=true');
                        });
            },
            freeBoardDislike: function () {
                app_free_board.$http.delete('{{ route('free_board_likes.destroy',['id'=>$article->id]) }}', {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                        .then(function (response) {
                            //  document.getElementById('tab' + publish_company_id).style.display = 'none';
                            console.log(response);
                            /* app.add_favorite_disp = false;
                             app.remove_favorite_disp = true;*/
                            location.reload();
                        })
                        .catch(function (errors) {
                            console.log(errors);
                            window.location.assign('/login?loginView=true');
                        });
            }
        }
    });
</script>
@endsection