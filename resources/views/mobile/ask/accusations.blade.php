@extends('layouts.mobile_layout')

@section('content')


        <!-- 내용 -->
<div class="container">
    <div class="cont_wrap" id="accusations">
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
            <div class="label" style="margin-bottom: 10px;">안내</div>
            <div class="alert_box">관리자 검토 후 해당 사용자의 댓글 금지, 게시 금지, 로그인 금지 등과 같은 조치를 취하게.</div>
            <!-- 안내문구 박스 //-->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <div class="mlist_tit_rwap2">
                    <h2 class="mlist_tit4">신고유형</h2>
                </div>

                <!-- 문의유형 체크 -->
                <form name="accusationsForm" id="accusationsForm" action="{{route('m.accusations.post')}}" method="post"
                      enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input hidden name="accu_id" value="{{$accu_id}}">
                    <input hidden name="link" value="{{$link}}">
                    <div class="dot_top">

                        <ul class="check_list">
                            <li><label class="checkbox-wrap"><input type="checkbox" name="category" value="광고"
                                                                    class="chb" checked><i
                                            class="check-icon"></i><span class="marL8 ">광고</span></label></li>
                            <li><label class="checkbox-wrap"><input type="checkbox" name="category" value="개인정보 침해"
                                                                    class="chb"><i
                                            class="check-icon"></i><span class="marL8">개인정보 침해</span></label></li>
                            <li><label class="checkbox-wrap"><input type="checkbox" name="category" value="사이버 저작권 침해"
                                                                    class="chb"><i
                                            class="check-icon"></i><span class="marL8">사이버 저작권 침해</span></label></li>
                            <li><label class="checkbox-wrap"><input type="checkbox" name="category" value="음란물"
                                                                    class="chb"><i
                                            class="check-icon"></i><span class="marL8">음란물</span></label></li>
                            <li><label class="checkbox-wrap"><input type="checkbox" name="category" value="명예훼손 및 모욕"
                                                                    class="chb"><i
                                            class="check-icon"></i><span class="marL8">명예훼손 및 모욕</span></label></li>
                            <li><label class="checkbox-wrap"><input type="checkbox" name="category" value="기타"
                                                                    class="chb"><i
                                            class="check-icon"></i><span class="marL8">기타</span></label></li>

                        </ul>
                    </div>
                    <!-- 문의유형 체크 //-->

                    <!-- 문의내용 입력 -->

                    <fieldset style="margin-top:10%;">
                        <legend class="screen_out">문의 내용 등록</legend>
                        <!-- 제목입력 -->
                        <input type="text" name="title" id="title" class="inputBasic full" placeholder="제목을 입력해주세요.">
                        <!-- 내용입력 -->
                        <textarea class="repl_txtar mart15" rows="3" cols="30" name="contents"
                              id="contents" placeholder="내용을 입력해주세요."></textarea>


                        <div class="padtb20">
                            <input type="hidden" name="ask_question" id="ask_question" value="1">
                            <button type="submit" class="btn_green full">신고하기</button>
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
        el: '#accusations',
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