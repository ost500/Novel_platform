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
                                    @if($myCalculationEachs->isEmpty())
                                        <table id="demo-foo-addrow"
                                               class="table table-bordered table-hover toggle-circle default footable-loaded footable"
                                               data-page-size="7">

                                            <thead>
                                            <tr>

                                                <th class="text-center">번호</th>

                                                <th class="text-center">코드번호</th>


                                                <th class="text-center">기타</th>

                                            </tr>
                                            </thead>
                                            <tbody>



                                                <tr>

                                                    <td colspan="3" class="col-md-1 text-center">데이터가 없습니다</td>


                                                </tr>


                                            </tbody>
                                        </table>
                                    @endif

                                    @foreach($myCalculationEachs as $calculationEach)
                                        <table id="demo-foo-addrow"
                                               class="table table-bordered table-hover toggle-circle default footable-loaded footable"
                                               data-page-size="7">

                                            <thead>
                                            <tr>

                                                <th class="text-center">번호</th>

                                                <th class="text-center">코드번호</th>

                                                @if($calculationEach)
                                                    @foreach (explode(",", $calculationEach->column_names) as $col)
                                                        <th>{{ $col }}</th>
                                                    @endforeach
                                                @endif

                                                <th class="text-center">기타</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($calculationEach->calculation_eaches as $calculation)

                                                <tr>

                                                    <td class="col-md-1 text-center">{{ $calculation->id }}</td>

                                                    <td class="col-md-1 text-center">{{ $calculation->code_number }}</td>
                                                    @foreach (explode(",", $calculation->data) as $data)

                                                        <td class="col-md-1">{{ $data }}</td>

                                                    @endforeach
                                                    <td class="col-md-2">{{ $calculation->extra_data }}</td>

                                                </tr>


                                            @endforeach

                                            </tbody>
                                        </table>
                                    @endforeach
                                </div>

                            </div>
                            {{-- <div id="response"></div>--}}
                            <div class="fixed-table-pagination" style="display: block;">
                                <div class="pull-left">
                                    {{-- <button class="btn btn-danger">선택삭제</button>--}}
                                </div>

                                <div class="pull-right">
                                    @include('pagination', ['collection' => $myCalculationEachs, 'url' => route('author.calculations_detail', ['codenum' => $code_num])])
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>

@endsection