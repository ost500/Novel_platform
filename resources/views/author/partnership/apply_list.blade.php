@extends('layouts.app')
@section('content')

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
                                                    @if($each_company->pivot->status == "대기중")
                                                        @php $status = "btn-warning" @endphp
                                                    @elseif($each_company->pivot->status == "신청하기")
                                                        @php $status = "btn-primary" @endphp
                                                    @elseif($each_company->pivot->status == "승인")
                                                        @php $status = "btn-danger" @endphp
                                                    @elseif($each_company->pivot->status == "심사중")
                                                        @php $status = "btn-purple" @endphp
                                                    @endif
                                                    <button class="btn {{ $status }}">{{$each_company->pivot->status}}</button>


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


@endsection