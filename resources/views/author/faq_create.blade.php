@extends('layouts.app')

@section('content')
    <div id="content-container">

        <div id="page-title">
            <h1 class="page-header text-overflow">등록 자주 묻는 질문 (FAQ)</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">작가홈</a></li>
            <li><a href="#">작품관리</a></li>
            <li class="active">등록 자주 묻는 질문</li>
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

                        <form class="panel-body form-horizontal form-padding"  action="{{route('faqs.store')}}"  method="post"  >
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-email-input">자주 묻는 질문 범주</label>
                            <div class="col-md-9">
                                <select class="form-control" name="faq_category">
                                    <option value="">범주선택</option>
                                    <option value="1"> 독자 </option>
                                    <option value="2">작가 </option>
                                    <option value="3"> 기타 </option>

                                </select>
                            </div>
                                </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-email-input">작품제목</label>
                                <div class="col-md-9">
                                    <input type="text" name="title" id="demo-email-input" class="form-control" placeholder="작품 제목을 입력해 주세요." data-bv-field="title">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-textarea-input">작품소개</label>
                                <div class="col-md-9">
                                    <textarea  name="description" id="demo-textarea-input" rows="9" class="form-control" placeholder="작품 소개를 입력해 주세요"></textarea>
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