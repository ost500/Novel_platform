@extends('layouts.admin_layout')
@section('content')


    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">

        <div id="page-title">
            <h1 class="page-header text-overflow">연재신청내역</h1>
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

                                    <div class="col-md-10 pad-no padding-bottom-5">
                                        @foreach($companies as $company)
                                            <button class="btn btn-primary"
                                                    onclick="window.location.href='{{route('admin.partner_manage_apply',['id'=>$company->id]) }}'">{{$company->name}}</button>

                                        @endforeach
                                        {{--  <button type="button" class="btn btn-primary novel-agree">연재약관</button>--}}
                                    </div>

                                    {{--<table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            @foreach($companies as $company)
                                                <th>
                                                    <button class="btn btn-primary"
                                                            onclick="window.location.href='{{route('admin.partner_manage_apply',['id'=>$company->id]) }}'">{{$company->name}}</button>
                                                </th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                    </table>--}}
                                    @if(count($apply_requests) > 0)
                                        @foreach($apply_requests as $apply_request)
                                            <table class="table">
                                                {{-- <thead>
                                                 <tr>
                                                     <th>작가명</th>
                                                     <th>작품명</th>
                                                     <th>연재요청업체명</th>
                                                     <th class="text-center">초기연재회차</th>
                                                     <th class="text-center">일</th>
                                                     <th class="text-center">편수</th>
                                                     <th class="text-center">신청일</th>
                                                     <th class="text-center">처리일</th>
                                                     <th class="text-center">상태</th>
                                                 </tr>
                                                 </thead>--}}
                                                <tbody>

                                                <tr class="table-bordered">
                                                    <td class="text-center col-md-2">
                                                        <a style="cursor:pointer"
                                                           v-on:click="displayNovels('{{$apply_request->publish_novel_group_id}}')">
                                                            @if($apply_request->novel_groups->cover_photo != null)
                                                                <img class="index_img"
                                                                     src="/img/novel_covers/{{$apply_request->novel_groups->cover_photo}}">
                                                            @else
                                                                <img class="index_img"
                                                                     src="/img/novel_covers/default_.jpg">
                                                            @endif
                                                        </a>
                                                    </td>

                                                    <td>
                                                        <table class="table-no-border" style="width:100%;">

                                                            <tr>
                                                                <td><h4>
                                                                        <a style="cursor:pointer"
                                                                           v-on:click="displayNovels('{{$apply_request->publish_novel_group_id}}')">{{$apply_request->novel_groups->title }}</a>
                                                                    </h4>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>작가명 :{{$apply_request->novel_groups->users->name}},
                                                                    연재요청업체명: {{$apply_request->companies->name}},
                                                                    신청일:{{$apply_request->created_at}}
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="padding-top-10 text-right">
                                                                    @if($apply_request->status == '심사중')
                                                                        <span id="response{{$apply_request->id}}"></span>
                                                                        <button class="btn btn-sm btn-primary"
                                                                                id="approve{{$apply_request->id}}"
                                                                                v-on:click="approve_deny('{{$apply_request->id}}',1)">@{{approve_status}}</button>
                                                                        <button class="btn btn-sm btn-danger"
                                                                                id="deny{{$apply_request->id}}"
                                                                                v-on:click="approve_deny('{{$apply_request->id}}',0)">@{{deny_status}}</button>
                                                                    @else
                                                                        <span>{{$apply_request->status}}</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        {{--
                                                         <td class="col-md-1 text-center">{{$apply_request->companies->initial_inning}}편
                                                         </td>
                                                         <td class="col-md-1 text-center">{{$apply_request->publish_novel_groups->days}}일
                                                         </td>
                                                         <td class="col-md-1 text-center">{{$apply_request->publish_novel_groups->novels_per_days}}편
                                                         </td>
                                                         <td class="col-md-1 text-center">{{$apply_request->created_at}}</td>
                                                         <td class="col-md-1 text-center">{{$apply_request->updated_at}}</td>
                                                       --}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"id="response{{$apply_request->publish_novel_group_id}}"
                                                        v-if="{{$apply_request->publish_novel_group_id }} == novel_show.id && novel_show.TF"></td>
                                                    <td colspan="2"id="response{{$apply_request->publish_novel_group_id}}"
                                                        v-else hidden></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"></td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        @endforeach
                                    @else
                                        <table class="table">
                                            <tr>
                                                <td>
                                                    <div style="font-weight: 600;text-align: center;">
                                                        문의가 없습니다.
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    @endif
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
                    status: ''
                },
                novel_show: {'id': 0, 'TF': false}
            },
            mounted: function () {

            },
            methods: {
                approve_deny: function (company_id, type) {
                    bootbox.prompt("거절 사유", function (result) {
                        if (result) {

                            //distinguish approve or deny function
                            if (type == 1) {
                                app.info.status = app.approve_status;
                            } else {
                                app.info.status = app.deny_status;
                            }
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

                    });

                },

                displayNovels: function (publish_novel_group_id) {
                    if (this.novel_show.TF == true && this.novel_show.id == publish_novel_group_id) {
                        this.novel_show.TF = false;
                        this.novel_show.id = 0;
                    } else {

                        this.$http.get('{{url('publishnovelgroups')}}/' + publish_novel_group_id)
                                .then(function (response) {

                                    this.novel_show.id = publish_novel_group_id;
                                    this.novel_show.TF = true;

                                    $('#response' + publish_novel_group_id).html(response.data);


                                });
                    }
                }
            }

        });

    </script>

@endsection