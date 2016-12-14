@extends('layouts.admin_layout')
@section('content')

    <div id="content-container">

        <div id="page-title">
            <h1 class="page-header text-overflow">쪽지보내기</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">작가홈</a></li>
            <li class="active"><a href="#">쪽지보내기</a></li>
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

            <div id="request_create" class="panel panel-default panel-left">
                <div class="panel-body">

                    <form role="form" class="form-horizontal" action="{{ route('mailbox.store') }}" method="post" enctype="multipart/form-data">
                        {{--<meta id="token" name="token" content="{{ csrf_token() }}">--}}
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="col-lg-1 control-label text-left" for="inputSubject">작품선택</label>

                            <div class="col-lg-11">
                                <select class="form-control" name="novel_group_id">
                                    <option value="">작품선택</option>
                                    @foreach($my_novel_groups as $group)
                                        <option value="{{ $group->id }}" selected>{{ $group->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-1 control-label text-left" for="inputSubject">제목</label>

                            <div class="col-lg-11">
                                <input type="text" name="subject" id="inputSubject" class="form-control"
                                       placeholder="제목" value="{{old('subject')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-1 control-label text-left" for="inputSubject">내용</label>

                            <div class="col-lg-11">
                                    <textarea name="body" id="demo-textarea-input" rows="15" class="form-control"
                                              placeholder="내용"  >{{old('body')}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-1 control-label text-left" for="attachment">첨부파일</label>

                            <div class="col-lg-11">
                                <input type="file" name="attachment" id="attachment" class="form-control"
                                       placeholder="첨부파일" >
                                <small class="has-warning">최대용량 : 1M / 업로드 가능 확장자 : JPG, PNG 파일</small>
                            </div>
                        </div>

                        <div id="demo-mail-compose"></div>

                        <div class="text-center">
                            <button id="mail-send-btn" class="btn btn-primary btn-labeled">
                                <span class="btn-label"><i class="fa fa-paper-plane"></i></span> 쪽지보내기
                            </button>


                            <a href="{{route('admin.memo')}}">
                                <button type="button" class="btn btn-danger">취소</button>
                            </a>


                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>





@endsection