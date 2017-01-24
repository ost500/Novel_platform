       <!-- LNB -->
            <div class="lnb">
                <nav>
                    <h2 class="lnb-title">My정보</h2>
                    <ul class="lnb-depth1">
                        <li>
                            <a href="{{route('my_page.index')}}" class="{{Request::is('my_page')?"is-active":""}}">마이페이지 홈</a>
                        </li>
                        <li>
                            <a href="{{route('my_page.favourites')}}" class="{{Request::is('my_page/favourites')?"is-active":""}}">선호작</a>
                            @if(Request::is('my_page/favourites'))
                            <ul class="lnb-depth2">
                                <li><a href="{{route('my_page.favourites')}}" class="{{Request::is('my_page/favourites')?"is-active":""}}">최근 업데이트</a></li>
                                <li><a href="#mode_nav">완결작품</a></li>
                                <li><a href="#mode_nav">비밀글 관리</a></li>
                            </ul>
                            @endif
                        </li>
                        <li>
                            <a href="#mode_nav">이용정보</a>
                        </li>
                        <li>
                            <a href="#mode_nav">소설</a>
                        </li>
                        <li>
                            <a href="#mode_nav">개인</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- //LNB -->
