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
                                        <th class="text-center">네이버</th>
                                        <th class="text-center">카카오</th>
                                        <th class="text-center">예스24</th>
                                        <th class="text-center">교보</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td class="col-md-2">작품명1</td>
                                        <td class="col-md-1 text-center">1일</td>
                                        <td class="col-md-1 text-center">2회차</td>
                                        <td class="col-md-2 text-center">
                                            <button class="btn btn-primary">신청하기</button>
                                        </td>
                                        <td class="col-md-2 text-center">
                                            <button class="btn btn-warning">대기 중</button>
                                        </td>
                                        <td class="col-md-2 text-center">
                                            <button class="btn btn-danger">승인</button>
                                        </td>
                                        <td class="col-md-2 text-center">
                                            <button class="btn btn-purple">심사 중</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="col-md-2">작품명1</td>
                                        <td class="col-md-1 text-center">1일</td>
                                        <td class="col-md-1 text-center">2회차</td>
                                        <td class="col-md-2 text-center">
                                            <button class="btn btn-primary">신청하기</button>
                                        </td>
                                        <td class="col-md-2 text-center">
                                            <button class="btn btn-warning">대기 중</button>
                                        </td>
                                        <td class="col-md-2 text-center">
                                            <button class="btn btn-danger">승인</button>
                                        </td>
                                        <td class="col-md-2 text-center">
                                            <button class="btn btn-purple">심사 중</button>
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