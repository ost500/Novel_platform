@extends('layouts.admin_layout')

@section('content')
    <div id="content-container">

        <div id="page-title">
            <h1 class="page-header text-overflow">키워드</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">작가홈</a></li>
            <li><a href="#">작품관리</a></li>
            <li class="active">키워드</li>
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

                        <form class="panel-body form-horizontal form-padding" action="{{route('keywords.store')}}"
                              method="post">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-email-input">범주</label>

                                <div class="col-md-9">
                                    <select class="form-control" name="category">
                                        <option value="">범주선택</option>
                                        <option value="1" {{ old('category')=='1' ? "selected":"" }}>장르</option>
                                        <option value="2" {{ old('category')=='2' ? "selected":"" }}>배경</option>
                                        <option value="3" {{ old('category')=='3' ? "selected":"" }} >소재</option>
                                        <option value="4" {{ old('category')=='4' ? "selected":"" }} >관계</option>
                                        <option value="5" {{ old('category')=='5' ? "selected":"" }} >남주인공</option>
                                        <option value="6" {{ old('category')=='6' ? "selected":"" }} >여주인공</option>
                                        <option value="7" {{ old('category')=='7' ? "selected":"" }} >분위기/기타</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-email-input">작품제목</label>

                                <div class="col-md-9">
                                    <input type="text" name="name" id="demo-email-input" class="form-control"
                                           value="{{old('name')}}" placeholder="작품 제목을 입력해 주세요." data-bv-field="title">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-lg btn-primary">작품저장</button>
                                    <button class="btn btn-lg btn-danger">취소</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection