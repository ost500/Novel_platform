@extends('layouts.app')
@section('content')


    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml">

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

                                    <table class="table table-striped table-hover">
                                        <thead>
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
                                        </thead>
                                        <tbody>
                                        @foreach($apply_requests as $apply_request)
                                            <tr>
                                                <td class="col-md-1">{{$apply_request->novel_groups->users->name}}</td>
                                                <td class="col-md-2">{{$apply_request->novel_groups->title}}</td>
                                                <td class="col-md-2">{{$apply_request->companies->name}}</td>
                                                <td class="col-md-1 text-center">{{$apply_request->companies->initial_inning}}
                                                    편
                                                </td>
                                                <td class="col-md-1 text-center">{{$apply_request->publish_novel_groups->days}}
                                                    일
                                                </td>
                                                <td class="col-md-1 text-center">{{$apply_request->publish_novel_groups->novels_per_days}}
                                                    편
                                                </td>
                                                <td class="col-md-1 text-center">{{$apply_request->created_at}}</td>
                                                <td class="col-md-1 text-center">{{$apply_request->updated_at}}</td>
                                                <td class="col-md-2 text-center">
                                                    {{--<button class="btn btn-sm btn-warning">심사중</button> --}}
                                                    @if($apply_request->status == '심사중')
                                                        <span id="response{{$apply_request->id}}"></span>
                                                        <button class="btn btn-sm btn-primary" id="approve{{$apply_request->id}}"
                                                                v-on:click="approve_deny('{{$apply_request->id}}',1)">@{{approve_status}}</button>
                                                        <button class="btn btn-sm btn-danger" id="deny{{$apply_request->id}}"
                                                                v-on:click="approve_deny('{{$apply_request->id}}',0)">@{{deny_status}}</button>
                                                    @else
                                                        <span>{{$apply_request->status}}</span>
                                                    @endif
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
                                    @include('pagination', ['collection' => $apply_requests, 'url' => route('author.partner_manage_apply')])

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
                }
            },
            mounted: function () {

            },
            methods: {
                approve_deny: function (company_id, type) {
                    if (type == 1) {
                        this.info.status = this.approve_status;
                    } else {
                        this.info.status = this.deny_status;
                    }
                    this.$http.put('{{ url('publish_companies') }}/' + company_id, this.info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {
                                $('#approve'+company_id).hide();
                                $('#deny'+company_id).hide();
                                $('#response'+company_id).html(response.data.data);
                            }).catch(function (data, status, request) {
                                var errors = data.data;
                            });s
                }
            }

        });

    </script>

@endsection