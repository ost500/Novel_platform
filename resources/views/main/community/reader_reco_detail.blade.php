@extends('layouts.main_layout')
@section('content')
    <!-- 컨테이너 -->
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
            <div class="lnb">
                <nav>
                    <h2 class="lnb-title">커뮤니티</h2>
                    <ul class="lnb-depth1">
                        <li>
                            <a href="{{route('free_board')}}">자유게시판</a>
                        </li>
                        <li>
                            <a href="{{route('reader_reco')}}" class="is-active">독자추천</a>
                            <ul class="lnb-depth2">
                                <li><a href="{{route('reader_reco')}}"
                                       @if($review->novel_groups->keywords[0]->name=='%')class="is-active"@endif>전체</a>
                                </li>
                                <li><a href="{{route('reader_reco')}}?genre=현대판타지"
                                       @if($review->novel_groups->keywords[0]->name=='현대판타지')class="is-active"@endif>현대판타지</a>
                                </li>
                                <li><a href="{{route('reader_reco')}}?genre=사극/현대물"
                                       @if($review->novel_groups->keywords[0]->name=='사극/현대물')class="is-active"@endif>사극/현대물</a>
                                </li>
                                <li><a href="{{route('reader_reco')}}?genre=동양판타지"
                                       @if($review->novel_groups->keywords[0]->name=='동양판타지')class="is-active"@endif>동양판타지</a>
                                </li>
                                <li><a href="{{route('reader_reco')}}?genre=서양/중세"
                                       @if($review->novel_groups->keywords[0]->name=='서양/중세')class="is-active"@endif>서양/중세</a>
                                </li>
                                <li><a href="{{route('reader_reco')}}?genre=로맨스판타지"
                                       @if($review->novel_groups->keywords[0]->name=='로맨스판타지')class="is-active"@endif>로맨스판타지</a>
                                </li>
                                <li><a href="{{route('reader_reco')}}?genre=미래/SF"
                                       @if($review->novel_groups->keywords[0]->name=='미래/SF')class="is-active"@endif>미래/SF</a>
                                </li>
                                <li><a href="{{route('reader_reco')}}?genre=메디컬로맨스"
                                       @if($review->novel_groups->keywords[1]->name=='메디컬로맨스')class="is-active"@endif>메디컬로맨스</a>
                                </li>
                                <li><a href="{{route('reader_reco')}}?genre=전문직로맨스"
                                       @if($review->novel_groups->keywords[1]->name=='전문직로맨스')class="is-active"@endif>전문직로맨스</a>
                                </li>
                                <li><a href="{{route('reader_reco')}}?genre=캠퍼스로맨스"
                                       @if($review->novel_groups->keywords[1]->name=='캠퍼스로맨스')class="is-active"@endif>캠퍼스로맨스</a>
                                </li>
                                <li><a href="{{route('reader_reco')}}?genre=학원로맨스"
                                       @if($review->novel_groups->keywords[1]->name=='학원로맨스')class="is-active"@endif>학원로맨스</a>
                                </li>
                                <li><a href="{{route('reader_reco')}}?genre=할리퀸로맨스"
                                       @if($review->novel_groups->keywords[1]->name=='할리퀸로맨스')class="is-active"@endif>할리퀸로맨스</a>
                                </li>
                                <li><a href="{{route('reader_reco')}}?genre=스포츠"
                                       @if($review->novel_groups->keywords[1]->name=='스포츠')class="is-active"@endif>스포츠</a>
                                </li>
                                <li><a href="{{route('reader_reco')}}?genre=연예계"
                                       @if($review->novel_groups->keywords[1]->name=='연예계')class="is-active"@endif>연예계</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 연재소개 -->
                <section class="novel-detail novel-detail--bbs">
                    <div class="novel-detail-content">
                        <p class="thumb"><span><img style="width: 138px; height: 206px;"
                                                    src="/img/novel_covers/{{$review->cover_photo}}"
                                                    alt="망의 연월"></span></p>
                        <div class="post">
                            <div class="post-header">
                                <h2 class="title">{{ $review->title }}</h2>
                                <p class="writer">{{ $review->users->name }}<a href="#mode_nav"><i
                                                class="memo-icon"></i><span
                                                class="hidden">쪽지</span></a></p>
                                <p class="post-info">
                                    <span>{{$review->novel_groups->keywords[0]->name}}</span>
                                    <span>{{$review->novel_groups->keywords[1]->name}}</span>
                                    <span>총 {{$review->novel_groups->novels->count()}}화</span>
                                    <span>조회수 {{ $review->total_count }}</span>
                                    <span>선호작 {{ $review->novel_groups->favorites->count() }}명</span>
                                </p>
                            </div>
                            <div class="post-content">
                                <p>
                                    <?php echo substr(nl2br($review->description), 0, 59) ?>
                                    <button class="more-btn hidden-content-view">더보기</button>
                                    <span class="hidden-content"><?php echo substr(nl2br($review->description), 59) ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="novel-view"><a href="#mode_nav" class="btn btn--special">첫화보기</a></div>
                    <div class="scrap-btns">
                        <a href="#mode_nav" class="scrap-btn"><i class="scrap-icon"></i>선호작추가</a>
                    </div>
                </section>
                <!-- //연재소개 -->

                <!-- 게시판상세 -->
                <article class="bbs-view">
                    <h2 class="bbs-view-title">{{ $review->review_title }}</h2>
                    <div class="bbs-view-info">
                        <div class="writer">{{ $review->users->name }}</div>
                        <div class="etc">
                            <span>작성일 {{ $review->created_at }}</span>
                            <span>조회수 {{ $review->view_count }}</span>
                        </div>
                    </div>
                    <div class="bbs-view-manage"><a href="#mode_nav"><i class="setup-icon"></i><span
                                    class="hidden">수정</span></a></div>
                    <!-- 게시물본문 -->
                    <div class="bbs-view-content">
                        <?php echo nl2br($review->review); ?>
                    </div>
                    <!-- //게시물본문 -->
                    <div class="bbs-view-content-btns">
                        <div class="right-btns">
                            <a href="#mode_nav" class="report-btn"><i class="report-icon"></i>게시물 신고</a>
                        </div>
                    </div>
                    <div class="bbs-view-btns">
                        <a href="#mode_nav" class="btn">목록</a>
                        <div class="right-btns">
                            <a href="#mode_nav" class="btn btn--special">이 소설의 다른 추천 보기</a> <a href="#mode_nav"
                                                                                               class="btn btn--special2">작성자의
                                다른 추천 보기</a>
                        </div>
                    </div>
                    <!-- 댓글목록 -->
                    <section class="bbs-comment">
                        <div class="comments">
                            <div class="comment-list-header">
                                <h2 class="title">댓글</h2>
                                <span class="count">{{ $review->comments->count() }}</span>
                                <!-- 댓글목록정렬 -->
                                <div class="sort-nav sort-nav--comment">
                                    <nav>
                                        <ul>
                                            <li><a href="#mode_nav" class="is-active">최신순</a></li>
                                            <li><a href="#mode_nav">등록순</a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- //작품목록정렬 -->
                            </div>
                            <ul class="comment-list">
                                @foreach ($review->comments as $comment)
                                    <li>
                                        <div class="comment-wrap">
                                            <div class="comment-info"><span
                                                        class="writer">{{ $comment->users->name }}</span> <span
                                                        class="datetime">{{ $comment->created_at }}</span>
                                            </div>
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
                                action="{{route('reader_reco.comment',['id'=>$review->review_id])}}"

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
                    @if($prev_review != null)
                        <li>
                            <span class="head head--prev">이전글</span>
                            <span class="subject"><a
                                        href="{{ route('reader_reco.detail',['id' => $prev_review->id]) }}">{{ $prev_review->title }}</a></span>
                            <span class="writer">{{ $prev_review->users->name }}</span>
                            <span class="datetime">{{ $prev_review->created_at->format('Y-m-d') }}</span>
                        </li>
                    @endif
                    @if($next_review != null)
                        <li>
                            <span class="head head--next">다음글</span>
                            <span class="subject"><a
                                        href="{{ route('reader_reco.detail',['id' => $next_review->id]) }}">{{ $next_review->title }}</a></span>
                            <span class="writer">{{ $next_review->users->name }}</span>
                            <span class="datetime">{{ $next_review->created_at->format('Y-m-d') }}</span>
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
@endsection