@extends('layouts.app')
@section('content')


    <link href="/plugins/jquery-month-picker/MonthPicker.css" rel="stylesheet">
    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml">

        <div id="page-title">
            <h1 class="page-header text-overflow">퍼블리싱내역</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">작가홈</a></li>
            <li><a href="#">수익내역</a></li>
            <li class="active">퍼블리싱내역</li>
        </ol>


        <div id="page-content">


            <div class="row">
                <div class="col-sm-12">

                    <div class="panel">
                        <div class="panel-body">
                            <div class="table-responsive" style="min-height:500px">
                                <div class="pull-right">

                                    <select name="sort" class="form-control" onchange="location = this.value;">
                                        <option value="정렬">월별 정렬</option>
                                        <option value="{{ route('author.calculations_detail',['id' => 1]) }}">모든글
                                        </option>
                                        <option value="running">1월</option>
                                        <option value="completed">2월</option>
                                        <option value="secret">3월</option>
                                        <option value="secret">4월</option>
                                        <option value="secret">5월</option>
                                        <option value="secret">6월</option>
                                        <option value="secret">7월</option>
                                        <option value="secret">8월</option>
                                        <option value="secret">9월</option>
                                        <option value="secret">10월</option>
                                        <option value="secret">11월</option>
                                        <option value="secret">12월</option>
                                    </select>

                                </div>
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

                                        <div class="panel-heading">

                                            <h3 class="panel-title">{{ $calculationEach->description }} {{ $calculationEach->when }}</h3>

                                        </div>

                                        <table id="demo-foo-addrow"
                                               class="table table-bordered table-hover toggle-circle default footable-loaded footable"
                                               data-page-size="7">

                                            <thead>
                                            <tr>

                                                <th class="text-center">번호</th>

                                                <th class="text-center">정산 금액</th>

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

                                                    <td class="col-md-1 text-center">{{ $calculation->cal_number }}</td>
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


    <script>


    </script>


@endsection