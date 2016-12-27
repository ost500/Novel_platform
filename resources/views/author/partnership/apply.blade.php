@extends('layouts.app')
@section('content')
    
<div id="content-container">

    <div id="page-title">
        <h1 class="page-header text-overflow">제휴연재신청</h1>
    </div>


    <ol class="breadcrumb">
        <li><a href="#">작가홈</a></li>
        <li class="active"><a href="#">제휴연재신청</a></li>
    </ol>


    <div id="page-content">


        <div class="panel panel-default panel-left">
            <div class="panel-body">

                <form role="form" class="form-horizontal">
                    <div class="form-group pad-ver">

                        <div class="col-lg-12 text-center">
                            <div class="col-md-4">
                                <div class="col-sm-6">
                                    <div>
                                        <img src="http://211.110.165.137/img/novel_covers/default_.jpg" width="150">
                                    </div>
                                    <div class="padding-top-10">
                                        <label class="form-radio form-icon form-text active"><input type="radio"
                                                                                                    name="btn-bkl"
                                                                                                    checked=""> 업체명
                                            1</label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div>
                                        <img src="http://211.110.165.137/img/novel_covers/default_.jpg" width="150">
                                    </div>
                                    <div class="padding-top-10">
                                        <label class="form-radio form-icon form-text"><input type="radio" name="btn-bkl"
                                                                                             checked=""> 업체명 1</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="col-sm-6">
                                    <div>
                                        <img src="http://211.110.165.137/img/novel_covers/default_.jpg" width="150">
                                    </div>
                                    <div class="padding-top-10">
                                        <label class="form-radio form-icon form-text"><input type="radio" name="btn-bkl"
                                                                                             checked=""> 업체명 1</label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div>
                                        <img src="http://211.110.165.137/img/novel_covers/default_.jpg" width="150">
                                    </div>
                                    <div class="padding-top-10">
                                        <label class="form-radio form-icon form-text"><input type="radio" name="btn-bkl"
                                                                                             checked=""> 업체명 1</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="col-sm-6">
                                    <div>
                                        <img src="http://211.110.165.137/img/novel_covers/default_.jpg" width="150">
                                    </div>
                                    <div class="padding-top-10">
                                        <label class="form-radio form-icon form-text"><input type="radio" name="btn-bkl"
                                                                                             checked=""> 업체명 1</label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div>
                                        <img src="http://211.110.165.137/img/novel_covers/default_.jpg" width="150">
                                    </div>
                                    <div class="padding-top-10">
                                        <label class="form-radio form-icon form-text"><input type="radio" name="btn-bkl"
                                                                                             checked=""> 업체명 1</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group pad-ver">
                        <label class="col-lg-1 control-label text-left" for="inputSubject">작품선택</label>
                        <div class="col-lg-11">
                            <select class="form-control">
                                <option value="">작품선택</option>
                                <option value="">작품명1</option>
                                <option value="">작품명2</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group pad-ver">
                        <label class="col-lg-1 control-label text-left" for="inputSubject">초기 연재회차</label>
                        <div class="col-lg-11">
                            <input type="text" id="inputSubject" class="form-control" placeholder="초기연재수">
                        </div>
                    </div>

                    <div class="form-group pad-ver">
                        <label class="col-lg-1 control-label text-left" for="inputSubject">일 연재회차</label>
                        <div class="col-lg-11">
                            <input type="text" id="inputSubject" class="form-control" placeholder="일 연재회차">
                        </div>
                    </div>
                </form>


                <div id="demo-mail-compose"></div>

                <div class="text-center">
                    <button id="mail-send-btn" type="button" class="btn btn-primary btn-labeled">
                        <span class="btn-label"><i class="fa fa-paper-plane"></i></span> 신청하기
                    </button>
                    <a href="../../../../public/with_company.html">
                        <button type="button" class="btn btn-danger">취소</button>
                    </a>
                </div>
            </div>


        </div>


    </div>


</div>

@endsection