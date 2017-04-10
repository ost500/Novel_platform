@extends('layouts.app')
@section('content')

    <link href="/plugins/chosen/chosen.min.css" rel="stylesheet">
    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">

        <div id="page-title">
            <h1 class="page-header text-overflow">작품 수정</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">작가홈</a></li>
            <li><a href="#">작품관리</a></li>
            <li class="active">작품 수정</li>
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


            <div class="row">
                <div class="col-sm-12">

                    <div class="panel" id="novel_group_edit">

                        <form name="novel_group_update" id="novel_group_update"
                              class="panel-body form-horizontal form-padding" method="post"
                              action="{{route('novelgroups.update',['id'=>$novel_group->id]) }}"
                              enctype="multipart/form-data">
                            <input name="_method" type="hidden" value="PUT">
                            {{ csrf_field() }}


                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-text-input">필명</label>

                                <div class="col-md-9">
                                    <select class="form-control" name="nickname_id">
                                        {{--<option value="">필명선택</option>--}}

                                        @foreach($nicknames as $nickname)
                                            <option value="{{$nickname->id}}"
                                                    @if($nickname->id==$novel_group->nicknames->id) selected @endif >{{$nickname->nickname}}</option>
                                        @endforeach

                                    </select>

                                    <!--small class="help-block">This is a help text</small-->
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-email-input">작품제목</label>

                                <div class="col-md-9">
                                    <input type="text" name="title" id="demo-email-input" class="form-control"
                                           value="{{$novel_group->title}}" placeholder="작품 제목을 입력해 주세요."
                                           data-bv-field="title">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-textarea-input">작품소개</label>

                                <div class="col-md-9">
                                    <textarea name="description" id="demo-textarea-input" rows="9" class="form-control"
                                              placeholder="작품 소개를 입력해 주세요">{{$novel_group->description}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-text-input">장르</label>

                                <div class="col-md-9">
                                    <select name="keyword1" class="form-control inline"
                                            style="width:14%;" size=10>
                                        <option value="">장르</option>
                                        @foreach($keyword1 as $keyword)
                                            <option value="{{$keyword->id}}"
                                                    @if($keyword->id==$novel_group->keywords['0']->id) selected @endif>{{$keyword->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-text-input">해시태그</label>

                                <div class="col-md-9">
                                    <select id="demo-cs-multiselect" name="hash_tags[]"
                                            data-placeholder="Choose a HashTag" multiple tabindex="4">
                                        @foreach($hash_tag_keywords as $hash_tag_keyword)
                                            <option value="{{$hash_tag_keyword->name}}"
                                                    @foreach($selected_hash_tags as $selected_hash_tag)
                                                    @if($selected_hash_tag->tag == $hash_tag_keyword->name) selected @endif @endforeach
                                                    >
                                             {{--   <button v-on:keyup="removeTag('{{$hash_tag_keyword->name}}')"></button>--}}
                                                {{$hash_tag_keyword->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-password-input">기본표지</label>

                                <div class="col-md-9">
                                    <input type="text" id="demo-password-input" style="width:30%;"
                                           name="default_cover_photo" class="form-control inline"
                                           placeholder="사용하려면 우측 표지선택 버튼을 클릭하세요.">
                                    <button type="button" class="btn btn-primary novel-image">표지선택</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>

                                <div class="col-md-9" style="text-align: left">

                                    @if($novel_group->cover_photo)
                                        <img src="/img/novel_covers/{{$novel_group->cover_photo}}" class="index_img">
                                    @else
                                        <img src="/img/novel_covers/default_.jpg" class="index_img">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">

                                <label class="col-md-2 control-label">표지 직접등록1</label>

                                <div class="col-md-9">
                                    <input type="file" name="cover_photo" id="cover_photo" class="form-control"
                                           style="cursor: pointer">
                                    <small class="has-warning">사이즈 : 1080*1620 / 최대용량 : 1M / 업로드 가능 확장자 : JPG, PNG 파일
                                    </small>

                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>

                                <div class="col-md-9" style="text-align: left">
                                    @if($novel_group->cover_photo2)
                                       <img src="/img/novel_covers/{{$novel_group->cover_photo2}}" class="index_img">
                                {{--    @else
                                        <img src="/img/novel_covers/default_.jpg" class="index_img">--}}
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">표지 직접등록2</label>

                                <div class="col-md-9">
                                    <input type="file" name="cover_photo2" id="cover_photo2"
                                           class="form-control" style="cursor: pointer">
                                    <small class="has-warning">사이즈 : 1080*1080 / 최대용량 : 1M / 업로드 가능 확장자 : JPG, PNG 파일
                                    </small>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-password-input"></label>

                                <div class="col-md-9">
                                    <div class="alert alert-warning media fade in">
                                        <div class="media-left">
													<span class="icon-wrap icon-wrap-xs icon-circle alert-icon">
														<i class="fa fa-bolt fa-lg"></i>
													</span>
                                        </div>
                                        <div class="media-body">
                                            <p class="alert-title">표지를 직접 등록할 때, 이미지 사이즈와 확장자가 정확 해야만 등록이 됩니다.</p>

                                            <p class="alert-title">저작권을 분쟁의 소지가 있는 이미지는 사용하실 수 없습니다. 저작권 관련 문제 발생 시, 모든
                                                책임은 개인에게 있습니다.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-lg btn-primary">수정</button>
                                    <button type="button" class="btn btn-lg btn-danger back">취소</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <script src="/plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <!--Chosen [ OPTIONAL ]-->
    <script src="/plugins/chosen/chosen.jquery.min.js"></script>

    <script src="/js/demo/form-component.js"></script>

@endsection