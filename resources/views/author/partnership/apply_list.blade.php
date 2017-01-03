@extends('layouts.app')
@section('content')
    <div id="apply" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div id="content-container">

            <div id="page-title">
                <h1 class="page-header text-overflow">연재신청내역</h1>
            </div>


            <ol class="breadcrumb">
                <li><a href="#">작가홈</a></li>
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
                                                        href="{{route('author.partner_apply_list')."?order=1"}}">작품명  <i class="fa fa-sort" aria-hidden="true"></i></a>
                                            </th>
                                            <th class="text-center"><a
                                                        href="{{route('author.partner_apply_list')."?order=2"}}">업체명  <i class="fa fa-sort" aria-hidden="true"></i></a>
                                            </th>
                                            <th class="text-center"><a
                                                        href="{{route('author.partner_apply_list')."?order=3"}}">상태  <i class="fa fa-sort" aria-hidden="true"></i></a>
                                            </th>
                                            <th class="text-center">초기 연재 회차</th>
                                            <th class="text-center">일</th>
                                            <th class="text-center">편수</th>
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
                                                            <button class="btn btn-primary">{{$my_publish_novel_group->status}}</button>
                                                        @elseif($my_publish_novel_group->status == "심사중")
                                                            {{$my_publish_novel_group->status}}
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
                                                    <td class="col-md-1 text-center">{{$my_publish_novel_group->companies->initial_inning}}
                                                        편
                                                    </td>
                                                    <td class="col-md-1 text-center">{{$my_publish_novel_group->days}}
                                                        일
                                                    </td>
                                                    <td class="col-md-1 text-center">{{$my_publish_novel_group->novels_per_days}}
                                                        회차
                                                    </td>
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
                    bootbox.confirm({
                        message: "비밀을 해제 하시겠습니까?",

                        buttons: {
                            confirm: {
                                label: "비밀 해제"
                            },
                            cancel: {
                                label: '취소'
                            }
                        },

                        callback: function (result) {

                            if (result) {
                                {{--Vue.http.headers.common['X-CSRF-TOKEN'] = "{!! csrf_token() !!}";--}}
                                //                    var csrfToken = form.querySelector('input[name="_token"]').value;

                                apply.$http.put("{{url('publishnovelgroups')}}/" + e, "", {headers: {'X-CSRF-TOKEN': '{!! csrf_token() !!}'}})
                                        .then(function (response) {
                                            location.reload();

                                        })
                                        .catch(function (data, status, request) {
                                            var errors = data.data;
                                            this.formErrors = errors;
                                        });

                            }

                        }
                    });
                },
            }
        })
    </script>


@endsection