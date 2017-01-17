@extends('../layouts.main_layout')
@section('content')
    <div class="container">
        <div class="wrap">
            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 연재소개 -->
                <section class="novel-detail">
                    <div class="novel-detail-content">
                        <p class="thumb"><span><img src="imgs/novel_covers/{{ $novel_group->cover_photo }}" alt="공녀 엘린느"></span></p>
                        <div class="post">
                            <div class="post-header">
                                <h2 class="title">{{ $novel_group->title }}</h2>
                                <p class="writer">{{ $novel_group->nicknames->nicknames }} <a href="#mode_nav"><i class="memo-icon">쪽지</i></a></p>
                                <p class="post-info">
                                    <span>로맨스판타지</span>
                                    <span>총 {{$novel_group->max_innng}}화</span>
                                    <span>조회수 78,912</span>
                                    <span>선호작 4,028명</span>
                                </p>
                            </div>
                            <div class="post-content">
                                <p>
                                    {{$novel_group->description}}
                                    <button class="more-btn hidden-content-view">더보기</button>
                                    <span class="hidden-content">숨은내용 나옵니다.<br>숨은내용 나옵니다. 숨은내용 나옵니다. End</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="novel-view"><a href="#mode_nav" class="btn btn--special">첫화보기</a></div>
                    <div class="scrap-btns">
                        <a href="#mode_nav" class="is-active"><i class="scrap-active-icon"></i>선호작추가</a>
                        <a href="#mode_nav"><i class="share-icon"></i>공유하기</a>
                    </div>
                </section>
                <!-- //연재소개 -->
                <!-- 연재회차,작가다른작품,해시태그 -->
                <div class="episode-list-content">
                    <div class="episode-list-group">
                        <!-- 최근읽은회차 -->
                        <section class="episode-list-wrap episode-list-wrap--latest">
                            <h2 class="episode-title">최근 읽은 회차</h2>
                            <ul class="episode-list">
                                <li>
                                    <div class="col-no">
                                        <span class="no">8화</span>
                                        <span class="datetime">2016.06.16</span>
                                    </div>
                                    <div class="col-title"><a href="#mode_nav">2. 데뷔, 그리고 약혼 (3) <i class="up-icon">Up</i></a></div>
                                    <div class="col-charge"><span class="open">열림</span></div>
                                </li>
                            </ul>
                        </section>
                        <!-- //최근읽은회차 -->

                        <!-- 연재회차 -->
                        <section class="episode-list-wrap">
                            <h2 class="episode-title">연재회차</h2>
                            <ul class="episode-list">
                                @foreach($novel_group->novels as $novel)
                                <li>
                                    <div class="col-no">
                                        <span class="no">{{$loop->count - $loop->index}} 화</span>
                                        <span class="datetime">{{$novel->created_at}}</span>
                                    </div>
                                    <div class="col-title"><a href="#mode_nav">{{$novel->created_at}}<i class="up-icon">Up</i></a></div>
                                    <div class="col-charge">@if($novel->non_free_agreement > 0) 유료 @else <span class="free">무료</span> @endif {{-- <span class="open">열림</span>--}}</div>
                                </li>
                                @endforeach

                            </ul>
                        </section>
                        <!-- //연재회차 -->
                    </div>
                    <div class="episode-list-aside">
                        <!-- 작가다른작품 -->
                        <section>
                            <div class="recommend recommend--more">
                                <h2 class="recommend-title">작가의 다른 작품</h2>
                                <ul class="recommend-list">
                                    @foreach($author_novel_groups as $author_novel_group)
                                    <li>
                                        <a href="#mode_nav">
                                            <div class="thumb">
                                                <span><img src="imgs/thumb/novel_more1.png" alt=""></span>
                                            </div>
                                            <div class="post">
                                                <strong class="title">{{$author_novel_group->title}}</strong>
                                                <p class="post-content">
                                                    로맨스판타지<br>
                                                    총 {{$author_novel_group->max_inning}}화<br>
                                                    선호작 6,289명
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                    <li>
                                        <a href="#mode_nav">
                                            <div class="thumb">
                                                <span><img src="imgs/thumb/novel_more2.png" alt=""></span>
                                            </div>
                                            <div class="post">
                                                <strong class="title">연리초</strong>
                                                <p class="post-content">
                                                    시대로맨스<br>
                                                    총 152화<br>
                                                    선호작 3,117명
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#mode_nav">
                                            <div class="thumb">
                                                <span><img src="imgs/thumb/novel_more3.png" alt=""></span>
                                            </div>
                                            <div class="post">
                                                <strong class="title">가란잠</strong>
                                                <p class="post-content">
                                                    시대로맨스<br>
                                                    총 98화<br>
                                                    선호작 4993명
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <a href="#mode_nav" class="recommend-more-btn">더보기</a>
                            </div>
                            <!-- 페이징 -->
                            <div class="page-nav page-nav--small">
                                <nav>
                                    <ul>
                                        <li><a href="#mode_nav" class="prev-page"><span>이전</span></a></li>
                                        <li><a href="#mode_nav" class="current-page">1</a></li>
                                        <li><a href="#mode_nav">2</a></li>
                                        <li><a href="#mode_nav" class="next-page"><span>다음</span></a></li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- //페이징 -->
                        </section>
                        <!-- //작가다른작품 -->

                        <!-- 해시태그 -->
                        <section class="hash-tag">
                            <h2 class="hash-tag-title">해시태그</h2>
                            <ul class="hash-tag-list">
                                <li><a href="#mode_nav">{{$novel_group->keyword1}}</a></li>
                                <li><a href="#mode_nav">{{$novel_group->keyword2}}정략결혼</a></li>
                                <li><a href="#mode_nav">{{$novel_group->keyword3}}회귀물</a></li>
                                <li><a href="#mode_nav">{{$novel_group->keyword4}}황제 / 황태자</a></li>
                                <li><a href="#mode_nav">{{$novel_group->keyword5}}나쁜남자</a></li>
                                <li><a href="#mode_nav">{{$novel_group->keyword6}}후회남</a></li>
                                <li><a href="#mode_nav">{{$novel_group->keyword7}}까칠남</a></li>
                            </ul>
                        </section>
                        <!-- //해시태그 -->
                    </div>
                </div>
                <!-- //연재회차,작가다른작품,해시태그 -->
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
    <!-- 푸터 -->
@endsection