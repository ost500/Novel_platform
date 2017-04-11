@extends('layouts.app')
@section('content')
    <div id="apply" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div id="content-container">

            <div id="page-title">
                <h1 class="page-header text-overflow">연재신청내역</h1>
            </div>


            <ol class="breadcrumb">
                <li><a href="#">작가홈</a></li>
                <li><a href="#">제휴연재신청</a></li>
                <li class="active">연재신청내역</li>
            </ol>


            <div id="page-content">


                <div class="row">
                    <div class="col-sm-12">

                        <div class="panel">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-center"><a
                                                        href="{{route('author.partner_apply_list')."?order=1"}}">작품명 <i
                                                            class="fa fa-sort" aria-hidden="true"></i></a>
                                            </th>
                                            <th class="text-center"><a
                                                        href="{{route('author.partner_apply_list')."?order=2"}}">업체명 <i
                                                            class="fa fa-sort" aria-hidden="true"></i></a>
                                            </th>
                                            <th class="text-center"><a
                                                        href="{{route('author.partner_apply_list')."?order=3"}}">상태 <i
                                                            class="fa fa-sort" aria-hidden="true"></i></a>
                                            </th>
                                            <th class="text-center">초기 연재 회차</th>
                                            <th class="text-center">일</th>
                                            <th class="text-center">편수</th>
                                            <th class="text-center">이벤트</th>
                                            <th class="text-center">신청일</th>
                                            <th class="text-center">처리일</th>
                                            {{--@foreach($companies as $company)--}}
                                            {{--<th class="text-center">{{ $company->name }}</th>--}}
                                            {{--@endforeach--}}

                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($my_publish_novel_groups as $my_publish_novel_group)

                                            <tr>
                                                <td class="col-md-2">{{$my_publish_novel_group->publish_novel_groups->novel_groups->title}}</td>
                                                <td class="col-md-1 text-center">{{$my_publish_novel_group->companies->name}}</td>
                                                <td class="col-md-1 text-center">
                                                    @if($my_publish_novel_group->status == "거절")
                                                        <button class="btn btn-danger"
                                                                v-on:click="{{"reject_reason('".$my_publish_novel_group->reject_reason."')"}}">
                                                            <div>{{$my_publish_novel_group->status}}</div>
                                                        </button>

                                                    @elseif($my_publish_novel_group->status == "승인")
                                                        <button class="btn btn-success">{{$my_publish_novel_group->status}}</button>
                                                    @elseif($my_publish_novel_group->status == "심사중")
                                                        <button class="btn btn-warning">{{$my_publish_novel_group->status}}</button>
                                                    @elseif($my_publish_novel_group->status == "대기중")
                                                        <button class="btn btn-info">{{$my_publish_novel_group->status}}</button>
                                                    @else
                                                        <form
                                                                {{--action="{{route("publishnovelgroups.apply_each_company",['novel_group_publish_company_id'=>$each_company->pivot->id])}}"--}}
                                                                method="post"
                                                                v-on:submit.prevent="apply_company({{$my_publish_novel_group->id}})">
                                                            {{--<input name="_method" value="put" type="hidden">--}}
                                                            {{--{!! csrf_field() !!}--}}
                                                            <button class="btn btn-primary">신청하기</button>
                                                        </form>
                                                    @endif


                                                </td>
                                                <td class="col-md-1 text-center">{{$my_publish_novel_group->initial_novels}}
                                                    편
                                                </td>
                                                <td class="col-md-1 text-center">{{$my_publish_novel_group->days}}
                                                    일
                                                </td>
                                                <td class="col-md-1 text-center">{{$my_publish_novel_group->novels_per_days}}
                                                    회차
                                                </td>

                                                <td class="col-md-1 text-center">@if($my_publish_novel_group->event)수락@else거절@endif</td>

                                               <td class="col-md-1 text-center">{{$my_publish_novel_group->created_at}}</td>
                                                <td class="col-md-1 text-center">{{$my_publish_novel_group->updated_at}}</td>


                                            </tr>

                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>
    <script>
        var apply = new Vue({
            el: '#apply',
            methods: {
                reject_reason: function (reason) {
                    bootbox.alert({
                        title: "거절사유",
                        message: reason,
                        callback: function () {
                        }
                    });
                },
                apply_company: function (e) {
                    bootbox.dialog({
                        title: "제휴연재신청",
                        message: '<div class="row"> ' + '<div class="col-md-12"> ' +
                        '<form class="form-horizontal"> ' + '<div class="form-group"> ' +
                        '<label class="col-md-4 control-label" for="name">초기연재편수</label> ' +
                        '<div class="col-md-4"> ' +
                        '<input id="initial_inning" name="initial_inning" type="text" placeholder="ex) 1" class="form-control input-md"> ' +
                        '<span class="help-block"><small id="apply1" ></small></span> </div> ' +
                        '</div> ' +
                        '<div class="form-group"> ' +
                        '<label class="col-md-4 control-label" for="name">일(날짜)</label> ' +
                        '<div class="col-md-4"> ' +
                        '<input id="days" name="days" type="text" placeholder="ex) 2" class="form-control input-md"> ' +
                        '<span class="help-block"><small id="apply2" ></small></span> </div> ' +
                        '</div> ' +
                        '<div class="form-group"> ' +
                        '<label class="col-md-4 control-label" for="name">편수</label> ' +
                        '<div class="col-md-4"> ' +
                        '<input id="novels_per_days" name="novels_per_days" type="text" placeholder="ex) 3" class="form-control input-md"> ' +
                        '<span class="help-block"><small id="apply3" ></small></span> </div> ' +
                        '</div> ' +

                        '</div> </div>' + '</form> </div> </div>',
                        buttons: {
                            success: {
                                label: "Save",
                                className: "btn-purple",
                                callback: function () {
                                    var initial_inning = $('#initial_inning').val();
                                    var days = $('#days').val();
                                    var novels_per_days = $('#novels_per_days').val();
                                    console.log(initial_inning);
                                    console.log(days);
                                    console.log(novels_per_days);

                                    apply.$http.put("{{url('publishnovelgroups')}}/" + e, {
                                        "initial_inning": initial_inning,
                                        "days": days,
                                        "novels_per_days": novels_per_days
                                    }, {headers: {'X-CSRF-TOKEN': '{!! csrf_token() !!}'}})
                                            .then(function (response) {
                                                console.log(response);
                                                location.reload();
                                            })
                                            .catch(function (data, status, request) {
                                                console.log(data);
                                                apply.apply_company(e);
                                                $("#apply1").html(data.data.initial_inning);
                                                $("#apply2").html(data.data.days);
                                                $("#apply3").html(data.data.novels_per_days);
                                                $('#initial_inning').val(initial_inning);
                                                $('#days').val(days);
                                                $('#novels_per_days').val(novels_per_days);

                                            });


                                }
                            }
                        }
                    });


                },
            }
        })
    </script>


@endsection