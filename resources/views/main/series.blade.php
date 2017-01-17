@extends('layouts.main_layout')
@section('content')
    <!-- 컨테이너 -->
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
            <div class="lnb">
                <nav>
                    <h2 class="lnb-title">연재</h2>
                    <ul class="lnb-depth1">
                        <li>
                            <a href="#mode_nav" class="is-active">유료소설</a>
                            <ul class="lnb-depth2">
                                <li><a href="#mode_nav" class="is-active">전체</a></li>
                                <li><a href="#mode_nav">현대로맨스</a></li>
                                <li><a href="#mode_nav">시대로맨스</a></li>
                                <li><a href="#mode_nav">로맨스판타지</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#mode_nav">무료소설</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 작품목록정렬 -->
                <div class="sort-nav sort-nav--novel">
                    <nav>
                        <ul>
                            <li><a href="#mode_nav" class="is-active">업데이트순</a></li>
                            <li><a href="#mode_nav">선호작순</a></li>
                            <li><a href="#mode_nav">조회순</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- //작품목록정렬 -->
                <!-- **작품목록정렬과 작품목록 사이에는 태그삽입 금지 -->
                <!-- 작품목록 -->
                <ul class="novel-list">
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/novel20.png" alt="망의 연월"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">망의 연월</a></strong>
                                <span class="writer">림랑</span>
                                <span class="datetime">1분 전</span>
                            </div>
                            <p class="post-content">음탕한 년. 신녀 주제에 날 사내로 여기고 있질 않느냐?<br>내가 질릴 때까지, 너는 못 죽는다.<br>“벗어라.”
                            </p>
                            <p class="post-info"><span>동양판타지</span> <span>총 128화</span> <span>조회수 287,413</span></p>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/novel19.png" alt="고백게임"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">고백게임</a></strong>
                                <span class="writer">이비안</span>
                                <span class="datetime">1분 전</span>
                            </div>
                            <p class="post-content">……그리고 눈을 뜨니 거긴 생전 처음보는 호텔방이었습니다.<br>(E-mail : ronabell@naver
                                .com)<br>현대물 / 로코 / 달달물</p>
                            <p class="post-info"><span>현대</span> <span>총 80화</span> <span>조회수 206,128</span></p>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/novel18.png" alt="낙원연가"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">낙원연가</a></strong>
                                <span class="writer">Girdap</span>
                                <span class="datetime">2분 전</span>
                            </div>
                            <p class="post-content">상처받은 사람들의 이야기</p>
                            <p class="post-info"><span>시대</span> <span>총 53화</span> <span>조회수 121,564</span></p>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/novel17.png" alt="공녀 엘린느"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">공녀 엘린느</a></strong>
                                <span class="writer">박초율</span>
                                <span class="datetime">2분 전</span>
                            </div>
                            <p class="post-content">[로판/회귀물/후회남주]<br>황태자의 약혼녀였던 엘린느 플로레르. 그러나 황제가 된 황태자 카일에 의해 공작가가 문을
                                닫고 자신<br>은 목숨을 잃고 만다.</p>
                            <p class="post-info"><span>로맨스판타지</span> <span>총 163화</span> <span>조회수 1,548,231</span></p>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/novel16.png" alt="초콜릿 객잔 702번지"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">초콜릿 객잔 702번지</a></strong>
                                <span class="writer">림랑</span>
                                <span class="datetime">2분 전</span>
                            </div>
                            <p class="post-content">현대물, 달달물, 까칠남주</p>
                            <p class="post-info"><span>현대</span> <span>총 68화</span> <span>조회수 157,169</span></p>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/novel15.png" alt="연애한도초과"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">연애한도초과</a></strong>
                                <span class="writer">김현서</span>
                                <span class="datetime">2분 전</span>
                            </div>
                            <p class="post-content">단 한 번의 접촉사고. 피해보상을 요구하는 남자.<br>“이름 알려주는데 10만, 나이 알려주는데 10만, 온종일 데이트
                                100만, 이제 남은 건 101만원인데.”<br>불안한 기분을 지울 수 없는 은채가 얼른 그의 손에 잡힌 제 손목을 빼내려 해봤지만 그러면 그럴수록 그의 입술
                            </p>
                            <p class="post-info"><span>현대</span> <span>총 44화</span> <span>조회수 98,311</span></p>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/novel14.png" alt="순수의 욕망"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">순수의 욕망</a></strong>
                                <span class="writer">럼</span>
                                <span class="datetime">3분 전</span>
                            </div>
                            <p class="post-content">스스로가 어른이라 착각하는 미성숙한 스물한 살 여대생의 성장로맨스.<br>남자랑 손이라도 잡아보고 싶다! 모태솔로,
                                철벽녀들을 위한 발칙한 지침서!<br>노아에게 다가오는 남자들을 차단하는 골칫덩어리 중증 시스터콤플렉스 세 오빠들.</p>
                            <p class="post-info"><span>현대</span> <span>총 87화</span> <span>조회수 421,298</span></p>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/novel13.png" alt="달꽃너울"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">달꽃너울</a></strong>
                                <span class="writer">Milkymoon</span>
                                <span class="datetime">3분 전</span>
                            </div>
                            <p class="post-content">“소녀는 그저 나리의 뒷모습만이라도 좋은 것을요.”<br>짝사랑 여주, 무심한 남주, 사극로맨스<br>달이라 불러주세요~
                            </p>
                            <p class="post-info"><span>시대</span> <span>총 36화</span> <span>조회수 89,092</span></p>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/novel12.png" alt="울지마 유령"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">울지마 유령</a></strong>
                                <span class="writer">림랑</span>
                                <span class="datetime">3분 전</span>
                            </div>
                            <p class="post-content">사람도 유령도 아닌 놈과 얽혀 버렸다!<br>로맨틱코미디, 현대판타지물, 퇴마, 지랄남, 사차원녀, 초월적, 귀염, 깜찍
                            </p>
                            <p class="post-info"><span>현대</span> <span>총 56화</span> <span>조회수 139,398</span></p>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/novel11.png" alt="한설"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">한설</a></strong>
                                <span class="writer">Milkymoon</span>
                                <span class="datetime">3분 전</span>
                            </div>
                            <p class="post-content">“은애한다 하였다. 네 입으로, 나를 연모한다 하지 않았느냐!”<br>“이미 버렸습니다.”<br>시대물, 황제남주, 남주
                                후회물</p>
                            <p class="post-info"><span>시대</span> <span>총 93화</span> <span>조회수 345,132</span></p>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/novel10.png" alt="늑대의 주인"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">늑대의 주인</a></strong>
                                <span class="writer">이에르바</span>
                                <span class="datetime">3분 전</span>
                            </div>
                            <p class="post-content">“개새끼. 천하의 둘도 없는 개새끼야, 넌.”<br>이내 그녀의 입술이 막을 새도 없이 그의 입술을 덮쳤다. 눈을 질끈
                                감은 그녀는 억센 힘으로 그의 멱살을 잡고 놓아주지 않았다.</p>
                            <p class="post-info"><span>현대</span> <span>총 31화</span> <span>조회수 79,060</span></p>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/novel9.png" alt="수상한 후견인"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">수상한 후견인</a></strong>
                                <span class="writer">좋을텐데</span>
                                <span class="datetime">4분 전</span>
                            </div>
                            <p class="post-content">가족에게 버림받고 수상한 남자아이를 만났다. 그러나 7년이 지난 지금도 남자아이는 첫 만남 그대로의 모습을 간직했다.
                                세상의 앞날을 모두 아는듯한 말투와 종잡을 수 없는 행동까지. 마음이나 생각을 파악하는 것 자체가 무리수였고 가끔은 무서울 정도로 차갑고 냉정했다. 그런데
                                남자아이는 어느 날 부쩍 성한 모습으로 나타나 내 </p>
                            <p class="post-info"><span>로맨스판타지</span> <span>총 289화</span> <span>조회수 1,135,506</span></p>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/novel8.png" alt="쥐구멍 볕 들 날"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">쥐구멍 볕 들 날</a></strong>
                                <span class="writer">레몬비</span>
                                <span class="datetime">4분 전</span>
                            </div>
                            <p class="post-content">아버지 도박 빚 1억을 갚지 못해 팔려갈 위기에 처한 여자.<br>사랑하는 애인과 절친에게 동시에 배신당하고 실의에 빠진
                                남자.<br>달리 길이 없어서, 혹은 충동적으로 자살을 결심한 두 남녀가 마포대교 위에서 마주친다.</p>
                            <p class="post-info"><span>로맨스판타지</span> <span>총 77화</span> <span>조회수 167,511</span></p>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/novel7.png" alt="Cross The Line"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">Cross The Line</a></strong>
                                <span class="writer">추홍예</span>
                                <span class="datetime">4분 전</span>
                            </div>
                            <p class="post-content">환생 판타지 로맨스입니다.<br>왕세자 앞에 여자 아이를 지키듯이 가로막고 서 있는 남자들 모두 블레스타크 가문
                                소속이었다.<br>디아나의 아버지인 현 블레스타크 공작과 그의 아우이자 로열 위저드리를 이끄는 마스터 마법사 넥슨.</p>
                            <p class="post-info"><span>로맨스판타지</span> <span>총 310화</span> <span>조회수 1,989,752</span></p>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/novel6.png" alt="왕세자비 오디션"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">왕세자비 오디션</a></strong>
                                <span class="writer">리모란</span>
                                <span class="datetime">4분 전</span>
                            </div>
                            <p class="post-content">여장한 왕세자를 왕세자비 선발대회에서 우승시켜야 한다.<br>성격도 인생도 진심도 배배꼬인 여장남주 왕세자 전하와
                                스크류바같은 남주를 탈탈 털어 예쁘게 다림질할 예정인 멘탈갑 여주가 살아남으려는 와중에 연애도 하는...것 같은 궁정 서바이벌 로맨스판타지.</p>
                            <p class="post-info"><span>로맨스판타지</span> <span>총 121화</span> <span>조회수 911,250</span></p>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/novel5.png" alt="그녀가 공주로 사는 법"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">그녀가 공주로 사는 법</a></strong>
                                <span class="writer">도하나</span>
                                <span class="datetime">4분 전</span>
                            </div>
                            <p class="post-content">여자가 좋다며 주인공과의 혼담을 찬 공주에게 빙의했다.<br>나는 남자가 좋으니 주인공과의 로맨스를 꿈꿔 보겠다? 저언혀.<br>조연답게
                                조용히 지내다 소설의 결말만 보고 가는 게 내 목표다.</p>
                            <p class="post-info"><span>로맨스판타지</span> <span>총 103화</span> <span>조회수 687,365</span></p>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/novel4.png" alt="흑룡연인"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">흑룡연인</a></strong>
                                <span class="writer">서홍</span>
                                <span class="datetime">4분 전</span>
                            </div>
                            <p class="post-content">조직물, 할리퀸, 재벌, 소유욕, 집착. <br>중국 최고의 삼합회 조직 ‘흑룡 가(家)’삼 남매와 그의 연인들의 이야기.<br>본격,
                                홍콩! 아니 상하이 가는 글!</p>
                            <p class="post-info"><span>현대</span> <span>총 58화</span> <span>조회수 132,003</span></p>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/novel3.png" alt="양손의 꽃다발"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">양손의 꽃다발</a></strong>
                                <span class="writer">희화가</span>
                                <span class="datetime">5분 전</span>
                            </div>
                            <p class="post-content">“아르디님.”<br>차분한 보라색눈이 한치의 거짓도 없이 날 금방이라도 물 것 같다. 설마 키워준 은혜도 모르고, 이성을
                                버린 채 짐승이 되려는 건 아닌가 의심해봐야 한다. 숨겨왔던 날카로운 송곳니가 찢어져 살결이 보이는 내 몸을 향해</p>
                            <p class="post-info"><span>로맨스판타지</span> <span>총 165화</span> <span>조회수 1,980,048</span></p>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/novel2.png" alt="금수의 꽃"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">금수의 꽃</a></strong>
                                <span class="writer">로즈라인R</span>
                                <span class="datetime">5분 전</span>
                            </div>
                            <p class="post-content">[로판/뱀파이어/남장여자] 너의 향기에 취한다</p>
                            <p class="post-info"><span>로맨스판타지</span> <span>총 126화</span> <span>조회수 1,000,123</span></p>
                        </div>
                    </li>
                    <li>
                        <div class="thumb">
                            <span><a href="#mode_nav"><img src="imgs/thumb/novel1.png" alt="꽃에 미치다"></a></span>
                        </div>
                        <div class="post">
                            <div class="post-header">
                                <strong class="title"><a href="#mode_nav">꽃에 미치다</a></strong>
                                <span class="writer">선움</span>
                                <span class="datetime">5분 전</span>
                            </div>
                            <p class="post-content">[악녀여주를 탈탈턴다/엑스트라빙의/케미터짐/우정물/능글능글남주/츤데레남주/사이다후추후추/개그후추후추] 못 볼 것을 보게 된
                                도로시는 눈을 살포시 감고는 읊조렸다.<br>“눈이 썩었어요.”</p>
                            <p class="post-info"><span>로맨스판타지</span> <span>총 188화</span> <span>조회수 2,121,988</span></p>
                        </div>
                    </li>
                </ul>
                <!-- //작품목록 -->
                <!-- 페이징 -->
                <div class="page-nav">
                    <nav>
                        <ul>
                            <!--<li><a href="#mode_nav" class="prev-page"><span>이전</span></a></li>-->
                            <li><a href="#mode_nav" class="current-page">1</a></li>
                            <li><a href="#mode_nav">2</a></li>
                            <li><a href="#mode_nav">3</a></li>
                            <li><a href="#mode_nav">4</a></li>
                            <li><a href="#mode_nav">5</a></li>
                            <li><a href="#mode_nav" class="next-page"><span>다음</span></a></li>
                        </ul>
                    </nav>
                </div>
                <!-- //페이징 -->
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