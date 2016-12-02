@extends('layouts.app')

@section('content')

    <div class="boxed" xmlns:v-el="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml"
         xmlns:v-bind="http://www.w3.org/1999/xhtml">
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

                        <div class="panel">
                            <form action="{{ route('novels.update',['novel'=> $novel->id]) }}" method="post"
                                  enctype="multipart/form-data"
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
                                    <label class="col-md-2 control-label" for="demo-email-input">출간예약</label>
                                    <div class="col-md-9">
                                        <div class="checkbox inline">
                                            <label class="form-checkbox form-normal form-primary active"><input
                                                        name="publish_reservation" type="checkbox" id="publish_check"
                                                        class=" margin-left-10" v-model="novel.publish_reservation">
                                                출간예약</label>
                                        </div>


                                        <div class="inline">
                                            <input v-model="novel.reser_day" disabled type="text" name="reser_day"
                                                   id="reser_day"
                                                   class="form-control inline" placeholder="예약일" style="width:100px;">


                                            <input v-model="novel.reser_time" disabled style="width:100px;" type="text"
                                                   name="reser_time" id="demo-tp-com" type="text"
                                                   class="timepicker form-control inline" placeholder="예약시간">


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
                                                  placeholder="작품 소개를 입력해 주세요"></textarea>
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


                                <div class="form-group">
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
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-lg btn-primary">회차저장</button>
                                        <button class="btn btn-lg btn-danger">취소</button>
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


        var app123 = new Vue({
            el: '#novel_submit',
            data: {
                novel: {
                    novel_group_id: "{{ $novel_group->id }}",
                    title: "{{$novel->title}}",
                    adult: "{{$novel->adult}}",
                    publish_reservation: "{{$novel->publish_reservation}}",
                    reser_day: "{{$novel->reser_day}}",
                    reser_time: "{{$novel->reser_time}}",
                    novel_content: "{{$novel->title}}",
                    author_comment: "{{$novel->title}}"
                },
                formErrors: {}
            },
            mounted: function () {

            },
            methods: {
                submit: function (e) {
                    e.preventDefault();
//                    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');
                    Vue.http.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
                    var form = e.srcElement;
                    var action = form.action;
//                    var csrfToken = form.querySelector('input[name="_token"]').value;

                    this.$http.put(action, this.novel, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {
                                window.location.assign('{{ route('author_novel_group',['id'=>$novel_group->id]) }}');

                            })
                            .catch(function (data, status, request) {
                                var errors = data.data;
                                this.formErrors = errors;
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