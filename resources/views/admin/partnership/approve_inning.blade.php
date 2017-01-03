@extends('layouts.admin_layout')
@section('content')


    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml">

        <div id="page-title">
            <h1 class="page-header text-overflow">회차별 심사 승인</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">어드민</a></li>
            <li class="active">연재신청내역</li>
        </ol>


        <div id="page-content">


            <div class="row">
                <div class="col-sm-12">

                    <div class="panel">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <div id="manage_apply">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            @foreach($companies as $company)

                                                <button class="btn btn-primary"
                                                        onclick="window.location.href='{{route('admin.partner_manage_apply',['id'=>$company->id]) }}'">{{$company->name}}</button>

                                            @endforeach
                                        </tr>
                                        </thead>
                                    </table>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>작가명</th>
                                            <th>작품명</th>
                                            <th>연재요청업체명</th>

                                            <th class="text-center">신청일</th>
                                            <th class="text-center">처리일</th>
                                            <th class="text-center">상태</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($apply_requests as $apply_request)
                                            @foreach($apply_request->publish_novel_groups->companies as $company)
                                                <tr>
                                                    <td class="col-md-1">{{$apply_request->publish_novel_groups->novel_groups->users->name}}</td>
                                                    <td class="col-md-2">{{$apply_request->publish_novel_groups->novel_groups->title}}</td>
                                                    <td class="col-md-2">{{$company->name}}</td>

                                                    <td class="col-md-1 text-center">{{$apply_request->created_at}}</td>
                                                    <td class="col-md-1 text-center">{{$apply_request->updated_at}}</td>
                                                    <td class="col-md-2 text-center">
                                                        <button class="btn btn-sm btn-warning">심사중</button>
                                                        @if($apply_request->status == '심사중')
                                                            <span id="response{{$apply_request->id}}"></span>
                                                            <button class="btn btn-sm btn-primary"
                                                                    id="approve{{$apply_request->id}}"
                                                                    v-on:click="approve_deny('{{$apply_request->id}}',1)">@{{approve_status}}</button>
                                                            <button class="btn btn-sm btn-danger"
                                                                    id="deny{{$apply_request->id}}"
                                                                    v-on:click="approve_deny('{{$apply_request->id}}',0)">@{{deny_status}}</button>
                                                        @elseif($apply_request->status == '거절')
                                                            <span style="cursor:pointer;"
                                                                  v-on:click="{{"deny_reason(".$apply_request->id." ,'".$apply_request->reject_reason."')"}}">{{$apply_request->status}}</span>
                                                        @else
                                                            <span>{{$apply_request->status}}</span>
                                                        @endif
                                                    </td>
                                                </tr>

                                            @endforeach
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
    <script type="text/javascript">
        var app = new Vue({
            el: '#manage_apply',
            data: {
                approve_status: '승인',
                deny_status: '거절',
                info: {
                    status: '',
                    deny_reason: ''
                }
            },
            mounted: function () {

            },
            methods: {
                deny_reason: function (company_id, reason) {
                    bootbox.prompt({
                        title: "거절 사유",
                        buttons: {
                            confirm: {
                                label: "거절",
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
                                app.info.status = "거절";

                                app.info.deny_reason = result;

                                app.$http.put('{{ url('publish_companies') }}/' + company_id, app.info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                                        .then(function (response) {
                                            $('#approve' + company_id).hide();
                                            $('#deny' + company_id).hide();
                                            $('#response' + company_id).html(response.data.data);
                                            $.niftyNoty({
                                                type: 'success',
                                                icon: 'fa fa-check',
                                                message: app.info.status + "했습니다",
                                                container: 'floating',
                                                timer: 3000
                                            });
                                            location.reload();

                                        })
                                        .catch(function (data, status, request) {
                                            var errors = data.data;
                                        });
                            }
                        }

                    })
                },
                approve_deny: function (company_id, type) {
                    // if type==1 is approve else deny
                    if (type == 1) {

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
                                                $.niftyNoty({
                                                    type: 'success',
                                                    icon: 'fa fa-check',
                                                    message: app.info.status + "했습니다",
                                                    container: 'floating',
                                                    timer: 3000
                                                });


                                            })
                                            .catch(function (data, status, request) {
                                                var errors = data.data;
                                            });

                                }

                            }
                        });
                    } else {

                        bootbox.prompt({
                            title: "거절 사유",
                            buttons: {
                                confirm: {
                                    label: "거절"
                                },
                                cancel: {
                                    label: '취소'
                                }
                            },

                            callback: function (result) {
                                if (result) {


                                    //deny_info
                                    app.info.status = app.deny_status;

                                    app.info.deny_reason = result;

                                    app.$http.put('{{ url('publish_companies') }}/' + company_id, app.info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                                            .then(function (response) {
                                                $('#approve' + company_id).hide();
                                                $('#deny' + company_id).hide();
                                                $('#response' + company_id).html(response.data.data);
                                                $.niftyNoty({
                                                    type: 'success',
                                                    icon: 'fa fa-check',
                                                    message: app.info.status + "했습니다",
                                                    container: 'floating',
                                                    timer: 3000
                                                });
                                                location.reload();

                                            })
                                            .catch(function (data, status, request) {
                                                var errors = data.data;
                                            });
                                }

                            }
                        });

                    }
                }
            }
        });

    </script>

@endsection