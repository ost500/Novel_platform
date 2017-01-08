@extends('layouts.admin_layout')
@section('content')
    <div id="content-container">

        <div id="page-title">
            <h1 class="page-header text-overflow">제휴업체관리</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">어드민</a></li>
            <li class="active"><a href="#">제휴업체관리</a></li>
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

                    <form role="form" class="form-horizontal" action="{{route('companies.update',['id'=>$company->id])}}" method="post"  enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <input name="_method" type="hidden" value="PUT">
                        <div class="form-group">
                            <label class="col-lg-1 control-label text-left" for="name">업체명</label>

                            <div class="col-lg-11">
                                <input type="text" id="name" name="name" class="form-control" value="{{$company->name}}" placeholder="업체명">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-1 control-label text-left" for="company_picture">이미지</label>

                            <div class="col-lg-1">
                                @if($company->company_picture)
                                 <img   src="/img/company_pictures/{{$company->company_picture}}" width="100">
                                @else
                                  <img  src="/img/novel_covers/default_.jpg" width="100">
                                @endif
                            </div>
                            <div class="col-lg-10">
                                <input type="file" id="company_picture" name="company_picture" class="form-control" placeholder="이미지">
                                <small class="has-warning">최대용량 : 1M / 업로드 가능 확장자 : JPG, PNG 파일</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-1 control-label text-left" for="test">수수료</label>

                            <div class="col-lg-11">
                                <input type="text" id="test" name="test" class="form-control" value="{{old('test')}}"
                                       placeholder="수수료">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-1 control-label text-left" for="initial_inning">오상택
                                초기연재회차
                            </label>

                            <div class="col-lg-11">
                                <input type="text" id="initial_inning" name="initial_inning" class="form-control" value="{{$company->initial_inning}}"
                                       placeholder="수수료">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-1 control-label text-left" for="adult">성인물 허가</label>

                            <div class="col-lg-11">

                                <input type="checkbox" id="adult_allowance" name="adult"  @if($company->adult_allowance)) checked  @endif>

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
@endsection
