<div id="share_form" class="share-modal" tabindex="0">
    <form name="share_form"  class="share-form">
        <fieldset class="wrap clr">
            <div id="social-links">
                <h2 class="share-title">Share With Social Media</h2>

                <div style="float:left;padding:3%">
                    <ul>
                        <li style="vertical-align:super"><a
                                    href="{{$share->facebook($url,$title,$thumbnail)}}"
                                    class="social-button " id="" >
                                <i class="fa fa-facebook-square fa-5x" aria-hidden="true"> </i>
                                <span style="vertical-align:super"> Facebook.</span>
                            </a>
                        </li>
                        <li><a href="{{$share->twitter($url,$title,$thumbnail)}}"
                               class="social-button " id="">
                                <i class="fa fa-twitter-square fa-5x" aria-hidden="true"> </i>
                                <span style="vertical-align:super"> Twitter.</span>
                            </a>
                        </li>
                        <li><a href="{{$share->googleplus($url,$title,$thumbnail)}}"
                               class="social-button " id="" >
                                <i class="fa fa-google-plus-square fa-5x" aria-hidden="true"> </i>
                                <span style="vertical-align:super"> Google+.</span>
                            </a>
                        </li>
                        <li><a href="{{$share->linkedin($url,$title,$thumbnail)}}"
                               class="social-button " id="" >
                                <i class="fa fa-linkedin-square fa-5x" aria-hidden="true"> </i>
                                <span> Linkedin.</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <div style="float:right;padding:3%;">
                    <ul>
                        <li><a href="{{$share->reddit($url,$title,$thumbnail)}}"
                               class="social-button " id="" >
                                <i class="fa fa-reddit-square fa-5x" aria-hidden="true"> </i>
                                <span style="font-size:12px;">Reddit.</span>
                            </a>
                        </li>
                        <li><a href="{{$share->pinterest($url,$title,$thumbnail)}}"
                               class="social-button " id="" >
                                <i class="fa fa-pinterest-square fa-5x" aria-hidden="true"> </i>
                                <span style="font-size:12px;">Pinterest.</span>
                            </a>
                        </li>
                        <li><a href="{{$share->delicious($url,$title,$thumbnail)}}"
                               class="social-button " id="" >
                                <i class="fa fa-delicious fa-5x" aria-hidden="true"> </i>
                                <span style="font-size:12px;">Delicious.</span>
                            </a>
                        </li>
                        <li><a href="{{$share->tumblr($url,$title,$thumbnail)}}"
                               class="social-button " id="" >
                                <i class="fa fa-tumblr-square fa-5x" aria-hidden="true"> </i>
                                <span style="">Tumblr.</span>
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

    $(document).on('click', '.social-button', function(e){
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
