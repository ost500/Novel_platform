@extends('layouts.admin_layout')
@section('content')


    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml">

        <div id="page-title">
            <h1 class="page-header text-overflow">연재신청관리</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">어드민</a></li>
            <li><a href="#">제휴업체관리</a></li>
            <li class="active">연재신청관리</li>
        </ol>


        <div id="page-content">


            <div class="row">
                <div class="col-sm-12">

                    <div class="panel">
                        <div class="panel-body">
                            <div class="table-responsive" style="min-height:500px">
                                <div id="manage_apply">

                                    @foreach($companies as $company)
                                        <button class="btn btn-primary"
                                                onclick="window.location.href='{{route('admin.partner_manage_apply',['id'=>$company->id]) }}'">{{$company->name}}</button>
                                    @endforeach

                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>작가명</th>
                                            <th>작품명</th>
                                            <th>연재요청업체명</th>
                                            <th class="text-center">초기연재회차</th>
                                            <th class="text-center">일</th>
                                            <th class="text-center">편수</th>
                                            <th class="text-center">
                                                <a href="{{route('admin.partner_manage_apply',['id'=>null])."?order=event" }}">이벤트
                                                    <i class="fa fa-sort" aria-hidden="true"></i></a>
                                            </th>
                                            <th class="text-center">신청일</th>
                                            <th class="text-center">처리일</th>
                                            <th class="text-center">상태</th>
                                            <th class="text-center">상태변경</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($apply_requests as $apply_request)
                                            <tr>
                                                <td class="col-md-1">{{$apply_request->publish_novel_groups->users->name}}</td>
                                                <td class="col-md-2"><a href="{{ route('each_novel.novel_group', ['id'=> $apply_request->publish_novel_groups->novel_groups->id]) }}">{{$apply_request->publish_novel_groups->novel_groups->title}}</a></td>
                                                <td class="col-md-1">{{$apply_request->companies->name}}</td>
                                                <td class="col-md-1 text-center">{{$apply_request->initial_novels}}
                                                    편
                                                </td>
                                                <td class="col-md-1 text-center">{{$apply_request->days}}
                                                    일
                                                </td>
                                                <td class="col-md-1 text-center">{{$apply_request->novels_per_days}}
                                                    편
                                                </td>
                                                <td class="col-md-1 text-center">@if($apply_request->publish_novel_groups->event)
                                                        수락@else거절@endif</td>
                                                <td class="col-md-1 text-center">{{$apply_request->created_at}}</td>
                                                <td class="col-md-1 text-center">{{$apply_request->updated_at}}</td>
                                                <td class="col-md-1 text-center">
                                                    @if($apply_request->status == '거절')
                                                        <button class="btn btn-danger"
                                                                v-on:click="deny_reason('{{$apply_request->reject_reason}}','{{$apply_request->id}}','거절')">
                                                            거절
                                                        </button>
                                                    @elseif($apply_request->status == '승인')
                                                        <button class="btn btn-success">
                                                            승인
                                                        </button>
                                                    @elseif($apply_request->status == '대기중')
                                                        <button class="btn btn-warning">
                                                            대기중
                                                        </button>
                                                    @elseif($apply_request->status == '신청불가')
                                                        <button class="btn btn-info"
                                                                v-on:click="deny_reason('{{$apply_request->reject_reason}}','{{$apply_request->id}}','신청불가')">
                                                            신청불가
                                                        </button>
                                                    @else
                                                        {{ $apply_request->status }}
                                                    @endif
                                                </td>
                                                <td class="col-md-2 text-center">

                                                    <div class="btn-group">
                                                        <button class="btn btn-default btn-active-pink dropdown-toggle dropdown-toggle-icon"
                                                                data-toggle="dropdown" type="button"
                                                                aria-expanded="false">
                                                            {{ $apply_request->status }} <i
                                                                    class="dropdown-caret fa fa-caret-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <a v-on:click="status_change('{{$apply_request->id}}','대기중')">대기중</a>
                                                            </li>
                                                            <li>
                                                                <a v-on:click="status_change('{{$apply_request->id}}','승인')">승인</a>
                                                            </li>
                                                            <li>
                                                                <a v-on:click="status_change('{{$apply_request->id}}','거절')">거절</a>
                                                            </li>
                                                            <li>
                                                                <a v-on:click="status_change('{{$apply_request->id}}','신청불가')">신청불가</a>
                                                            </li>

                                                        </ul>
                                                    </div>

                                                </td>
                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            {{-- <div id="response"></div>--}}
                            <div class="fixed-table-pagination" style="display: block;">
                                <div class="pull-left">
                                    {{-- <button class="btn btn-danger">선택삭제</button>--}}
                                </div>

                                <div class="pull-right">
                                    @include('pagination', ['collection' => $apply_requests, 'url' => route('admin.partner_manage_apply')])

                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>
    <script src="/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript">
        var app = new Vue({
            el: '#manage_apply',
            data: {
                approve_status: '승인',
                deny_status: '거절',
                refuse_status: '신청불가',
                info: {
                    status: '',
                    deny_reason: ''
                }
            },
            mounted: function () {

            },
            methods: {

                deny_reason: function (reason, id, status) {
                    bootbox.prompt({
                        title: status + " 사유",
                        buttons: {
                            confirm: {
                                label: status,
                            },
                            cancel: {
                                label: '취소'
                            }
                        },
                        value: reason,
                        callback: function (result) {
                            if (result) {
                                console.log('hi');
                                //deny_info
                                app.info.status = status;

                                app.info.deny_reason = result;

                                app.$http.put('{{ url('publish_companies') }}/' + id , app.info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                                        .then(function (response) {

                                            location.reload();

                                        })
                                        .catch(function (data, status, request) {
                                            var errors = data.data;
                                        });
                            }
                        }

                    })
                },
                status_change: function (company_id, type) {
                    // if type==1 is approve else deny
                    if (type == '승인') {

                        bootbox.confirm({
                            message: "승인 하시겠습니까?",

                            buttons: {
                                confirm: {
                                    label: "승인"
                                },
                                cancel: {
                                    label: '취소'
                                }
                            },

                            callback: function (result) {
                                //approve info
                                app.info.status = app.approve_status;

                                if (result) {
                                    Vue.http.headers.common['X-CSRF-TOKEN'] = "{!! csrf_token() !!}";
                                    //                    var csrfToken = form.querySelector('input[name="_token"]').value;

                                    app.$http.put('{{ url('publish_companies') }}/' + company_id, app.info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                                            .then(function (response) {
                                                $('#approve' + company_id).hide();
                                                $('#deny' + company_id).hide();
                                                $('#response' + company_id).html(response.data.data);
                                                location.reload();


                                            })
                                            .catch(function (data, status, request) {
                                                var errors = data.data;
                                            });

                                }

                            }
                        });
                    } else if (type == '거절') {

                        bootbox.dialog({
                            title: "거절",
                            message: '<div class="row"> ' + '<div class="col-md-12"> ' +
                            '<form class="form-horizontal"> ' + '<div class="form-group"> ' +
                            '<label class="col-md-2 control-label" for="name">거절사유</label> ' +
                            '<div class="col-md-9"> ' +
                            '<input id="name" name="name" type="text" placeholder="거절 사유" class="form-control input-md"> ' +
                            '<span class="help-block"><small></small></span> </div> ' +
                            '</div> ' + '<div class="form-group"> ' + '</form> </div> </div>',
                            buttons: {
                                success: {
                                    label: "확인",
                                    className: "btn-purple",
                                    callback: function () {
                                        var name = $('#name').val();


                                        //deny_info
                                        app.info.status = '거절';

                                        app.info.deny_reason = name;

                                        app.$http.put('{{ url('publish_companies') }}/' + company_id, app.info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                                                .then(function (response) {
                                                    $('#approve' + company_id).hide();
                                                    $('#deny' + company_id).hide();
                                                    $('#response' + company_id).html(response.data.data);

                                                    location.reload();

                                                })
                                                .catch(function (data, status, request) {
                                                    var errors = data.data;
                                                });

                                    }
                                }
                            }
                        });


                    } else if (type == '대기중') {


                        bootbox.confirm({
                            message: "대기중으로 변경 하시겠습니까?",

                            buttons: {
                                confirm: {
                                    label: "대기중"
                                },
                                cancel: {
                                    label: '취소'
                                }
                            },

                            callback: function (result) {
                                //approve info
                                app.info.status = '대기중';

                                if (result) {
                                    Vue.http.headers.common['X-CSRF-TOKEN'] = "{!! csrf_token() !!}";
                                    //                    var csrfToken = form.querySelector('input[name="_token"]').value;

                                    app.$http.put('{{ url('publish_companies') }}/' + company_id, app.info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                                            .then(function (response) {
                                                $('#approve' + company_id).hide();
                                                $('#deny' + company_id).hide();
                                                $('#response' + company_id).html(response.data.data);


                                                location.reload();
                                            })
                                            .catch(function (data, status, request) {
                                                var errors = data.data;
                                            });

                                }

                            }
                        });
                    } else if (type == '신청불가') {


                        bootbox.dialog({
                            title: "신청불가",
                            message: '<div class="row"> ' + '<div class="col-md-12"> ' +
                            '<form class="form-horizontal"> ' + '<div class="form-group"> ' +
                            '<label class="col-md-2 control-label" for="name">신청불가 사유</label> ' +
                            '<div class="col-md-9"> ' +
                            '<input id="name" name="name" type="text" placeholder="거절 사유" class="form-control input-md"> ' +
                            '<span class="help-block"><small></small></span> </div> ' +
                            '</div> ' + '<div class="form-group"> ' + '</form> </div> </div>',
                            buttons: {
                                success: {
                                    label: "확인",
                                    className: "btn-purple",
                                    callback: function () {
                                        var name = $('#name').val();


                                        //deny_info
                                        app.info.status = '신청불가';

                                        app.info.deny_reason = name;

                                        app.$http.put('{{ url('publish_companies') }}/' + company_id, app.info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                                                .then(function (response) {
                                                    $('#approve' + company_id).hide();
                                                    $('#deny' + company_id).hide();
                                                    $('#response' + company_id).html(response.data.data);

                                                    location.reload();

                                                })
                                                .catch(function (data, status, request) {
                                                    var errors = data.data;
                                                });

                                    }
                                }
                            }
                        });


                    }
                }
            }
        });

    </script>

@endsection