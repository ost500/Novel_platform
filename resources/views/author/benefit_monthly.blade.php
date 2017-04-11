@extends('layouts.app')
@section('content')


    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml">

        <div id="page-title">
            <h1 class="page-header text-overflow">여우수익내역</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">작가홈</a></li>
            <li><a href="#">수익내역</a></li>
            <li class="active">여우수익내역</li>
        </ol>


        <div id="page-content">


            <div class="row">
                <div class="col-sm-12">

                    <div class="panel">
                        <div class="panel-body">
                            <div class="table-responsive" style="min-height:500px">
                                <div id="manage_apply">
                                    <a href="{{ route('author.benefit') }}">
                                        <button style="margin-bottom:5px" id="destroy" class="btn btn-primary">목록
                                        </button>
                                    </a>
                                    <table id="demo-foo-addrow"
                                           class="table table-bordered table-hover toggle-circle default footable-loaded footable"
                                           data-page-size="7">
                                        <thead>
                                        <tr>
                                            <th class="text-center">날짜</th>
                                            <th class="text-center">작가명</th>
                                            <th class="text-center">작품명</th>
                                            <th class="text-center">판매 수</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($myPurchasedNovel->isEmpty())
                                            <tr>
                                                <td colspan="4" class="col-md-1 text-center">데이터가 없습니다</td>
                                            </tr>
                                        @endif

                                        @foreach($myPurchasedNovel as $purchased)

                                            <tr>
                                                <td class="col-md-2 text-center">{{ $year.'-'.$month }}</td>
                                                <td class="col-md-2 text-center">{{ $purchased->novel_group_title }}</td>
                                                <td class="col-md-1 text-center">{{ $purchased->purchased_novel_count }}</td>
                                                <td class="col-md-1 text-center">{{ $purchased->purchased_novel_count*1000 }}</td>

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
                                   @include('pagination', ['collection' => $myPurchasedNovel, 'url' => route('author.benefit.monthly',['month'=>$year.'-'.$month ])])
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>

@endsection