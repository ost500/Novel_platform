 <!-- 셀렉트박스 -->
<div id="my_info_bar" class="{{ Request::is('m/my_info')?"padt30":"sel2_wrap" }}" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <select class="{{ Request::is('m/my_info/favorites')?"sel_198":"full" }}" id="myinfoSelect" v-on:change="callUrl()">
         <option value="마이페이지 홈" @if(Request::is('m/my_info')) selected @endif>마이페이지 홈</option>
         <option value="선호작" @if(Request::is('m/my_info/favorites')) selected @endif >선호작</option>
         <option value="이용정보" @if(Request::is('m/my_info/use_info/*')) selected @endif>이용정보</option>
         <option value="소설" @if(Request::is('m/novels/*')) selected @endif>소설</option>
         <option value="개인" @if(Request::is('m/my_info/personal/*')) selected @endif>개인</option>
     </select>

    @if(Request::is('m/my_info/favorites'))
    <select class="sel_346 marL8" id="myinfo_favorites"  v-on:change="callSubUrl()">
        <option value="최근 업데이트" @if($filter=='')selected @endif >최근 업데이트</option>
        <option value="완결작품"  @if($filter=='completed') selected @endif>완결작품</option>
        <option value="비밀글 관리" @if($filter=='secret') selected @endif >비밀글 관리</option>
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
                sub_optionValue: ''
            },
            methods: {
                callUrl: function () {

                    //Get the selected value
                    this.optionValue = $('#myinfoSelect').val();
                    //Based on values make a request
                    if (this.optionValue == '마이페이지 홈') {
                        location.assign('{{route('m.my_page.index')}}');
                    } else if (this.optionValue == '선호작') {
                        location.assign('{{route('m.my_page.favorites')}}');
                    } else if (this.optionValue == '이용정보') {

                        location.assign('{{route('m.my_info.charge_bead')}}');

                    } else if (this.optionValue == '소설') {
                        location.assign('{{route('m.my_page.novels.new_speed')}}');

                    } else if (this.optionValue == '개인') {
                        location.assign('{{route('m.my_info.post_manage')}}');

                    }
                },
                callSubUrl: function () {
                    //Get the selected value
                    this.subOptionValue = $('#myinfo_favorites').val();
                    //Based on values make a request
                    if (this.subOptionValue == '최근 업데이트') {
                        location.assign('{{route('m.my_page.favorites').'?filter='}}');
                    } else if (this.subOptionValue == '완결작품') {
                        location.assign('{{route('m.my_page.favorites').'?filter=completed'}}');
                    } else if (this.subOptionValue == '비밀글 관리') {
                        location.assign('{{route('m.my_page.favorites').'?filter=secret'}}');

                    }

                }


            }
        });
    </script>
    @endsection