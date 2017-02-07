@extends('layouts.admin_layout')

@section('content')
    <div id="content-container">

        <div id="page-title">
            <h1 class="page-header text-overflow">공지사항 수정</h1>
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
                              action="{{route('admin.notifications.update.put',['id' => $noti->id])}}"
                              method="post">
                            {!! csrf_field() !!}
                            <input name="_method" type="hidden" value="PUT">
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-email-input">분류</label>
                                <div class="col-md-9">

                                    <input type="text" name="category" id="demo-email-input" class="form-control"
                                           placeholder="분류를 입력해 주세요." data-bv-field="title"
                                           value="{{ $noti->title }}">

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-email-input">공지 여부</label>
                                <div class="col-md-9">
                                    <div class="radio">

                                        <label class="form-radio form-normal form-text"><input type="radio" checked=""
                                                                                               name="posting" value="1">
                                            공지
                                        </label>
                                        <label class="form-radio form-normal form-text">
                                            <input type="radio"
                                                   @if($noti->posting == 0)
                                                   checked
                                                   @endif
                                                   name="posting" value="0">
                                            공지 안함(알림만)</label>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-email-input">제목</label>
                                <div class="col-md-9">
                                    <input type="text" name="title" id="demo-email-input" class="form-control"
                                           placeholder="제목을 입력해 주세요." data-bv-field="title" value="{{ $noti->title }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-textarea-input">내용</label>
                                <div class="col-md-9">
                                    <textarea name="content" id="demo-textarea-input" rows="9" class="form-control"
                                              placeholder="내용을 입력해 주세요">{{ $noti->content }}</textarea>
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