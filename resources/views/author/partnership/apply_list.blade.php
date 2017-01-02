@extends('layouts.app')
@section('content')
    <div id="apply">
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
                                            <th>작품명</th>
                                            <th class="text-center">일</th>
                                            <th class="text-center">편수</th>
                                            @foreach($companies as $company)
                                                <th class="text-center">{{ $company->name }}</th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($my_publish_novel_groups as $my_publish_novel_group)
                                            <tr>
                                                <td class="col-md-2">{{$my_publish_novel_group->novel_groups->title}}</td>
                                                <td class="col-md-1 text-center">{{$my_publish_novel_group->days}}
                                                    일
                                                </td>
                                                <td class="col-md-1 text-center">{{$my_publish_novel_group->novels_per_days}}
                                                    회차
                                                </td>
                                                @foreach($my_publish_novel_group->companies as $each_company)
                                                    <td class="col-md-2 text-center">
                                                        @if($each_company->pivot->status == "거절")
                                                            {{$each_company->pivot->status}}

                                                        @elseif($each_company->pivot->status == "승인")
                                                            {{$each_company->pivot->status}}
                                                        @elseif($each_company->pivot->status == "심사중")
                                                            {{$each_company->pivot->status}}
                                                        @else
                                                            <form
                                                                    {{--action="{{route("publishnovelgroups.apply_each_company",['novel_group_publish_company_id'=>$each_company->pivot->id])}}"--}}
                                                                    method="post"
                                                                    v-on:submit.prevent="apply_company({{$each_company->pivot->id}})">
                                                                {{--<input name="_method" value="put" type="hidden">--}}
                                                                {{--{!! csrf_field() !!}--}}
                                                                <button class="btn btn-primary">신청하기</button>
                                                            </form>
                                                        @endif


                                                    </td>
                                                @endforeach


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