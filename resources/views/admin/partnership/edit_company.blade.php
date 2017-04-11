@extends('layouts.admin_layout')
@section('content')
    <div id="content-container">

        <div id="page-title">
            <h1 class="page-header text-overflow">업체 수정</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">어드민</a></li>
            <li><a href="#">제휴업체관리</a></li>
            <li class="active"><a href="#">업체 수정</a></li>
        </ol>


        <div id="page-content">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="panel panel-default panel-left">
                <div class="panel-body">

                    <form role="form" class="form-horizontal"
                          action="{{route('companies.update',['id'=>$company->id])}}" method="post"
                          enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <input name="_method" type="hidden" value="PUT">

                        <div class="form-group">
                            <label class="col-lg-1 control-label text-left" for="name">업체명</label>

                            <div class="col-lg-11">
                                <input type="text" id="name" name="name" class="form-control" value="{{$company->name}}"
                                       placeholder="업체명">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-1 control-label text-left" for="description">업체소개</label>

                            <div class="col-lg-11">
                                <textarea type="text" id="description" name="description" rows="10" class="form-control"
                                          placeholder="작품소개">{{$company->description}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-1 control-label text-left" for="company_picture">이미지</label>

                            <div class="col-lg-1">
                                @if($company->company_picture)
                                    <img id="company_pic_preview"
                                         src="/img/company_pictures/{{$company->company_picture}}" width="100">
                                @else
                                    <img id="company_pic_preview" src="/img/novel_covers/default_.jpg" width="100">
                                @endif
                            </div>
                            <div class="col-lg-10">
                                <input type="file" id="company_picture" name="company_picture" class="form-control"
                                       placeholder="이미지">
                                <small class="has-warning">최대용량 : 1M / 업로드 가능 확장자 : JPG, PNG 파일</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-1 control-label text-left" for="initial_inning">초기연재회차
                            </label>

                            <div class="col-lg-11">
                                <input type="text" id="initial_inning" name="initial_inning" class="form-control"
                                       value="{{$company->initial_inning}}"
                                       placeholder="수수료">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-1 control-label text-left" for="adult">성인물 허가</label>

                            <div class="col-lg-11 ">

                                <label class="form-checkbox form-icon">
                                    <input type="checkbox" id="adult_allowance" name="adult"
                                           @if($company->adult_allowance)) checked @endif>
                                </label>

                            </div>
                        </div>

                        <div id="demo-mail-compose"></div>

                        <div class="text-center">
                            <button id="mail-send-btn" type="submit" class="btn btn-primary btn-labeled">
                                <span class="btn-label"><i class="fa fa-paper-plane"></i></span> 등록하기
                            </button>
                            <a href="{{route('admin.partner_manage_company')}}">
                                <button type="button" class="btn btn-danger">취소</button>
                            </a>
                        </div>


                    </form>
                </div>
            </div>


        </div>


    </div>
    <script type="text/javascript">

        function readURL(input) {

            if (input.files && input.files[0]) {

                var reader = new FileReader();
                reader.onload = function (e) {

                    $('#company_pic_preview').attr('src', e.target.result);

                }

                reader.readAsDataURL(input.files[0]);

            }

        }

        $("#company_picture").change(function () {

            readURL(this);

        });

    </script>s
@endsection
