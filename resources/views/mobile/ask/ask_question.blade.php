@extends('layouts.mobile_layout')

@section('content')


        <!-- 내용 -->
<div class="container">
    <div class="cont_wrap" id="ask_question">
        @include('mobile.ask.select_bar')

        @if(Session::has('flash_message'))
            {{-- important, success, warning, danger and info --}}
            <div class="alert alert-success">
                {{Session('flash_message')}}
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
                    <!-- 안내문구 박스 -->
            <div class="alert_box">문의는 최대한 빠르게 답변드리고 있으나, 주말, 공휴일 문의는 답변이 지연될 수 있는 점 양해 부탁드립니다.</div>
            <!-- 안내문구 박스 //-->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">

                {{--    <div class="links">
                        <a href="{{route('m.ask.ask_question')}}">문의하기</a>
                        <a href="{{route('m.ask.questions')}}" class="marL8 green">문의내역</a>
                    </div>--}}
                <div class="mlist_tit_rwap2">
                    <h2 class="mlist_tit4">문의유형<a href="{{route('m.ask.questions')}}" class="mlist_tit_btn go">문의내역</a>
                    </h2>
                </div>

                <!-- 문의유형 체크 -->
                <form name="ask_queston" id="ask_queston" action="{{route('mentomen.store')}}" method="post"
                      enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="dot_top">

                        <ul class="check_list">
                            <li><label class="checkbox-wrap"><input type="checkbox" name="category" value="사이트이용"
                                                                    class="chb"><i
                                            class="check-icon"></i><span class="marL8 ">사이트이용</span></label></li>
                            <li><label class="checkbox-wrap"><input type="checkbox" name="category" value="회원정보"
                                                                    class="chb"><i
                                            class="check-icon"></i><span class="marL8">회원정보</span></label></li>
                            <li><label class="checkbox-wrap"><input type="checkbox" name="category" value="구매/결제"
                                                                    class="chb"><i
                                            class="check-icon"></i><span class="marL8">구매/결재</span></label></li>
                            <li><label class="checkbox-wrap"><input type="checkbox" name="category" value="기타"
                                                                    class="chb"><i
                                            class="check-icon"></i><span class="marL8">기타</span></label></li>
                            <li><label class="checkbox-wrap"><input type="checkbox" name="category" value="작가/연재"
                                                                    class="chb"><i
                                            class="check-icon"></i><span class="marL8">작가/연재</span></label></li>
                            <li><label class="checkbox-wrap"><input type="checkbox" name="category" value="APP"
                                                                    class="chb"><i
                                            class="check-icon"></i><span class="marL8">APP</span></label></li>
                            <li><label class="checkbox-wrap"><input type="checkbox" name="category" value="건의사항"
                                                                    class="chb"><i
                                            class="check-icon"></i><span class="marL8">건의사항</span></label></li>
                        </ul>
                    </div>
                    <!-- 문의유형 체크 //-->

                    <!-- 문의내용 입력 -->

                    <fieldset style="margin-top:10%;">
                        <legend class="screen_out">문의 내용 등록</legend>
                        <!-- 제목입력 -->
                        <input type="text" name="title" id="title" class="inputBasic full" placeholder="제목을 입력해주세요.">
                        <!-- 내용입력 -->
                    <textarea class="repl_txtar mart15" rows="3" cols="30" name="question"
                              id="question" placeholder="내용을 입력해주세요."></textarea>

                        <div class="padtb20">
                            <a href="" class="file_att">첨부파일</a>
                            <span class="file_path">파일이 없습니다.</span>
                        </div>
                        <div class="otherinf">JPG, GIF, PNG 파일 형식의 이미지를 최대 3장까지 첨부할 수 있습니다.(5MB 이하)</div>

                        <div class="padtb20">
                            <input type="hidden" name="ask_question" id="ask_question" value="1">
                            <button type="submit" class="btn_green full">등록</button>
                        </div>
                    </fieldset>
                </form>

                <!-- 문의내용 입력 //-->
            </div>
    </div>
    <!-- 내용 //-->
</div>
<script type="text/javascript">
    var app = new Vue({
        el: '#ask_question',
        data: {
            optionValue: ''
        },
        methods: {
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
    $(".chb").change(function () {
        $(".chb").prop('checked', false);
        $(this).prop('checked', true);

    });
</script>
@endsection