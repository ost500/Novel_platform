@extends('layouts.app')

@section('content')

    {{--<div class="boxed" > --}}
    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml">

        <div id="page-title">
            <h1 class="page-header text-overflow">작품회차등록</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">작가홈</a></li>
            <li><a href="#">작품관리</a></li>
            <li class="active">작품회차등록</li>
        </ol>


        <div id="page-content">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row" id="novel_submit">
                <div class="col-sm-12">

                    <div class="panel">
                        <form action="{{ route('novels.update',['novel'=> $novel->id]) }}" method="POST"
                              enctype="multipart/form-data"
                              class="panel-body form-horizontal form-padding">
                            <input name="_method" type="hidden" value="PUT">

                            {{ csrf_field() }}
                            <input hidden type="text" name="novel_group_id">
                            <!--Static-->
                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>

                                <div class="col-md-9"><p class="form-control-static">

                                    <h3>{{ $novel_group->title }}</h3></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-email-input">제목</label>

                                <div class="col-md-9">
                                    <input type="text" name="title" value="{{$novel->title}}" id="demo-email-input"
                                           class="form-control"
                                           placeholder="작품 제목을 입력해 주세요." data-bv-field="title">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-email-input">성인</label>

                                <div class="col-md-9">
                                    <div class="checkbox">
                                        <label class="form-checkbox form-normal form-primary active">
                                            <input name="adult" type="checkbox"
                                                   @if($novel->adult == 1) checked="checked" @endif >

                                            19세 미만
                                            관람불가입니다.</label>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-email-input">예약등록</label>

                                <div class="col-md-9">
                                    <div class="checkbox inline">
                                        <label class="form-checkbox form-normal form-primary active">
                                            <input name="publish_reservation" type="checkbox" id="publish_check"
                                                   class=" margin-left-10"
                                                   @if($novel->publish_reservation != null) checked="checked" @endif>
                                            예약등록</label>
                                    </div>


                                    <div class="inline">
                                        <input readonly type="text" name="reser_day" id="reser_day"
                                               value="{{$novel->reser_day}}"
                                               class="form-control inline" placeholder="예약일" style="width:100px;">


                                        <input readonly style="width:100px;" type="text"
                                               name="reser_time" id="demo-tp-com"
                                               value=" @if($novel->reser_time !=null) {{$novel->reser_time}} @endif"
                                               class="timepicker form-control inline" placeholder="예약시간">


                                    </div>
                                    <small class="has-warning">예약 기능은 신규 챕터 등록 시에만 적용되며, 등록된 챕터를 수정할 때는 적용되지 않습니다.
                                    </small>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-textarea-input">내용</label>

                                <div class="col-md-9">
                                        <textarea rows="20" name="content" id="demo-textarea-input" class="form-control"
                                                  placeholder="공백 포함 3천 자 미만은 등록되지 않습니다.

다음의 내용을 포함하고 있는 글은 통보 없이 삭제될 수 있으며, 만약 유료로 판매되었을 경우 독자에게 전액 환불 처리되니 유의하여 주시기 바랍니다.
-로맨스 소설의 범주를 벗어난 비상식적인 성적 표현 및 외설적인 내용
-공서양속을 해치는 내용
-타인의 권리나 인격을 침해하는 내용
-분란을 조장하는 내용
-해당 소설과 관련 없는 내용
-그 밖에 약관의 규정을 어기는 내용"> {{$novel->content}} </textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-textarea-input">작가의 말</label>

                                <div class="col-md-9">
                                        <textarea rows="5" name="author_comment" id="demo-textarea-input"
                                                  class="form-control"
                                                  placeholder="작가의 말"> {{$novel->author_comment}}</textarea>
                                </div>
                            </div>


                            <!--div class="form-group">
                                <label class="col-md-2 control-label">표지</label>
                                <div class="col-md-9">


                                    <input type="file" id="demo-password-input" class="form-control"
                                           placeholder="Password" id="file_" name="cover_photo">
                                    <small class="has-warning">사이즈 : 900*900 / 최대용량 : 1M / 업로드 가능 확장자 : JPG, PNG
                                        파일
                                    </small>

                                    <div class="alert alert-warning media fade in">
                                        <div class="media-left">
                                                <span class="icon-wrap icon-wrap-xs icon-circle alert-icon">
                                                    <i class="fa fa-bolt fa-lg"></i>
                                                </span>
                                        </div>
                                        <div class="media-body">
                                            <p class="alert-title">표지를 직접 등록할 때, 이미지 사이즈와 확장자가 정확 해야만 등록이 됩니다.</p>
                                            <p class="alert-title">저작권을 분쟁의 소지가 있는 이미지는 사용하실 수 없습니다. 저작권 관련 문제 발생 시,
                                                모든 책임은 개인에게 있습니다.</p>
                                        </div>
                                    </div>
                                </div>
                            </div-->


                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-lg btn-primary">회차저장</button>
                                    <button type="button" class="btn btn-lg btn-danger"
                                            v-on:click.prevent="confirm_back()">취소
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>


    </div>
    {{--  </div> --}}


    <script>
        var app123 = new Vue({
            el: '#novel_submit',
            data: {},
            methods: {

                confirm_back: function () {
                    bootbox.confirm({
                        message: "취소 하시겠습니까?",

                        buttons: {
                            confirm: {
                                label: "예"
                            },
                            cancel: {
                                label: '아니오'
                            }
                        },

                        callback: function (result) {

                            if (result) {
                                location.assign('{{route('author_novel_group',['id'=>$novel_group->id])}}');
                            }
                        }
                    });
                }


            }
        });


        $(function () {
            $.datepicker.regional['ko'] = {
                closeText: '닫기',
                prevText: '이전달',
                nextText: '다음달',
                currentText: '오늘',
                monthNames: ['1월(JAN)', '2월(FEB)', '3월(MAR)', '4월(APR)', '5월(MAY)', '6월(JUN)',
                    '7월(JUL)', '8월(AUG)', '9월(SEP)', '10월(OCT)', '11월(NOV)', '12월(DEC)'],
                monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월',
                    '7월', '8월', '9월', '10월', '11월', '12월'],
                dayNames: ['일', '월', '화', '수', '목', '금', '토'],
                dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
                dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
                weekHeader: 'Wk',
                dateFormat: 'yy-mm-dd',
                firstDay: 0,
                isRTL: false,
                showMonthAfterYear: true,
                yearSuffix: ''
            };
            $.datepicker.setDefaults($.datepicker.regional['ko']);

            $("#reser_day").datepicker({dateFormat: 'yy-mm-dd'});


        });
        $("#demo-tp-com").timepicker({
            showMeridian: false,

            showInputs: false,
            minuteStep: 30
        });

        $("#publish_check").click(function () {
            if ($(this).is(":checked")) {
                $("#demo-tp-com").prop('disabled', false);
                $("#reser_day").prop('disabled', false);
            }
            else {
                $("#demo-tp-com").prop('disabled', true);
                $("#reser_day").prop('disabled', true);
            }
        });


    </script>

@endsection