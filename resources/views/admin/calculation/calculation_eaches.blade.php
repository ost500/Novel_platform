@extends('layouts.admin_layout')
@section('content')

    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <link href="/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
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

                            <div class="table-responsive" style="min-height: 0px">
                                <div style="margin-top:10px" class="pull-left">
                                    <a href="{{ route('calculation') }}">
                                        <button id="cancel_mail" class="btn btn-primary">목록</button>
                                    </a>
                                    <a href="{{ route('calculation.eaches.run', ['id' => $calculation->id]) }}">
                                        <button id="cancel_mail" class="btn btn-danger">정산 실행</button>
                                    </a>

                                </div>

                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>

                                        <th class="text-center">번호</th>
                                        <th>내용</th>
                                        <th class="text-center">엑셀파일 경로</th>
                                        <th class="text-center">등록 날짜</th>
                                        <th class="text-center">컬럼 인덱스</th>
                                        <th class="text-center">데이터 인덱스</th>
                                        <th class="text-center">코드 번호 인덱스</th>
                                        <th class="text-center">수정</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>

                                        <td class="col-md-1 text-center">{{ $calculation->id }}</td>
                                        <td class="col-md-2"><a
                                                    href="{{ route('calculation.eaches', ['id' => $calculation->id]) }}">{{ $calculation->description }}</a>
                                        </td>
                                        <td class="col-md-1 text-center">{{ $calculation->excel_file }}</td>
                                        <td class="col-md-1 text-center">{{ $calculation->created_at }}
                                        </td>
                                        <td class="col-md-1">
                                            <div class="row">
                                                <div id="columnXerror" class="col-md-6">
                                                    <input id="columnX" style="text-align: center" type="text"
                                                           placeholder=".col-sm-3" class="form-control"
                                                           value="{{ $calculation->columnX }}">
                                                </div>
                                                <div id="columnYerror" class="col-md-6">
                                                    <input id="columnY" style="text-align: center" type="text"
                                                           placeholder=".col-sm-3" class="form-control"
                                                           value="{{ $calculation->columnY }}">
                                                </div>
                                            </div>
                                        </td>
                                        {{--<td class="col-md-1 text-center">{{ $calculation->columnX.",". $calculation->columnY }}--}}
                                        {{--</td>--}}

                                        <td class="col-md-1">
                                            <div class="row">
                                                <div id="dataXerror" class="col-md-6">
                                                    <input id="dataX" style="text-align: center" type="text"
                                                           placeholder=".col-sm-3" class="form-control"
                                                           value="{{ $calculation->dataX }}">
                                                </div>
                                                <div id="dataYerror" class="col-md-6">
                                                    <input id="dataY" style="text-align: center" type="text"
                                                           placeholder=".col-sm-3" class="form-control"
                                                           value="{{ $calculation->dataY }}">
                                                </div>
                                            </div>
                                        </td>

                                        <td class="col-md-1">
                                            <div class="row">

                                                <div id="dataYerror" class="col-md-12">
                                                    <input id="code_numberX" style="text-align: center" type="text"
                                                           placeholder=".col-sm-3" class="form-control"
                                                           value="{{ $calculation->code_numberX }}">
                                                </div>
                                            </div>
                                        </td>

                                        {{--<td class="col-md-1 text-center">{{ $calculation->dataX.",". $calculation->dataY }}--}}
                                        {{--</td>--}}
                                        <td class="col-md-1  text-center">
                                            <button id="updateXY" class="btn btn-warning">수정</button>
                                        </td>


                                    </tr>
                                    </tbody>
                                </table>

                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-center">컬럼명</th>
                                        <th class="text-center">수정</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>

                                        <td id="columnNamesError" class="col-md-3">


                                            <input id="columnNames" type="text" name="columnNames"
                                                   class="form-control"
                                                   placeholder="Add a tag" value="{{ $calculation->column_names }}"
                                                   data-role="tagsinput">
                                            <div id="columnNamesMessageError" hidden>
                                                <small class="help-block"
                                                       data-bv-validator="notEmpty" data-bv-for="columnNames"
                                                       data-bv-result="INVALID" style="">
                                                    <div id="columnNamesMessageErrorSmall">

                                                    </div>
                                                </small>
                                            </div>
                                            <h5>※ 순서에 유의하세요</h5>
                                        </td>
                                        <td class="col-md-1 text-center">

                                            <button id="updateColumnNames" class="btn btn-warning">수정</button>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="form-group">


                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-body">


                            <div class="table-responsive" style="min-height:500px">
                                <div id="manage_apply">
                                    <a>
                                        <button style="margin-bottom:5px" id="destroy" class="btn btn-danger">체크 내용 삭제
                                        </button>
                                    </a>
                                    <a href="{{ route('calculation.eaches.cancel', ['id' => $calculation->id]) }}">
                                        <button style="margin-bottom:5px" id="cancel_mail" class="btn btn-danger">정산 내용
                                            전체 삭제
                                        </button>
                                    </a>

                                    <table id="demo-foo-addrow"
                                           class="table table-bordered table-hover toggle-circle default footable-loaded footable"
                                           data-page-size="7">
                                        <thead>
                                        <tr>
                                            <th data-sort-ignore="true"
                                                class="min-width footable-visible footable-first-column"></th>
                                            <th class="min-width text-center">번호</th>
                                            <th class="min-width text-center">코드번호</th>
                                            @foreach ($calculationColumnNames as $col)
                                                <th>{{ $col }}</th>
                                            @endforeach

                                            <th class="text-center">기타</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($calEaches as $cal)
                                            <tr>
                                                <td class="text-center bs-checkbox"><label
                                                            class="form-checkbox form-icon"><input id="checkboxes"
                                                                                                   data-index="3"
                                                                                                   name="btSelectItem"
                                                                                                   type="checkbox"
                                                                                                   value="{{$cal->id}}"></label>
                                                </td>
                                                <td class="text-center">{{ $cal->id }}</td>
                                                <td class="text-center">{{ $cal->code_number }}
                                                </td>
                                                @foreach (explode(",", $cal->data) as $data)

                                                    <td class="col-md-1">{{ $data }}</td>

                                                @endforeach

                                                <td class="col-md-2">{{ $cal->extra_data }}</td>
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
                                    {{--                                    @include('pagination', ['collection' => $cals, 'url' => route('calculation')])--}}
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>


    <script>
        // function destroySelected() {
        $("#destroy").click(function () {

            bootbox.confirm({
                message: "삭제 하시겠습니까?",
                buttons: {
                    confirm: {
                        label: "삭제"
                    },
                    cancel: {
                        label: '취소'
                    }
                },
                callback: function (result) {
                    if (result) {

                        var checked_data = $("#checkboxes:checked").map(function () {
                            return this.value;
                        }).get();

                        console.log(checked_data);

                        $.ajax({
                            type: 'DELETE',
                            data: {'ids': checked_data},
                            url: '{{ route('calculation.eaches.destroy') }}',
                            headers: {
                                'X-CSRF-TOKEN': window.Laravel.csrfToken
                            },
                            success: function (response) {
//                                console.log(response);
                                location.reload();
                                /* $.niftyNoty({
                                 type: 'warning',
                                 icon: 'fa fa-check',
                                 message: "삭제 되었습니다.",
                                 container: 'page',
                                 timer: 4000
                                 });*/
                            },
                            error: function (data2) {
                                console.log(data2);
                            }
                        });

                    }
                }
            })
        });

        $("#updateXY").click(function () {

            bootbox.confirm({
                message: "인덱스를 수정 하시겠습니까?",
                buttons: {
                    confirm: {
                        label: "수정"
                    },
                    cancel: {
                        label: '취소'
                    }
                },
                callback: function (result) {
                    if (result) {

                        var dataXY = {
                            'columnX': $("#columnX").val(),
                            'columnY': $("#columnY").val(),
                            'dataX': $("#dataX").val(),
                            'dataY': $("#dataY").val(),
                            'code_numberX': $("#code_numberX").val()
                        };

                        console.log(dataXY);

                        $.ajax({
                            type: 'PUT',
                            data: dataXY,
                            url: '{{ route('calculation.updateXY', ['id' => $calculation->id]) }}',
                            headers: {
                                'X-CSRF-TOKEN': window.Laravel.csrfToken
                            },
                            success: function (response) {
//                                console.log(response);

                                location.reload();
                                /* $.niftyNoty({
                                 type: 'warning',
                                 icon: 'fa fa-check',
                                 message: "삭제 되었습니다.",
                                 container: 'page',
                                 timer: 4000
                                 });*/
                            },
                            error: function (data2) {
                                $("#columnXerror").addClass('has-error');
                                $("#columnYerror").addClass('has-error');
                                $("#dataXerror").addClass('has-error');
                                $("#dataYerror").addClass('has-error');
                                $("#code_numberX").addClass('has-error');
                                console.log(data2);
                            }
                        });

                    }
                }
            })
        });
        $("#updateColumnNames").click(function () {

            bootbox.confirm({
                message: "컬럼 명들을 수정 하시겠습니까?",
                buttons: {
                    confirm: {
                        label: "수정"
                    },
                    cancel: {
                        label: '취소'
                    }
                },
                callback: function (result) {
                    if (result) {

                        var columnNames = {
                            'columnNames': $("#columnNames").val(),

                        };

                        console.log(columnNames);

                        $.ajax({
                            type: 'PUT',
                            data: columnNames,
                            url: '{{ route('calculation.update_column_names', ['id' => $calculation->id]) }}',
                            headers: {
                                'X-CSRF-TOKEN': window.Laravel.csrfToken
                            },
                            success: function (response) {
//                                console.log(response);
                                location.reload();

                                /* $.niftyNoty({
                                 type: 'warning',
                                 icon: 'fa fa-check',
                                 message: "삭제 되었습니다.",
                                 container: 'page',
                                 timer: 4000
                                 });*/
                            },
                            error: function (data2) {
                                console.log(data2);
                                $("#columnNamesError").addClass('has-error');
                                $("#columnNamesMessageError").show();
                                $("#columnNamesMessageErrorSmall").html(data2.responseJSON.columnNames);
                            }
                        });

                    }
                }
            })
        });
    </script>
    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <script src="/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
@endsection