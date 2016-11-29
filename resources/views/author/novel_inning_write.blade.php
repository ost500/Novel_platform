@extends('layouts.app')

@section('content')

    <div class="boxed">
        <div id="content-container">

            <div id="page-title">
                <h1 class="page-header text-overflow">작품회차등록</h1>
            </div>


            <ol class="breadcrumb">
                <li><a href="#">작가홈</a></li>
                <li><a href="#">작품관리</a></li>
                <li class="active">작품회차등록</li>
            </ol>


            <div id="page-content">


                <div class="row">
                    <div class="col-sm-12">

                        <div class="panel">
                            <form class="panel-body form-horizontal form-padding">

                                <!--Static-->
                                <div class="form-group">
                                    <label class="col-md-2 control-label"></label>
                                    <div class="col-md-9"><p class="form-control-static">
                                        <h3>꼬마 아가씨의 첫사랑</h3></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="demo-email-input">제목</label>
                                    <div class="col-md-9">
                                        <input type="text" name="title" id="demo-email-input" class="form-control"
                                               placeholder="회차 제목을 입력해 주세요." data-bv-field="title">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="demo-email-input">성인</label>
                                    <div class="col-md-9">
                                        <div class="checkbox">
                                            <label class="form-checkbox form-normal form-primary active"><input
                                                        type="checkbox"> 19세 미만 관람불가입니다.</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="demo-email-input">출간예약</label>
                                    <div class="col-md-9">
                                        <div class="checkbox inline">
                                            <label class="form-checkbox form-normal form-primary active"><input
                                                        type="checkbox" class=" margin-left-10"> 출간예약</label>
                                        </div>


                                        <div class="inline">
                                            <input type="text" name="title" id="demo-email-input"
                                                   class="form-control inline" placeholder="예약일" style="width:100px;">

                                            <input type="text" name="title" id="demo-email-input"
                                                   class="form-control inline" placeholder="예약시간" style="width:100px;">
                                        </div>
                                        <small class="has-warning">예약 기능은 신규 챕터 등록 시에만 적용되며, 등록된 챕터를 수정할 때는 적용되지 않습니다.
                                        </small>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="demo-textarea-input">내용</label>
                                    <div class="col-md-9">
                                        <textarea id="demo-textarea-input" rows="20" class="form-control"
                                                  placeholder="작품 소개를 입력해 주세요"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="demo-textarea-input">작가의 말</label>
                                    <div class="col-md-9">
                                        <textarea id="demo-textarea-input" rows="3" class="form-control"
                                                  placeholder="작가의 말"></textarea>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-2 control-label">표지</label>
                                    <div class="col-md-9">


                                        <input type="file" id="demo-password-input" class="form-control"
                                               placeholder="Password">
                                        <small class="has-warning">사이즈 : 900*900 / 최대용량 : 1M / 업로드 가능 확장자 : JPG, PNG
                                            파일
                                        </small>

                                        <div class="alert alert-warning media fade in">
                                            <div class="media-left">
													<span class="icon-wrap icon-wrap-xs icon-circle alert-icon">
														<i class="fa fa-bolt fa-lg"></i>
													</span>
                                            </div>
                                            <div class="media-body">
                                                <p class="alert-title">표지를 직접 등록할 때, 이미지 사이즈와 확장자가 정확 해야만 등록이 됩니다.</p>
                                                <p class="alert-title">저작권을 분쟁의 소지가 있는 이미지는 사용하실 수 없습니다. 저작권 관련 문제 발생 시,
                                                    모든 책임은 개인에게 있습니다.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-lg btn-primary">회차저장</button>
                                        <button class="btn btn-lg btn-danger">취소</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>
@endsection