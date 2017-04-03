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


                                    <table id="demo-foo-addrow"
                                           class="table table-bordered table-hover toggle-circle default footable-loaded footable"
                                           data-page-size="7">

                                        <thead>
                                        <tr>

                                            <th class="text-center">번호</th>

                                            <th class="text-center">코드번호</th>
                                            <th class="text-center">작품명</th>
                                            <th class="text-center">퍼블리싱</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($myNovelGroups as $novelGroup)

                                            <tr>
                                                <a href="#">
                                                    <td class="col-md-1 text-center">{{ $novelGroup->id }}</td>

                                                    <td class="col-md-1 text-center">{{ $novelGroup->code_number }}</td>
                                                    <td class="col-md-2 text-center"><a
                                                                href="{{ route('author.calculations_detail', ['id' => $novelGroup->code_number]) }}">{{ $novelGroup->title }}</a>
                                                    </td>
                                                    <td class="col-md-1 text-center">{{ $novelGroup->calculation_eaches_count }}
                                                    </td>
                                                </a>
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
                                    @include('pagination', ['collection' => $myNovelGroups, 'url' => route('author.benefit')])
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>

@endsection