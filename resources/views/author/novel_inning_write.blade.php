@extends('layouts.app')

@section('content')

    <div class="boxed" xmlns:v-el="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div id="content-container">

            <div id="page-title">
                <h1 class="page-header text-overflow">작품회차등록</h1>
            </div>


            <ol class="breadcrumb">
                <li><a href="#">작가홈</a></li>
                <li><a href="#">작품관리</a></li>
                <li class="active">작품회차등록</li>
            </ol>


            <div id="page-content">


                <div class="row" id="novel_submit">
                    <div class="col-sm-12">
                        <div id="errors_show" class="alert alert-danger" v-if="formErrors">
                            <ul>
                                <li v-if="errors['title']">@{{ errors.title.toString() }}</li>
                                <li v-if="errors['novel_content']">@{{ errors.novel_content.toString() }}</li>
                                <li v-if="errors['author_comment']">@{{ errors.author_comment.toString() }}</li>
                            </ul>
                        </div>
                        <div class="panel">
                            <form action="" method="post" enctype="multipart/form-data"
                                  class="panel-body form-horizontal form-padding" v-on:submit.prevent="submit">
                                <meta id="token" name="token" content="{{ csrf_token() }}">
                                <input hidden type="text" v-model="novel.novel_group_id" name="novel_group_id">
                                <!--Static-->
                                <div class="form-group">
                                    <label class="col-md-2 control-label"></label>

                                    <div class="col-md-9"><p class="form-control-static">

                                        <h3>{{ $novel_group->title }}</h3></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="demo-email-input">제목</label>

                                    <div class="col-md-9">
                                        <input type="text" name="title" v-model="novel.title" id="demo-email-input"
                                               class="form-control"
                                               placeholder="작품 제목을 입력해 주세요." data-bv-field="title">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="demo-email-input">성인</label>

                                    <div class="col-md-9">
                                        <div class="checkbox">
                                            <label class="form-checkbox form-normal form-primary active"><input
                                                        name="adult" type="checkbox" v-model="novel.adult"> 19세 미만
                                                관람불가입니다.</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="demo-email-input">예약등록</label>

                                    <div class="col-md-9">
                                        <div class="checkbox inline">
                                            <label class="form-checkbox form-normal form-primary active"><input
                                                        name="publish_reservation" type="checkbox" id="publish_check"
                                                        class=" margin-left-10" v-model="novel.publish_reservation">
                                                예약등록</label>
                                        </div>


                                        <div class="inline">
                                            <input v-model="novel.reser_day" disabled type="text" name="reser_day"
                                                   id="reser_day"
                                                   class="form-control inline" placeholder="예약일" style="width:100px;">


                                            <input v-model="novel.reser_time" disabled style="width:100px;" type="text"
                                                   id="reser_time"
                                                   name="reser_time"
                                                   class="timepicker form-control inline">


                                        </div>
                                        <small class="has-warning">예약 기능은 신규 챕터 등록 시에만 적용되며, 등록된 챕터를 수정할 때는 적용되지 않습니다.
                                        </small>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="demo-textarea-input">내용</label>

                                    <div class="col-md-9">
                                        <textarea v-model="novel.novel_content" name="novel_content"
                                                  id="demo-textarea-input" rows="20" class="form-control"
                                                  placeholder="공백 포함 3천 자 미만은 등록되지 않습니다.

다음의 내용을 포함하고 있는 글은 통보 없이 삭제될 수 있으며, 만약 유료로 판매되었을 경우 독자에게 전액 환불 처리되니 유의하여 주시기 바랍니다.
-로맨스 소설의 범주를 벗어난 비상식적인 성적 표현 및 외설적인 내용
-공서양속을 해치는 내용
-타인의 권리나 인격을 침해하는 내용
-분란을 조장하는 내용
-해당 소설과 관련 없는 내용
-그 밖에 약관의 규정을 어기는 내용"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="demo-textarea-input">작가의 말</label>

                                    <div class="col-md-9">
                                        <textarea rows="5" name="author_comment" id="demo-textarea-input"
                                                  class="form-control" v-model="novel.author_comment"
                                                  placeholder="작가의 말"></textarea>
                                    </div>
                                </div>


                                <!--div class="form-group">
                                    <label class="col-md-2 control-label">표지</label>
                                    <div class="col-md-9">


                                        <input type="file" id="demo-password-input" class="form-control"
                                               placeholder="Password">
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
                                        <button class="btn btn-lg btn-danger" v-on:click.prevent="confirm_back()">취소
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>


    <script>

        //  var moment = require('moment');

        var app123 = new Vue({
            el: '#novel_submit',

            data: {
                novel: {novel_group_id: "{{ $novel_group->id }}"},
                formErrors: false,
                errors: {}
            },
            mounted: function () {

            },
            methods: {
                submit: function (e) {
                    e.preventDefault();
//                    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');
                    Vue.http.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;

                    var action = '{{ route('novels.store') }}';
//                    var csrfToken = form.querySelector('input[name="_token"]').value;

                    var date = $("#reser_day").val();
                    this.novel.reser_day = date;
                    var time = $("#reser_time").val();
                    this.novel.reser_time = time;

                    // console.log(this.novel);
                    this.$http.post(action, this.novel, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {
                                window.location.href = '{{  route('author_novel_group',['id' => $novel_group->id]) }}';
                            })
                            .catch(function (errors) {

                                this.errors = errors.data;
                                this.formErrors = true;
                                $("html, body").animate({scrollTop: 0}, "slow");
                                return false;

                            });
                },
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


            $("#reser_day").datepicker({
                dateFormat: 'yy-mm-dd'
            });


        });
        $("#reser_time").timepicker({
            showMeridian: false,
            showInputs: false,
            minuteStep: 30

        });

        $("#publish_check").click(function () {
            if ($(this).is(":checked")) {
                $("#reser_time").prop('disabled', false);
                $("#reser_day").prop('disabled', false);
            }
            else {
                $("#reser_time").prop('disabled', true);
                $("#reser_day").prop('disabled', true);
            }
        });

    </script>

@endsection