       <!-- LNB -->
            <div class="lnb">
                <nav>
                    <h2 class="lnb-title">My정보</h2>
                    <ul class="lnb-depth1">
                        <li>
                            <a href="{{route('my_page.index')}}" class="{{Request::is('my_info')?"is-active":""}}">마이페이지 홈</a>
                        </li>
                        <li>
                            <a href="{{route('my_page.favourites')}}" class="{{Request::is('my_info/favourites')?"is-active":""}}">선호작</a>
                            @if(Request::is('my_page/favourites'))
                            <ul class="lnb-depth2">
                                <li><a href="{{route('my_page.favourites')}}" class="{{Request::is('my_info/favourites')?"is-active":""}}">최근 업데이트</a></li>
                                <li><a href="#mode_nav">완결작품</a></li>
                                <li><a href="#mode_nav">비밀글 관리</a></li>
                            </ul>
                            @endif
                        </li>
                        <li>
                            <a href="">이용정보</a>
                        </li>
                        <li>
                            <a href="{{route('my_page.novels.new_novels')}}">소설</a>
                            @if(Request::is('my_page/novels/new_novels'))
                                <ul class="lnb-depth2">
                                    <li><a href="#mode_nav">소식</a></li>
                                    <li><a href="{{route('my_page.novels.new_novels')}}"  @if(Request::is('my_page/novels/new_novels'))class="is-active" @endif>신작알림</a></li>
                                </ul>
                                @endif
                        </li>
                        <li>
                            <a href="#mode_nav" class="{{Request::is('my_info/personal/*')?"is-active":""}}">개인</a>
                            <ul class="lnb-depth2">
                                <li><a href="#mode_nav">게시글 관리</a></li>
                                <li><a href="#mode_nav">일반 댓글 관리</a></li>
                                <li><a href="#mode_nav">소설 댓글 관리</a></li>
                                <li><a href="#mode_nav">추천 리뷰 관리</a></li>
                                <li><a href="#mode_nav">1:1 문의</a></li>
                                <li><a href="{{route('my_info.edit')}}" class="{{Request::is('my_info/personal/edit')?"is-active":""}}">정보변경</a></li>
                                <li><a href="#mode_nav">쪽지</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- //LNB -->
