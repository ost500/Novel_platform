@extends('layouts.app')
@section('content')
    <div id="apply">

        <div id="content-container">

            <div id="page-title">
                <h1 class="page-header text-overflow">제휴연재신청</h1>
            </div>


            <ol class="breadcrumb">
                <li><a href="#">작가홈</a></li>
                <li class="active"><a href="#">제휴연재신청</a></li>
            </ol>


            <div id="page-content">


                <div class="panel panel-default panel-left">
                    <div class="panel-body">
                        <div hidden id="errors">
                            <div class="alert alert-danger" v-if="formErrors">
                                <ul>
                                    <li v-if="errors['days']">@{{ errors.days.toString() }}</li>
                                    <li v-if="errors['novel_group']">@{{ errors.novel_group.toString() }}</li>
                                    <li v-if="errors['novels_per_days']">@{{ errors.novels_per_days.toString() }}</li>
                                    <li v-if="errors['adult']">@{{ errors.adult.toString() }}</li>
                                    <li v-if="errors['initial_inning']">@{{ errors.initial_inning.toString() }}</li>
                                    <li v-if="errors['initial_publish']">@{{ errors.initial_publish.toString() }}</li>


                                </ul>
                            </div>
                        </div>

                        <form id="form_data" class="form-horizontal">
                            {{ csrf_field() }}

                            <div class="form-group pad-ver">
                                <label class="col-lg-1 control-label text-left" for="inputSubject">작품선택</label>
                                <div class="col-lg-11">
                                    <select name="novel_group" class="form-control">
                                        <option value="">작품선택</option>
                                        @foreach($my_novel_groups as $my_novel_group)

                                            <option value="{{$my_novel_group->id}}"
                                                    @if($my_novel_group->id == old('novel_group')) selected @endif>{{$my_novel_group->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>

                            <div class="form-group pad-ver">
                                <label class="col-lg-1 control-label text-left" for="inputSubject">제휴업체</label>
                                <div class="col-lg-11 text-center">

                                        @foreach($companies as $company)
                                            <div class="col-sm-2">
                                                <div>
                                                    <img src="http://211.110.165.137/img/novel_covers/default_.jpg"
                                                         width="150">
                                                </div>
                                                <div class="padding-top-10">
                                                    <label class="form-checkbox form-icon form-text">
                                                        <input type="checkbox" name="company{{$company->id}}"
                                                               value="true"
                                                               @if(old('company'.$company->id)) checked @endif
                                                        > {{ $company->name }}</label>
                                                </div>
                                                <div class="padding-top-10">초기연재 {{$company->initial_inning}}편</div>
                                                <div class="padding-top-10">@if($company->adult)19금 불가@endif</div>
                                            </div>
                                        @endforeach



                                </div>
                            </div>

                            <hr>



                            <div class="form-group pad-ver">
                                <label class="col-lg-1 control-label text-left" for="inputSubject">초기연재편수</label>
                                <div class="col-lg-11">
                                    <select name="initial_publish" class="form-control">
                                        <option value="">선택</option>
                                        @for($i=1; $i<=50; $i++)
                                            <option value="{{$i}}"
                                                    @if($i == old('days')) selected @endif>{{$i}}편
                                            </option>

                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="form-group pad-ver">
                                <label class="col-lg-1 control-label text-left" for="inputSubject">일(날짜)</label>
                                <div class="col-lg-11">
                                    <select name="days" class="form-control">
                                        <option value="">선택</option>
                                        @for($i=1; $i<=10; $i++)
                                            <option value="{{$i}}"
                                                    @if($i == old('days')) selected @endif>{{$i}}일
                                            </option>

                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="form-group pad-ver">
                                <label class="col-lg-1 control-label text-left" for="inputSubject">편수</label>
                                <div class="col-lg-11">
                                    <select name="novels_per_days" class="form-control">
                                        <option value="">선택</option>
                                        @for($i=1; $i<=10; $i++)
                                            <option value="{{$i}}"
                                                    @if($i == old('novels_per_days')) selected @endif>{{$i}}편
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                        </form>
                        <div id="demo-mail-compose"></div>

                        <div class="text-center">
                            <button id="mail-send-btn" v-on:click="post()"
                                    class="btn btn-primary btn-labeled">
                                <span class="btn-label"><i class="fa fa-paper-plane"></i></span> 신청하기
                            </button>
                            {{--<a href="with_company.html">--}}
                            {{--<button type="button" class="btn btn-danger">취소</button>--}}
                            {{--</a>--}}
                        </div>

                    </div>


                </div>


            </div>


        </div>

    </div>
    <script type="text/javascript">
        var apply = new Vue({
            name: "hello",
            el: '#apply',
            data: {
                formErrors: false,
                errors: {}

            },
            mounted: function () {

            },
            methods: {

                post: function () {


                    bootbox.dialog({
                        message: "본인의 작품이 네이버 타임딜, 카카오페이지, 기다리면 무료 등,<br> 각 제휴처의 이벤트에 참여하는지 체크해 주세요",
                        title: "이벤트 참여 여부 확인",
                        buttons: {
                            success: {
                                label: "이벤트 수락",
                                className: "btn-success",
                                callback: function () {

                                    var form = $("#form_data");
                                    console.log(form);
                                    $.ajax({
                                        type: 'POST',
                                        url: '{{ route('publishnovelgroups.store') }}/?event=1',
                                        headers: {
                                            'X-CSRF-TOKEN': window.Laravel.csrfToken
                                        },
                                        data: form.serialize(),
                                        success: function (response) {
                                            console.log(response);

                                            window.location.assign('{{route('author.partner_apply_list')}}');
                                        },
                                        error: function (data2) {
                                            $("#errors").show();
                                            apply.errors = data2.responseJSON;
                                            console.log(apply.errors);
                                            apply.formErrors = true;
                                            $("#errors").focus();
                                        }
                                    });


                                }
                            },

                            danger: {
                                label: "이벤트 거절",
                                className: "btn-danger",
                                callback: function () {
                                    var form = $("#form_data");
                                    console.log(form);
                                    $.ajax({
                                        type: 'POST',
                                        url: '{{ route('publishnovelgroups.store') }}/?event=0',
                                        headers: {
                                            'X-CSRF-TOKEN': window.Laravel.csrfToken
                                        },
                                        data: form.serialize(),
                                        success: function (response) {


                                            window.location.assign('{{route('author.partner_apply_list')}}');
                                        },
                                        error: function (data2) {
                                            $("#errors").show();

                                            apply.errors = data2.responseJSON;
                                            console.log(apply.errors);
                                            apply.formErrors = true;
                                            $("#errors").focus();
                                        }
                                    });
                                }
                            },

                            main: {
                                label: "취소",
                                className: "btn-primary",
                                callback: function () {

                                }
                            }
                        }
                    });


                }

            }
        });


    </script>

@endsection