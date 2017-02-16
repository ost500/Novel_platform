
<div id="share_form" class="share-modal" tabindex="0">
    <form name="share_form"  class="share-form">
        <fieldset class="wrap clr">
            <div id="social-links">
                <h2 class="share-title">SNS 공유하기</h2>

                <div style="padding:3%">
                    <ul>
                        <li style="vertical-align:super"><a
                                    href="{{$share->facebook($url,$title,$thumbnail)}}"
                                    class="social-button " id="social-button" >
                                <i class="fa fa-facebook-square fa-5x" aria-hidden="true"> </i>
                                <span style="vertical-align:super"> 페이스북</span>
                            </a>
                        </li>



                    </ul>
                </div>
                <div style="padding:3%;">
                    <ul>

                        <li><a href="{{$share->twitter($url,$title,$thumbnail)}}"
                               class="social-button " id="social-button">
                                <i class="fa fa-twitter-square fa-5x" aria-hidden="true"> </i>
                                <span style="vertical-align:super"> 트위터</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <div style="padding:3%;">
                    <ul>

                        <li><a href="#" onclick="shareStory()"
                               class="social-button ">
                                <img class="kakaostory-img" >
                                <span style="">카카오스토리</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </fieldset>
    </form>
</div>
<script>

    var popupSize = {
        width: 780,
        height: 550
    };

    $(document).on('click', '#social-button', function(e){
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