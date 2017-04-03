    <!-- side menu open -->
<div class="popup_bg" id="socialbar" style="display:none;">
    <div class="sidemn_in">
        <!-- 로그인 및 사용자 정보 -->
        <div class="side_login">
            <h3 class="blindtext">사용자 정보</h3>

                <div class="user_name">SNS 공유하기</div>
                <!--<div class="user_name">로그인이 필요합니다.</div>-->

                <!-- close 버튼 -->
                <a href="" class="sidemn_close"><span class="ico_close">닫기</span></a>
                <!-- close 버튼 //-->
        </div>
        <!-- 로그인 및 사용자 정보 //-->
        <!-- 아이콘 메뉴 -->
        <div class="icon_mn_wrap">
            <ul class="icon_mn">
                <li>
                    <a href="{{$share->facebook($url,$title,$thumbnail)}}" class="icon_mn_a" id="social_button">
                        <div  class="iconut" style="padding: 36px;">
                            <i class="fa fa-facebook-square fa-3x" aria-hidden="true"> </i>
                            <span class="iconut_txt">페이스북</span>
                        </div>
                            <!--<em class="count_n colred">3</em>-->

                    </a>
                </li>
                <li>
                    <a href="{{$share->twitter($url,$title,$thumbnail)}}" class="icon_mn_a" id="social_button">
                        <div  class="iconut" style="padding: 36px;">
                            <i class="fa fa-twitter-square fa-3x" aria-hidden="true"> </i>
                            <span class="iconut_txt">트위터</span>
                            <!--<em class="count_n colyel">6</em>-->
                        </div>
                    </a>
                </li>
                <li>
                    <a class="icon_mn_a" onclick="shareStory()" id="social_button">
                        <div class="iconut"   style="padding: 40px 13px 0 18px;">
                         <img  src="/mobile/images/kakao_black.jpg" style=" width:50%;"><br/>
                            <span class="iconut_txt">카카오스토리</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <!-- 아이콘 메뉴 //-->

        <!-- 아이콘 메뉴 //-->
    </div>
</div>
<!-- side menu open //-->
<script>

    var popupSize = {
        width: 780,
        height: 550
    };

    $(document).on('click', '#social_button', function(e){
        var
                verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
                horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);

        var popup = window.open($(this).prop('href'), 'social',
                'width='+popupSize.width+',height='+popupSize.height+
                ',left='+verticalPos+',top='+horisontalPos+
                ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

        if (popup) {
            popup.focus();
            e.preventDefault();
        }

    });

</script>

<script src="http://developers.kakao.com/sdk/js/kakao.min.js"></script>

<script type='text/javascript'>
    //<![CDATA[
    // 사용할 앱의 JavaScript 키를 설정해 주세요.
    Kakao.init('d2925f47245105755b4b82b13b5a6d43');
    function shareStory() {
        Kakao.Story.share({
            url: '{{$url}}',
            text: '{{$title}}'
        });
    }
    //]]>
</script>