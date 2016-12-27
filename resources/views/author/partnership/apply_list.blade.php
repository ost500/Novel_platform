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
                                        <th class="">작품명</th>
                                        <th class="">업체명</th>
                                        <th class="text-center">초기연재회차</th>
                                        <th class="text-center">일연재회차</th>
                                        <th class="text-center">신청일</th>
                                        <th class="text-center">처리일</th>
                                        <th class="text-center">상태</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td class="col-md-2">작품명1</td>
                                        <td class="col-md-3">업체명1</td>
                                        <td class="col-md-1 text-center">20회차</td>
                                        <td class="col-md-1 text-center">2회차</td>
                                        <td class="col-md-2 text-center">2016-12-20 11:00:12</td>
                                        <td class="col-md-2 text-center">2016-12-20 11:00:12</td>
                                        <td class="text-center">
                                            <button class="btn btn-warning">승인대기</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="col-md-2">작품명1</td>
                                        <td class="col-md-3">업체명1</td>
                                        <td class="col-md-1 text-center">20회차</td>
                                        <td class="col-md-1 text-center">2회차</td>
                                        <td class="col-md-2 text-center">2016-12-20 11:00:12</td>
                                        <td class="col-md-2 text-center">2016-12-20 11:00:12</td>
                                        <td class="text-center">
                                            <button class="btn btn-success">승인완료</button>
                                        </td>
                                    </tr>
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