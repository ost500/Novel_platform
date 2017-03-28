@extends('layouts.admin_layout')

@section('content')
        <!--Bootstrap Tags Input [ OPTIONAL ]-->
<link href="/plugins/bootstrap-datepicker/bootstrap-datepicker.css" rel="stylesheet">
<link href="/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
<div id="content-container">

    <div id="page-title">
        <h1 class="page-header text-overflow">정산 수정</h1>
    </div>


    <ol class="breadcrumb">
        <li><a href="#">공지사항 관리</a></li>
        <li class="active"><a href="#">공지사항 수정</a></li>

    </ol>


    <div id="page-content">

        <div class="row">
            <div class="col-sm-12">

                <div class="panel">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="panel-body form-horizontal form-padding"
                          action="{{route('calculation.update', ['id' => $calculation->id])}}"
                          method="post" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <input name="_method" type="hidden" value="PUT">
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="demo-email-input">날짜</label>
                            <div class="col-md-2">
                                <div id="demo-dp-txtinput">
                                    <input id="date_input" name="date" type="text" class="form-control" value="{{$calculation->when}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="demo-email-input">컬럼 시작 인덱스</label>

                            <div class="col-md-1">
                                <input type="text" name="columnX" id="demo-email-input" class="form-control"
                                       placeholder="ex) A,B,C..." data-bv-field="title"
                                       value="{{$calculation->columnX}}">
                            </div>

                            <div class="col-md-1">
                                <input type="text" name="columnY" id="demo-email-input" class="form-control"
                                       placeholder="ex) 1,2,3..." data-bv-field="title"
                                       value="{{$calculation->columnY}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="demo-email-input">데이터 시작 인덱스</label>

                            <div class="col-md-1">
                                <input type="text" name="dataX" id="demo-email-input" class="form-control"
                                       placeholder="ex) A,B,C..." data-bv-field="title" value="{{$calculation->dataX}}">
                            </div>

                            <div class="col-md-1">
                                <input type="text" name="dataY" id="demo-email-input" class="form-control"
                                       placeholder="ex) 1,2,3..." data-bv-field="title" value="{{$calculation->dataY}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="demo-email-input">코드 번호 인덱스</label>

                            <div class="col-md-1">
                                <input type="text" name="code_numberX" id="demo-email-input" class="form-control"
                                       placeholder="ex) A,B,C..." data-bv-field="title"
                                       value="{{$calculation->code_numberX}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="demo-email-input">정산 금액 인덱스</label>

                            <div class="col-md-1">
                                <input type="text" name="cal_numberX" id="demo-email-input" class="form-control"
                                       placeholder="ex) A,B,C..." data-bv-field="title"
                                       value="{{$calculation->cal_numberX}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="demo-email-input">컬럼명</label>

                            <div class="col-md-9">
                                <input type="text" name="columnNames" class="form-control"
                                       placeholder="입력하고자 하는 컬럼명을 순서대로 입력하세요"
                                       value="{{$calculation->column_names}}" data-role="tagsinput">

                            </div>


                        </div>


                        <div class="form-group">
                            <label class="col-md-2 control-label" for="demo-textarea-input">내용</label>

                            <div class="col-md-9">
                                    <textarea name="description" id="demo-textarea-input" rows="9" class="form-control"
                                              placeholder="ex) 교보 9월"> {{$calculation->description}} </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="demo-textarea-input">엑셀파일</label>
                            <div class="col-md-9"  style=" margin: 0 0 5px 0;width: 15%">{{$calculation->excel_file}} </div>
                            <div class="col-md-9">
                                <span  style=" margin: 0 0 5px 0;width: 15%"> </span>
                                <input type="file" name="excel" id="picture" class="form-control"
                                       placeholder="첨부파일">

                                <small class="has-warning">업로드 가능 확장자 : .xlsx 파일</small>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-lg btn-primary">정산 수정</button>
                                <button class="btn btn-lg btn-danger">취소</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>
<!--Bootstrap Tags Input [ OPTIONAL ]-->
<script src="/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script>
    $('#demo-dp-txtinput input').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",

    }).on("changeDate", function (e) {
        console.log(e);
        $("#date_input").val(e.format());
    });


</script>
@endsection