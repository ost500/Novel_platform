@extends('layouts.admin_layout')
@section('content')


    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml">

        <div id="page-title">
            <h1 class="page-header text-overflow">신고 리스트</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">어드민</a></li>
            <li><a href="#">신고 관리</a></li>
            <li class="active">신고 리스트</li>
        </ol>


        <div id="page-content">


            <div class="row">
                <div class="col-sm-12">

                    <div class="panel">
                        <div class="panel-body">
                            <div class="table-responsive" style="min-height:500px">
                                <div id="manage_apply">

                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-center">순서</th>
                                            <th class="text-center">분류</th>
                                            <th class="text-center">제목</th>

                                            <th class="text-center">등록일</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($accus as $accu)
                                            <tr>
                                                <td class="col-md-1 text-center">{{$accu->id}}</td>
                                                <td class="col-md-2 text-center">{{$accu->category}}</td>
                                                <td class="col-md-3">
                                                    <a href="{{ route('admin.accusations.detail', ['id' => $accu->id]) }}">{{$accu->title}}</a>
                                                </td>

                                                <td class="col-md-2 text-center">{{$accu->created_at}}
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
                                    @include('pagination', ['collection' => $accus, 'url' => route('admin.accusations')])

                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>



@endsection