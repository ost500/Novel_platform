@extends('layouts.app')
@section('content')


    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml">

        <div id="page-title">
            <h1 class="page-header text-overflow">정산내역</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">어드민</a></li>
            <li class="active">정산내역</li>
        </ol>


        <div id="page-content">


            <div class="row">
                <div class="col-sm-12">

                    <div class="panel">
                        <div class="panel-body">
                            <div class="table-responsive" style="min-height:500px">
                                <div id="manage_apply">
                                    <a href="{{ route('author.calculations') }}">
                                        <button style="margin-bottom:5px" id="destroy" class="btn btn-primary">목록
                                        </button>
                                    </a>
                                    @if($myPurchasedNovel->isEmpty())
                                        <table id="demo-foo-addrow"
                                               class="table table-bordered table-hover toggle-circle default footable-loaded footable"
                                               data-page-size="7">

                                            <thead>
                                            <tr>

                                                <th class="text-center">회차 제목</th>
                                                <th class="text-center">소설 제목</th>
                                                <th class="text-center">유저명</th>
                                                <th class="text-center">결제 방식</th>


                                            </tr>
                                            </thead>
                                            <tbody>


                                            <tr>

                                                <td colspan="4" class="col-md-1 text-center">데이터가 없습니다</td>


                                            </tr>


                                            </tbody>
                                        </table>
                                    @endif


                                    <table id="demo-foo-addrow"
                                           class="table table-bordered table-hover toggle-circle default footable-loaded footable"
                                           data-page-size="7">

                                        <thead>
                                        <tr>



                                            <th class="text-center">회차 제목</th>
                                            <th class="text-center">소설 제목</th>
                                            <th class="text-center">유저명</th>
                                            <th class="text-center">결제 방식</th>


                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($myPurchasedNovel as $purchased)

                                            <tr>


                                                <td class="col-md-2 text-center">{{ $purchased->n_title }}</td>
                                                <td class="col-md-2 text-center">{{ $purchased->ng_title }}</td>
                                                <td class="col-md-1 text-center">{{ $purchased->name }}</td>
                                                <td class="col-md-1 text-center">{{ $purchased->method }}</td>



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
                                    @include('pagination', ['collection' => $myPurchasedNovel, 'url' => route('author.benefit')])
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>

@endsection