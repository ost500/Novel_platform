       <!-- LNB -->
            <div class="lnb">
                <nav>
                    <h2 class="lnb-title">My정보</h2>
                    <ul class="lnb-depth1">
                        <li>
                            <a href="{{route('my_page.index')}}" class="{{Request::is('my_page')?"is-active":""}}">마이페이지 홈</a>
                        </li>
                        <li>
                            <a href="{{route('my_page.favorites')}}" class="{{Request::is('my_page/favorites')?"is-active":""}}">선호작</a>
                            @if(Request::is('my_page/favorites'))
                            <ul class="lnb-depth2">
                                <li><a href="{{route('my_page.favorites').'?filter='}}"  @if($filter=='') class="is-active" @endif>최근 업데이트</a></li>
                                <li><a href="{{route('my_page.favorites').'?filter=completed'}}" @if($filter=='completed') class="is-active" @endif>완결작품</a></li>
                                <li><a href="{{route('my_page.favorites').'?filter=secret'}}" @if($filter=='secret') class="is-active" @endif >비밀글 관리</a></li>
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
                            <a href="#mode_nav">개인</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- //LNB -->
