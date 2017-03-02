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
                                    <button style="margin-bottom:5px" id="destroy" class="btn btn-danger">체크 삭제
                                    </button>

                                    <table id="demo-foo-addrow"
                                           class="table table-bordered table-hover toggle-circle default footable-loaded footable"
                                           data-page-size="7">

                                        <thead>
                                        <tr>
                                            <th data-sort-ignore="true"
                                                class="min-width footable-visible footable-first-column"></th>
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
                                                <td class="text-center bs-checkbox"><label
                                                            class="form-checkbox form-icon"><input id="checkboxes"
                                                                                                   data-index="3"
                                                                                                   name="btSelectItem"
                                                                                                   type="checkbox"
                                                                                                   value="{{$cal->id}}"></label>
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
    <script>
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
                            url: '{{ route('calculation.destroy') }}',
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
    </script>
@endsection