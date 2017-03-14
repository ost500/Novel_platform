 <!-- 셀렉트박스 -->
<div id="my_info_bar" class="{{ Request::is('my_info')?"padt30":"sel2_wrap" }}" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <select class="{{ Request::is('my_info/favorites')  || Request::is('my_info/personal/*') || Request::is('my_info/use_info/*') || Request::is('my_info/novels/*') || Request::is('mails/*') ?"sel_198":"full" }}" id="myinfoSelect" v-on:change="callUrl()">
         <option value="마이페이지 홈" @if(Request::is('my_info')) selected @endif>마이페이지 홈</option>
         <option value="선호작" @if(Request::is('my_info/favorites')) selected @endif >선호작</option>
         <option value="이용정보" @if(Request::is('my_info/use_info/*')) selected @endif>이용정보</option>
         <option value="소설" @if(Request::is('novels/*')) selected @endif>소설</option>
         <option value="개인" @if(Request::is('my_info/personal/*') || Request::is('mails/*')) selected @endif>개인</option>
     </select>

    @if(Request::is('my_info/favorites'))
    <select class="sel_346 marL8" id="myinfo_favorites"  v-on:change="callSubUrl()">
        <option value="최근 업데이트" @if($filter=='')selected @endif >최근 업데이트</option>
        <option value="완결작품"  @if($filter=='completed') selected @endif>완결작품</option>
        <option value="비밀글 관리" @if($filter=='secret') selected @endif >비밀글 관리</option>
    </select>
    @endif

  @if(Request::is('my_info/use_info/*'))
  <select class="sel_346 marL8" id="myinfo_favorites"  v-on:change="callSubUrl()">
      <option value="구슬충전"  @if(Request::is('my_info/use_info/charge_bead')) selected @endif>구슬충전</option>
      <option value="결제내역"  @if(Request::is('my_info/use_info/charge_list')) selected @endif>결제내역</option>
      <option value="조각관리"  @if(Request::is('my_info/use_info/manage_piece')) selected @endif>조각관리</option>
      <option value="소설 구매 내역"  @if(Request::is('my_info/use_info/purchased_novel_list')) selected @endif>소설 구매 내역</option>
      <option value="받은 선물 내역"  @if(Request::is('my_info/use_info/received_gift')) selected @endif>받은 선물 내역</option>
      <option value="보낸 선물 내역"  @if(Request::is('my_info/use_info/sent_gift')) selected @endif>보낸 선물 내역</option>
  </select>
  @endif


  @if(Request::is('my_info/novels/*'))
  <select class="sel_346 marL8" id="myinfo_favorites"  v-on:change="callSubUrl()">
      <option value="소식"  @if(Request::is('my_info/novels/new_speed')) selected @endif>소식</option>
      <option value="신작알림"  @if(Request::is('my_info/novels/new_novels')) selected @endif>신작알림</option>
  </select>
  @endif

  @if(Request::is('my_info/personal/*') || Request::is('mails/*'))
     <select class="sel_346 marL8" id="myinfo_favorites"  v-on:change="callSubUrl()">
        <option value="게시글 관리"  @if(Request::is('my_info/personal/post_manage')) selected @endif>게시글 관리</option>
        <option value="추천 리뷰 관리" @if(Request::is('my_info/personal/review_manage')) selected @endif>추천 리뷰 관리</option>
        <option value="소설 댓글 관리" @if(Request::is('my_info/personal/novel_comments_manage')) selected @endif>소설 댓글 관리</option>
        <option value="일반 댓글 관리" @if(Request::is('my_info/personal/free_board_review_comments_manage')) selected @endif>일반 댓글 관리</option>
        <option value="정보변경"  @if(Request::is('my_info/personal/edit') || Request::is('my_info/personal/password_again') || Request::is('my_info/personal/member_leave/*')) selected @endif>정보변경</option>
        <option value="쪽지"  @if(Request::is('mails/*')) selected @endif>쪽지</option>
      </select>
  @endif
   @if(Request::is('mails/*'))
  <select class="full" id="myinfo_mails"  v-on:change="callSubUrlMail()" style="margin-top:10px;">
      <option value="받은쪽지함"  @if(Request::is('mails/received')) selected @endif>받은쪽지함</option>
      <option value="보낸쪽지함"  @if(Request::is('mails/sent')) selected @endif>보낸쪽지함</option>
      <option value="보관쪽지함"  @if(Request::is('mails/my_box')) selected @endif>보관쪽지함</option>
      <option value="스팸쪽지함"  @if(Request::is('mails/spam')) selected @endif>스팸쪽지함</option>
      <option value="쪽지보내기"  @if(Request::is('mails/create') || Request::is('mails/create/*')) selected @endif>쪽지보내기</option>
  </select>
  @endif
</div>

<!-- 셀렉트박스 //-->
@section('footer')
    <script type="text/javascript">
        var my_info_bar = new Vue({
            el: '#my_info_bar',
            data: {
                optionValue: '',
                sub_optionValue: '',
                subOptionMail:''
            },
            methods: {
                callUrl: function () {

                    //Get the selected value
                    this.optionValue = $('#myinfoSelect').val();

                    //Based on values make a request
                    if (this.optionValue == '마이페이지 홈') {
                        location.assign('{{route('my_page.index')}}');
                    } else if (this.optionValue == '선호작') {
                        location.assign('{{route('my_page.favorites')}}');
                    } else if (this.optionValue == '이용정보') {

                        location.assign('{{route('my_info.charge_bead')}}');

                    } else if (this.optionValue == '소설') {
                        location.assign('{{route('my_page.novels.new_speed')}}');

                    } else if (this.optionValue == '개인') {
                        location.assign('{{route('my_info.post_manage')}}');

                    }
                },
                callSubUrl: function () {
                    //Get the selected value
                    this.subOptionValue = $('#myinfo_favorites').val();

                    //Based on values make a request
                    if (this.subOptionValue == '최근 업데이트') {
                        location.assign('{{route('my_page.favorites').'?filter='}}');
                    } else if (this.subOptionValue == '완결작품') {
                        location.assign('{{route('my_page.favorites').'?filter=completed'}}');
                    } else if (this.subOptionValue == '비밀글 관리') {
                        location.assign('{{route('my_page.favorites').'?filter=secret'}}');


                    } else if (this.subOptionValue == '구슬충전') {
                        location.assign('{{route('my_info.charge_bead')}}');
                    } else if (this.subOptionValue == '결제내역') {
                        location.assign('{{route('my_info.charge_list')}}');
                    } else if (this.subOptionValue == '조각관리') {
                        location.assign('{{route('my_info.manage_piece')}}');
                    } else if (this.subOptionValue == '소설 구매 내역') {
                        location.assign('{{route('my_info.purchased_novel_list')}}');
                    } else if (this.subOptionValue == '받은 선물 내역') {
                        location.assign('{{route('my_info.received_gift')}}');
                    }else if (this.subOptionValue == '보낸 선물 내역') {
                        location.assign('{{route('my_info.sent_gift')}}');


                    }else if (this.subOptionValue == '소식') {
                        location.assign('{{route('my_page.novels.new_speed')}}');
                    } else if (this.subOptionValue == '신작알림') {
                        location.assign('{{route('my_page.novels.new_novels')}}');


                    }else if (this.subOptionValue == '게시글 관리') {
                        location.assign('{{route('my_info.post_manage')}}');
                    }else if (this.subOptionValue == '추천 리뷰 관리') {
                        location.assign('{{route('my_info.review_manage')}}');
                    }else if (this.subOptionValue == '소설 댓글 관리') {
                        location.assign('{{route('my_info.novel_comments_manage')}}');
                    }else if (this.subOptionValue == '일반 댓글 관리') {
                        location.assign('{{route('my_info.free_board_review_comments_manage')}}');
                    }else if (this.subOptionValue == '정보변경') {
                        location.assign('{{route('my_info.password_again')}}');
                    }else if (this.subOptionValue == '쪽지') {
                        location.assign('{{route('mails.received')}}');
                    }


                },
                  callSubUrlMail: function () {

                   //Get the selected value
                    this.subOptionMail = $('#myinfo_mails').val();

                    //Based on values make a request
                     if (this.subOptionMail == '받은쪽지함') {
                        location.assign('{{route('mails.received')}}');
                    }else if (this.subOptionMail == '보낸쪽지함') {
                        location.assign('{{route('mails.sent')}}');
                    }else if (this.subOptionMail == '보관쪽지함') {
                        location.assign('{{route('mails.my_box')}}');
                    }else if (this.subOptionMail == '스팸쪽지함') {
                        location.assign('{{route('mails.spam')}}');
                    }else if (this.subOptionMail == '쪽지보내기') {
                        location.assign('{{route('mails.create')}}');
                    }

               }




            }
        });
    </script>
    @endsection