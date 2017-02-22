<!-- LNB -->
<div class="lnb">
    <nav>
        <h2 class="lnb-title">커뮤니티</h2>
        <ul class="lnb-depth1">
            <li>
                <a href="{{route('free_board')}}"
                   @if(Request::is('community/freeboard/*')||Request::is('community/freeboard')||Request::is('community/freeboard_write'))class="is-active"@endif>자유게시판</a>
            </li>
            <li>
                <a href="{{route('reader_reco')}}"
                   @if(Request::is('novel_group/review/*')||Request::is('novel_group/review/')||Request::is('community/reader_reco/*'))class="is-active"@endif>독자추천</a>
            </li>
        </ul>
    </nav>
</div>
<!-- //LNB -->