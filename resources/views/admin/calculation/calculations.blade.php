@extends('layouts.admin_layout')
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


                                    <table class="table table-striped table-hover">

                                        <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                            <th class="text-center">번호</th>
                                            <th>내용</th>
                                            <th class="text-center">엑셀파일 경로</th>
                                            <th class="text-center">등록 날짜</th>
                                            <th class="text-center">컬럼 인덱스</th>
                                            <th class="text-center">데이터 인덱스</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cals as $cal)
                                            <tr>
                                                <td class="col-md-1 text-center">
                                                    <label class="form-checkbox form-normal form-primary form-text"><input type="checkbox"></label>
                                                </td>
                                                <td class="col-md-1 text-center">{{ $cal->id }}</td>
                                                <td class="col-md-2"><a
                                                            href="{{ route('calculation.eaches', ['id' => $cal->id]) }}">{{ $cal->description }}</a>
                                                </td>
                                                <td class="col-md-2 text-center">{{ $cal->excel_file }}</td>
                                                <td class="col-md-2 text-center">{{ $cal->created_at }}
                                                </td>
                                                <td class="col-md-2 text-center">{{ $cal->columnX.",". $cal->columnY }}
                                                </td>
                                                <td class="col-md-2 text-center">{{ $cal->dataX.",". $cal->dataY }}
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
                                    @include('pagination', ['collection' => $cals, 'url' => route('calculation')])
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>
@endsection