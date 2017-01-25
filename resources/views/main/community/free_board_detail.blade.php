@extends('layouts.main_layout')
@section('content')
    <!-- 컨테이너 -->
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
        @include('main.community.LNB')
        <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 게시판상세 -->
                <article class="bbs-view">
                    <h2 class="bbs-view-title">{{ $article->title }}</h2>
                    <div class="bbs-view-info">
                        <div class="writer">{{ $article['users']['name'] }}</div>
                        <div class="etc"><span>작성일 {{ $article->created_at }}</span>
                            <span>조회수 {{ $article->view_count }}</span></div>
                    </div>
                    <div class="bbs-view-manage"><a href="#mode_nav"><i class="setup-icon">수정</i></a></div>
                    <!-- 게시물본문 -->
                    <div class="bbs-view-content">
                        <p>
                            <?php echo nl2br($article->content); ?>
                        </p>
                    </div>
                    <!-- //게시물본문 -->
                    <div class="bbs-view-content-btns">
                        <a href="#mode_nav" class="like-btn"><i class="like-icon">좋아요</i><span
                                    class="like-count">{{ $article->likes_count }}</span></a>
                        <div class="right-btns">
                            <a href="#mode_nav" class="report-btn"><i class="report-icon"></i> 게시물 신고</a>
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
                                                        href="#mode_nav">신고</a>
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
                            <span class="head head--prevnext">이전글</span>
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
            <div class="aside-nav" id="aside_nav">
                <nav>
                    <ul class="aside-menu">
                        <li><a href="#mode_nav" class="userbtn userbtn--alarm"><span>알림</span></a></li>
                        <li><a href="#mode_nav" class="userbtn userbtn--memo"><span>쪽지</span></a></li>
                        <li><a href="#mode_nav" class="userbtn userbtn--myinfo"><span>마이메뉴</span></a></li>
                        <li><a href="#mode_nav" class="userbtn userbtn--scrap"><span>선호작</span></a></li>
                        <li><a href="#mode_nav" class="userbtn userbtn--marble"><span>보유구슬</span></a></li>
                    </ul>
                </nav>
            </div>
            <!-- //따라다니는퀵메뉴 -->
        </div>
    </div>
    <!-- //컨테이너 -->
@endsection