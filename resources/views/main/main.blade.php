@extends('layouts.main_layout')
@section('content')
    <!-- 컨테이너 -->
    <div class="container" id="content">
        <!-- 정오 -->
        <section class="noon">
            <div class="wrap">
                <h2 class="noon-title"><span>여</span>기, <span>정</span>오의 <span>추천</span></h2>
                <ul class="noon-list clr">
                    @foreach($recommends as $recommend)
                        <li>
                            <a href="#mode_nav">
                                <p class="thumb"><img src="/img/novel_covers/{{$recommend->cover_photo}}" alt=""></p>
                                <p class="book-title">{{str_limit($recommend->title, 15)}}</p>
                                <p class="author">{{str_limit($recommend->nicknames->nickname,15)}}</p>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
        <!-- //정오 -->

        <!-- 메인소설 -->
        <div class="wrap">
            <!-- 유료연재베스트 -->
            <section class="latest-wrap latest-wrap--charge">
                <h2 class="latest-title"><span>유료연재</span> 투데이 베스트</h2>
                <ol class="latest latest--rank latest--rank--charge">
                    <li>
                        <a href="#mode_nav">
                            <p class="thumb"><img src="imgs/thumb/charge_book1.png" alt=""></p>
                            <p class="book-title">망의 연월</p>
                            <p class="author">림랑 </p>
                        </a>
                    </li>
                    <li>
                        <a href="#mode_nav">
                            <p class="thumb"><img src="imgs/thumb/charge_book2.png" alt=""></p>
                            <p class="book-title">고백게임</p>
                            <p class="author">이비안</p>
                        </a>
                    </li>
                    <li>
                        <a href="#mode_nav">
                            <p class="thumb"><img src="imgs/thumb/charge_book3.png" alt=""></p>
                            <p class="book-title">낙원연가</p>
                            <p class="author">Girdap</p>
                        </a>
                    </li>
                    <li>
                        <a href="#mode_nav">
                            <p class="thumb"><img src="imgs/thumb/charge_book4.png" alt=""></p>
                            <p class="book-title">공녀 엘린느</p>
                            <p class="author">박초율</p>
                        </a>
                    </li>
                    <li>
                        <a href="#mode_nav">
                            <p class="thumb"><img src="imgs/thumb/charge_book5.png" alt=""></p>
                            <p class="book-title">초콜릿 객잔 702번지</p>
                            <p class="author">림랑</p>
                        </a>
                    </li>
                    <li>
                        <a href="#mode_nav">
                            <p class="thumb"><img src="imgs/thumb/charge_book6.png" alt=""></p>
                            <p class="book-title">연애한도초과</p>
                            <p class="author">김현서</p>
                        </a>
                    </li>
                    <li>
                        <a href="#mode_nav">
                            <p class="thumb"><img src="imgs/thumb/charge_book7.png" alt=""></p>
                            <p class="book-title">순수의 욕망</p>
                            <p class="author">럼</p>
                        </a>
                    </li>
                    <li>
                        <a href="#mode_nav">
                            <p class="thumb"><img src="imgs/thumb/charge_book8.png" alt=""></p>
                            <p class="book-title">달꽃너울</p>
                            <p class="author">Milkymoon</p>
                        </a>
                    </li>
                    <li>
                        <a href="#mode_nav">
                            <p class="thumb"><img src="imgs/thumb/charge_book9.png" alt=""></p>
                            <p class="book-title">울지마 유령</p>
                            <p class="author">림랑</p>
                        </a>
                    </li>
                    <li>
                        <a href="#mode_nav">
                            <p class="thumb"><img src="imgs/thumb/charge_book10.png" alt=""></p>
                            <p class="book-title">한설</p>
                            <p class="author">Milkymoon</p>
                        </a>
                    </li>
                    <li>
                        <a href="#mode_nav">
                            <p class="thumb"><img src="imgs/thumb/charge_book10.png" alt=""></p>
                            <p class="book-title">늑대의 주인</p>
                            <p class="author">이에르바</p>
                        </a>
                    </li>
                </ol>
                <a href="#mode_nav" class="latest-more-btn">더보기</a>
            </section>
            <!-- //유료연재베스트 -->

            <!-- 무료,새소설,독자추천 -->
            <div class="latest-content">
                <div class="latest-group">
                    <!-- 무료연재베스트 -->
                    <section class="latest-wrap latest-wrap--free">
                        <h2 class="latest-title"><span>무료연재</span> 투데이 베스트 </h2>
                        <ol class="latest latest--rank">
                            <li>
                                <a href="#mode_nav">
                                    <p class="thumb"><img src="imgs/thumb/free_book1.png" alt=""></p>
                                    <p class="book-title">꽃날</p>
                                    <p class="author">Milkymoon</p>
                                </a>
                            </li>
                            <li>
                                <a href="#mode_nav">
                                    <p class="thumb"><img src="imgs/thumb/free_book2.png" alt=""></p>
                                    <p class="book-title">뷰티풀 라이프</p>
                                    <p class="author">블루데빌</p>
                                </a>
                            </li>
                            <li>
                                <a href="#mode_nav">
                                    <p class="thumb"><img src="imgs/thumb/free_book3.png" alt=""></p>
                                    <p class="book-title">마이달달달링</p>
                                    <p class="author">김솔</p>
                                </a>
                            </li>
                            <li>
                                <a href="#mode_nav">
                                    <p class="thumb"><img src="imgs/thumb/free_book4.png" alt=""></p>
                                    <p class="book-title">하데스</p>
                                    <p class="author">우유양</p>
                                </a>
                            </li>
                            <li>
                                <a href="#mode_nav">
                                    <p class="thumb"><img src="imgs/thumb/free_book5.png" alt=""></p>
                                    <p class="book-title">사랑을 디자인하다</p>
                                    <p class="author">낡은키보드</p>
                                </a>
                            </li>
                            <li>
                                <a href="#mode_nav">
                                    <p class="thumb"><img src="imgs/thumb/free_book6.png" alt=""></p>
                                    <p class="book-title">달콤 쌉싸래한 비밀</p>
                                    <p class="author">윤재하</p>
                                </a>
                            </li>
                            <li>
                                <a href="#mode_nav">
                                    <p class="thumb"><img src="imgs/thumb/free_book7.png" alt=""></p>
                                    <p class="book-title">구름섬으로 들어간 여인</p>
                                    <p class="author">최고의 잡초</p>
                                </a>
                            </li>
                            <li>
                                <a href="#mode_nav">
                                    <p class="thumb"><img src="imgs/thumb/free_book8.png" alt=""></p>
                                    <p class="book-title">설레어서</p>
                                    <p class="author">황한영</p>
                                </a>
                            </li>
                            <li>
                                <a href="#mode_nav">
                                    <p class="thumb"><img src="imgs/thumb/free_book9.png" alt=""></p>
                                    <p class="book-title">자꾸 생각나</p>
                                    <p class="author">세마즈in150</p>
                                </a>
                            </li>
                            <li>
                                <a href="#mode_nav">
                                    <p class="thumb"><img src="imgs/thumb/free_book10.png" alt=""></p>
                                    <p class="book-title">목련화</p>
                                    <p class="author">한하연</p>
                                </a>
                            </li>
                        </ol>
                        <a href="#mode_nav" class="latest-more-btn">더보기</a>
                    </section>
                    <!-- //무료연재베스트 -->

                    <!-- 새로등록된소설 -->
                    <section class="latest-wrap latest-wrap--new">
                        <h2 class="latest-title">새로 등록된 소설</h2>
                        <ul class="latest">
                            <li>
                                <a href="#mode_nav">
                                    <p class="thumb"><img src="imgs/thumb/new_book1.png" alt=""></p>
                                    <p class="book-title">봄 같은 여자,겨울 같은 남자</p>
                                    <p class="author">뿌낭</p>
                                </a>
                            </li>
                            <li>
                                <a href="#mode_nav">
                                    <p class="thumb"><img src="imgs/thumb/new_book2.png" alt=""></p>
                                    <p class="book-title">겨울 그리고 봄</p>
                                    <p class="author">버티고</p>
                                </a>
                            </li>
                            <li>
                                <a href="#mode_nav">
                                    <p class="thumb"><img src="imgs/thumb/new_book3.png" alt=""></p>
                                    <p class="book-title">혜지의 가족</p>
                                    <p class="author">서유진</p>
                                </a>
                            </li>
                            <li>
                                <a href="#mode_nav">
                                    <p class="thumb"><img src="imgs/thumb/new_book4.png" alt=""></p>
                                    <p class="book-title">당신의 자리</p>
                                    <p class="author">최수현</p>
                                </a>
                            </li>
                            <li>
                                <a href="#mode_nav">
                                    <p class="thumb"><img src="imgs/thumb/new_book5.png" alt=""></p>
                                    <p class="book-title">신혼만 원하는 여자</p>
                                    <p class="author">김애정</p>
                                </a>
                            </li>
                        </ul>
                        <a href="#mode_nav" class="latest-more-btn">더보기</a>
                    </section>
                    <!-- //새로등록된소설 -->
                </div>
                <!-- 독자추천 -->
                <section class="recommend recommend--main">
                    <h2 class="recommend-title">독자추천</h2>
                    <ul class="recommend-list">
                        <li>
                            <a href="#mode_nav">
                                <div class="thumb">
                                    <span><img src="imgs/thumb/recommend1.png" alt=""></span>
                                </div>
                                <div class="post">
                                    <strong class="title">오랜만에 만나본...</strong>
                                    <p class="post-content">이 글을 읽기 시작한게 새벽12시 쯤이었는데 벌써 해가 뜰 시간이네요.오랜만에 가슴에 확 와닿는
                                        소설이었습니다.</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#mode_nav">
                                <div class="thumb">
                                    <span><img src="imgs/thumb/recommend2.png" alt=""></span>
                                </div>
                                <div class="post">
                                    <strong class="title">동화의 재구성</strong>
                                    <p class="post-content">여러분 동화 좋아해요? 어릴 때 여러분들이 많이 읽어보셨을 밝고 맑고 따뜻한 동화들. 여기에 그 동화
                                        모티브로</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#mode_nav">
                                <div class="thumb">
                                    <span><img src="imgs/thumb/recommend3.png" alt=""></span>
                                </div>
                                <div class="post">
                                    <strong class="title">감탄을 자아냈습니다.</strong>
                                    <p class="post-content">본인은 안타깝게도 문학에는 그닥 조예가 없는 사람입니다. 읽은 책이라고는 라이트노벨과 같은 책이 전부고
                                        최근에
                                        들어서 '나는 고양</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#mode_nav">
                                <div class="thumb">
                                    <span><img src="imgs/thumb/recommend4.png" alt=""></span>
                                </div>
                                <div class="post">
                                    <strong class="title">템빨(?) 여주의 씩씩한 모험기</strong>
                                    <p class="post-content">첫 등장부터 사이다로 시작하는, 시원시원한 성격의 여주가 매력을 발산하고 있는 작품입니다. 결혼식 바로전날
                                        약혼자에게 배신</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#mode_nav">
                                <div class="thumb">
                                    <span><img src="imgs/thumb/recommend5.png" alt=""></span>
                                </div>
                                <div class="post">
                                    <strong class="title">작품리뷰</strong>
                                    <p class="post-content">안녕하세요. 작가님.작가님의 글인 `사랑도 통역이 되나요`를 구독하고 있는 독자입니다.줄거리를 요약하자면
                                        대한민국의
                                        서울 출신</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#mode_nav">
                                <div class="thumb">
                                    <span><img src="imgs/thumb/recommend6.png" alt=""></span>
                                </div>
                                <div class="post">
                                    <strong class="title">작품리뷰</strong>
                                    <p class="post-content">안녕하세요. 작가님.작가님의 글인 `사랑도 통역이 되나요`를 구독하고 있는 독자입니다.줄거리를 요약하자면
                                        대한민국의
                                        서울 출신</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <a href="#mode_nav" class="recommend-more-btn">더보기</a>
                </section>
                <!-- //독자추천 -->
            </div>
            <!-- //무료,새소설,독자추천 -->

            <!-- 회원님을위한추천 -->
            <section class="custom-latest-wrap">
                <h2 class="custom-latest-title"><span>Kimdal</span>님을 위한 추천</h2>
                <ul class="latest">
                    <li>
                        <a href="#mode_nav">
                            <p class="thumb"><img src="imgs/thumb/custom_book1.png" alt=""></p>
                            <p class="book-title">망의 연월</p>
                            <p class="author">림랑</p>
                        </a>
                    </li>
                    <li>
                        <a href="#mode_nav">
                            <p class="thumb"><img src="imgs/thumb/custom_book2.png" alt=""></p>
                            <p class="book-title">한설</p>
                            <p class="author">Milkymoon</p>
                        </a>
                    </li>
                    <li>
                        <a href="#mode_nav">
                            <p class="thumb"><img src="imgs/thumb/custom_book3.png" alt=""></p>
                            <p class="book-title">상사화의 계절</p>
                            <p class="author">류도하</p>
                        </a>
                    </li>
                    <li>
                        <a href="#mode_nav">
                            <p class="thumb"><img src="imgs/thumb/custom_book4.png" alt=""></p>
                            <p class="book-title">색시</p>
                            <p class="author">이미연</p>
                        </a>
                    </li>
                    <li>
                        <a href="#mode_nav">
                            <p class="thumb"><img src="imgs/thumb/custom_book5.png" alt=""></p>
                            <p class="book-title">류</p>
                            <p class="author">하현달</p>
                        </a>
                    </li>
                    <li>
                        <a href="#mode_nav">
                            <p class="thumb"><img src="imgs/thumb/custom_book6.png" alt=""></p>
                            <p class="book-title">홍연</p>
                            <p class="author">진해림</p>
                        </a>
                    </li>
                    <li>
                        <a href="#mode_nav">
                            <p class="thumb"><img src="imgs/thumb/custom_book7.png" alt=""></p>
                            <p class="book-title">쾌걸황후</p>
                            <p class="author">서향</p>
                        </a>
                    </li>
                    <li>
                        <a href="#mode_nav">
                            <p class="thumb"><img src="imgs/thumb/custom_book8.png" alt=""></p>
                            <p class="book-title">화홍</p>
                            <p class="author">이지환</p>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- //회원님을위한추천 -->
        </div>
        <!-- //메인소설 -->
    </div>
    <!-- //컨테이너 -->


@endsection