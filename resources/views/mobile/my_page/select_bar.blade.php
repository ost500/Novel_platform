 <!-- 셀렉트박스 -->
<div class="padt30" xmlns:v-on="http://www.w3.org/1999/xhtml">
            <select class="full" id="myinfoSelect" v-on:change="callUrl()">
                <option value="마이페이지 홈" @if(Request::is('m/my_info')) selected @endif>마이페이지 홈</option>
                <option value="선호작" @if(Request::is('m/my_info/favorites')) selected @endif >선호작</option>
                <option value="이용정보" @if(Request::is('m/my_info/use_info/*')) selected @endif>이용정보</option>
                <option value="소설" @if(Request::is('m/novels/*')) selected @endif>소설</option>
                <option value="개인" @if(Request::is('m/my_info/personal/*')) selected @endif>개인</option>
            </select>
  </div>
        <!-- 셀렉트박스 //-->