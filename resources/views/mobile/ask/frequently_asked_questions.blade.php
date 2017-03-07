@extends('layouts.mobile_layout')
@section('content')
<!-- 내용 -->
<div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="cont_wrap" id="faqs">
       @include('mobile.ask.select_bar')

        <div class=""><h2 class="mlist_tit3"><span class="green">여우정원</span>을 처음 이용하시나요?</h2></div>
        <!-- 아이콘 5메뉴 -->
        <div class="sel2_wrap">
            <ul class="cs_topmn_box">
                <li><a href="{{route('m.ask.faqs').'?category=사이트 이용' }}" @if($category == '사이트 이용') class="cs_topmn site on" @else class="cs_topmn site off" @endif >사이트</a></li>
                <li><a href="{{route('m.ask.faqs').'?category=회원정보' }}" @if($category == '회원정보') class="cs_topmn userif on"  @else class="cs_topmn userif off" @endif>회원정보</a></li>
                <li><a href="{{route('m.ask.faqs').'?category=구매/결제' }}"  @if($category == '구매/결제') class="cs_topmn purchase on"  @else class="cs_topmn purchase off"  @endif>구매/결제</a></li>
                <li><a href="{{route('m.ask.faqs').'?category=작가/연재' }}" @if($category == '작가/연재') class="cs_topmn novelist on" @else class="cs_topmn novelist off"  @endif>작가/연재</a></li>
                <li><a href="{{route('m.ask.faqs').'?category=APP' }}" @if($category == 'APP') class="cs_topmn app on"  @else class="cs_topmn app off" @endif>APP</a></li>
            </ul>
        </div>
        <!-- 아이콘 5메뉴 //-->

        <!-- 검색 -->
        <div class="inp_wrap">
            <input type="text"  name="search" v-model="search" class="inputBacol2" v-on:keyup.enter="searchByTitle" placeholder="여우정원에 궁금한 것을 물어보세요!" style="width:85%;">
            <a v-on:click="searchByTitle" class="list_sch2" style="cursor:pointer;" >검색</a>
        </div>
        <!-- 검색 //-->

        <!-- 자주 묻는 질문 best -->
        <div>
            <div class="mlist_tit_rwap">
                <h3 class="mlist_tit4">@if($category) {{$category}} @elseif($search) {{$search}} Search
                    Results @else 자주 묻는 질문 Best @endif</h3>
            </div>
            <table class="tbl_dotline">
                <colgroup>
                    <col width="20%">
                    <col width="*">
                </colgroup>
                <tbody>
                @foreach($faqs as $faq)
                <tr>
                    <td class="talC borCont_bro">{{$faq->faq_category}}</td>
                    <td class="contxt">
                        <a href="{{route('ask.faq_detail',['id'=>$faq->id]).$query_string}}"> <div class="borCont">{{$faq->title}}</div></a>
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>

            <!-- 페이징 -->
            @include('pagination_mobile', ['collection' => $faqs, 'url' => route('m.ask.faqs').$query_string.'&'])
            <!-- 페이징 //-->
        </div>
        <!-- 자주 묻는 질문 best //-->
    </div>
</div>
<!-- 내용 //-->
<script type="text/javascript">
    var app = new Vue({
        el: '#faqs',
        data: {
            search: '',
            optionValue: ''
        },
        methods: {
            searchByTitle: function (e) {
                window.location.href = '{{route('m.ask.faqs').'?search='}}' + app.search;
            },
            callUrl: function () {

                //Get the selected value
                this.optionValue = $('#servicesSelect').val();
                console.log( this.optionValue);
                //Based on values make a request
                if (this.optionValue == '자주 묻는 질문') {
                    location.assign('{{route('m.ask.faqs')}}');
                } else if (this.optionValue == '1:1문의') {
                    location.assign('{{route('m.ask.ask_question')}}');
                } else if (this.optionValue == '공지사항') {
                    location.assign('{{route('m.ask.notifications')}}');

                }
            }

        }
    });
</script>
@endsection