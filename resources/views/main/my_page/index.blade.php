@extends('../layouts.main_layout')
@section    ('content')
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
            @include('main.my_page.left_sidebar')
                    <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 내정보 -->
                <section class="myinfo">
                    <h2 class="hidden">My정보</h2>

                    <div class="myinfo-box">
                        <!-- 회원정보 -->
                        <div class="col-member">
                            <strong class="user-name">{{$my_profile->name}}</strong>
                            <span class="user-id">kimdal</span>
                            <span class="user-email">{{$my_profile->email}}</span>
                            <a href="#mode_nav" class="btn btn--special">로그아웃</a>
                            <a href="#mode_nav" class="setup-btn"><i class="setup-icon">설정</i></a>
                        </div>
                        <!-- 보유구슬 -->
                        <div class="col-marble">
                            <i class="marble3-icon"></i>
                            <span class="item-name">보유구슬</span>
                            <strong class="item-count">1,170개</strong>
                            <a href="#mode_nav" class="btn btn--submit">구슬충전</a>
                        </div>
                        <!-- 보유조각 -->
                        <div class="col-piece">
                            <i class="piece3-icon"></i>
                            <span class="item-name">보유조각</span>
                            <strong class="item-count">0개</strong>
                            <span class="item-etc">소멸 예정 0개</span>
                        </div>
                        <!-- 선호작 -->
                        <div class="col-scrap">
                            <i class="scrap3-icon"></i>
                            <span class="item-name">선호작</span>
                            <strong class="item-count">32작품</strong>
                        </div>
                    </div>
                </section>
                <!-- //내정보 -->

                <!-- 최근구매내역 -->
                <section class="latest-wrap latest-wrap--mypage">
                    <h2 class="latest-title">최근 구매 내역</h2>
                    <ul class="latest">
                        @if(count($recently_purchased_novels)  > 0)
                        @foreach($recently_purchased_novels as $recently_purchased_novel )
                            <li>
                                <a href="{{route('each_novel.novel_group',['id'=>$recently_purchased_novel->id])}}">
                                    <p class="thumb"><img
                                                src="/img/novel_covers/{{$recently_purchased_novel->cover_photo}}"
                                                alt=""></p>

                                    <p class="book-title">{{str_limit($recently_purchased_novel->title,5)}}</p>

                                    <p class="author">{{$recently_purchased_novel->nicknames->nickname}}</p>
                                </a>
                            </li>
                        @endforeach
                        @else
                            <div style="text-align:center;"> You have no purchased novels. Please purchase one. </div>
                        @endif

                    </ul>
                    <a href="#mode_nav" class="latest-more-btn">더보기</a>
                </section>
                <!-- //최근구매내역 -->

                <!-- 선호작업데이트 -->
                <section class="latest-wrap latest-wrap--mypage">
                    <h2 class="latest-title">선호작 업데이트</h2>
                    <ul class="latest">
                        @if(count($recently_updated_favorites)  > 0)
                        @foreach($recently_updated_favorites as $recently_updated_favorite )
                        <li>
                            <a href="{{route('each_novel.novel_group',['id'=>$recently_updated_favorite->id])}}">
                                <p class="thumb"><img src="/img/novel_covers/{{$recently_updated_favorite->cover_photo}}" alt=""></p>

                                <p class="book-title">{{str_limit($recently_updated_favorite->title,5)}}</p>

                                <p class="author">{{$recently_updated_favorite->nicknames->nickname}}</p>
                            </a>
                        </li>
                        @endforeach
                            @else
                                <div style="text-align:center;"> You have no favourite novels yet. Please make some favourite. </div>
                            @endif
                    </ul>
                    <a href="#mode_nav" class="latest-more-btn">더보기</a>
                </section>
                <!-- //선호작업데이트 -->
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