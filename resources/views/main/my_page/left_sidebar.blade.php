<!-- LNB -->
<div class="lnb">
    <nav>
        <h2 class="lnb-title">My정보</h2>
        <ul class="lnb-depth1">
            <li>
                <a href="{{route('my_page.index')}}" class="{{Request::is('my_info')?"is-active":""}}">마이페이지 홈</a>
            </li>
            <li>
                <a href="{{route('my_page.favorites')}}"
                   class="{{Request::is('my_info/favorites')?"is-active":""}}">선호작</a>
                @if(Request::is('my_info/favorites'))
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
                @if(Request::is('my_info/novels/new_novels'))
                    <ul class="lnb-depth2">
                        <li><a href="#mode_nav">소식</a></li>
                        <li><a href="{{route('my_page.novels.new_novels')}}"
                               @if(Request::is('my_info/novels/new_novels'))class="is-active" @endif>신작알림</a></li>
                    </ul>
                @endif
            </li>
            <li>
                <a href="{{ route('my_info.post_manage') }}" class="{{Request::is('my_info/personal/*')?"is-active":""}}">개인</a>
                @if(Request::is('my_info/personal/*'))
                    <ul class="lnb-depth2">
                        <li><a class="{{Request::is('my_info/personal/post_manage')?"is-active":""}}" href="{{ route('my_info.post_manage') }}">게시글 관리</a></li>
                        <li><a class="{{Request::is('my_info/personal/review_manage')?"is-active":""}}" href="{{ route('my_info.review_manage') }}">추천 리뷰 관리</a></li>
                        <li><a class="{{Request::is('my_info/personal/novel_comments_manage')?"is-active":""}}" href="{{ route('my_info.novel_comments_manage') }}">소설 댓글 관리</a></li>
                        <li><a  class="{{Request::is('my_info/personal/free_board_review_comments_manage')?"is-active":""}}" href="{{ route('my_info.free_board_review_comments_manage') }}">일반 댓글 관리</a></li>
                        <li><a href="#mode_nav">1:1 문의</a></li>
                        <li><a href="{{route('my_info.password_again')}}"
                               class="{{Request::is('my_info/personal/edit') || Request::is('my_info/personal/password_again')?"is-active":""}}">정보변경</a></li>
                        <li><a href="#mode_nav">쪽지</a></li>
                    </ul>
                @endif
            </li>
        </ul>
    </nav>
</div>
<!-- //LNB -->
