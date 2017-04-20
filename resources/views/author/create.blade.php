@extends('layouts.app')

@section('content')


    <link href="/plugins/chosen/chosen.min.css" rel="stylesheet">

    <div id="content-container" xmlns:v-bind="http://symfony.com/schema/routing"
         xmlns:v-on="http://www.w3.org/1999/xhtml">

        <div id="page-title">
            <h1 class="page-header text-overflow">작품등록</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">작가홈</a></li>
            <li><a href="#">작품관리</a></li>
            <li class="active">작품등록</li>
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

                        <form class="panel-body form-horizontal form-padding" action="{{route('novelgroups.store')}}"
                              method="post"
                              enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <!--Static-->
                            <!--div class="form-group">
                                <label class="col-md-2 control-label">Static</label>
                                <div class="col-md-9"><p class="form-control-static">Username</p></div>
                            </div-->
                            <div class="form-group" id="select_nickname">
                                <label class="col-md-2 control-label" for="demo-text-input">필명</label>

                                <div class="col-md-9">

                                    <select class="form-control" name="nickname_id">
                                        <option value="">필명선택</option>
                                        @if(old('nickname'))

                                            <option v-for="nick in nicks" v-if="nick.id == {{ old('nickname')  }}"
                                                    selected
                                                    v-bind:value="nick.id">
                                                @{{ nick.nickname }}
                                            </option>
                                            <option v-else v-bind:value="nick.id">
                                                @{{ nick.nickname }}
                                            </option>

                                        @else
                                            <option v-for="nick in nicks" v-if="nick.main == 1" selected
                                                    v-bind:value="nick.id">
                                                @{{ nick.nickname }}
                                            </option>
                                            <option v-else v-bind:value="nick.id">
                                                @{{ nick.nickname }}
                                            </option>
                                        @endif
                                    </select>

                                {{-- <select class="form-control" name="nickname" v-model="nicks.nickname">
                                     <option value="" >필명선택</option>
                                     <option v-for="nick_name in nicks"
                                             :value="nick_name.id" > @{{ nick_name.nickname }} </option>

                                 </select>--}}
                                <!--small class="help-block">This is a help text</small-->
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-email-input">작품제목</label>

                                <div class="col-md-9">
                                    <input type="text" name="title" id="demo-email-input" class="form-control"
                                           placeholder="작품 제목을 입력해 주세요." data-bv-field="title"
                                           value="{{ old('title')  }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-textarea-input">작품소개</label>

                                <div class="col-md-9">
                                    <textarea name="description" id="demo-textarea-input" rows="9" class="form-control"
                                              placeholder="작품 소개를 입력해 주세요">{{ old('description')  }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-text-input">장르</label>


                                <div class="col-md-9">

                                    <select name="keyword1" class="form-control inline" style="width:14%;"
                                            size=10 {{old('keyword1')}} >
                                        <option value="">장르</option>
                                        @foreach($keyword1 as $keyword)
                                            <option value="{{$keyword->id}}" {{old("keyword1") == $keyword->id ? "selected":"" }}>{{$keyword->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" id="hash_tags">
                                <label class="col-md-2 control-label" for="demo-text-input">해시태그</label>

                                <div class="col-md-9">

                                    <select id="demo-cs-multiselect" name="hash_tags[]"
                                            data-placeholder="해시태그를 입력하세요" multiple tabindex="4">
                                        <option value="">필명선택</option>
                                        @foreach($hash_tags as $hash_tag)
                                            <option value="{{$hash_tag->name}}" {{old("hash_tags") == $hash_tag->id ? "selected":"" }}>{{$hash_tag->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-password-input">기본표지</label>

                                <div class="col-md-9">
                                    <input type="text" id="demo-password-input" style="width:30%;"
                                           name="default_cover_photo"
                                           class="form-control inline" placeholder="사용하려면 우측 표지선택 버튼을 클릭하세요."
                                           value="{{old('default_cover_photo')}}">
                                    <button type="button" class="btn btn-primary novel-image novel-user-nick-form">
                                        표지선택
                                    </button>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-2 control-label">표지 직접등록</label>

                                <div class="col-md-9">
                                    <input type="file" name="cover_photo" id="demo-password-input" class="form-control"
                                           value="{{old('cover_photo')}}">
                                    <small class="has-warning">사이즈 : 1080*1620 / 최대용량 : 2M / 업로드 가능 확장자 : JPG, PNG 파일 / 여우정원에서 사용되는 표지입니다.
                                    </small>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-2 control-label">보조 표지</label>

                                <div class="col-md-9">
                                    <input type="file" name="cover_photo2" id="demo-password-input"
                                           class="form-control" value="{{old('cover_photo2')}}">
                                    <small class="has-warning">사이즈 : 1080*1080 / 최대용량 : 2M / 업로드 가능 확장자 : JPG, PNG 파일 / 일부 제휴사에 제휴 연재 신청시 필요한 사이즈 입니다. 길이가 비교적 짧습니다.
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
                                    <button type="submit" class="btn btn-lg btn-primary">작품저장</button>
                                    <button class="btn btn-lg btn-danger back">취소</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!--Bootstrap Select [ OPTIONAL ]-->
    <script src="/plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <!--Chosen [ OPTIONAL ]-->
    <script src="/plugins/chosen/chosen.jquery.min.js"></script>
    {{--<script src="/js/demo/form-component.js"></script>--}}
    <script>
        /*        $('#demo-cs-multiselect1').chosen({width:'100%'});
         $('#keyword2').chosen({width:'100%'});
         $('#keyword3').chosen({width:'100%'});
         $('#keyword4').chosen({width:'100%'});
         $('#keyword5').chosen({width:'100%'});*/

        var select_nickname = new Vue({
            el: '#select_nickname',
            data: {
                nicks: [],
                formErrors: {}
            },
            mounted: function () {
                this.reload();
            },
            methods: {
                reload: function () {
                    this.$http.get('{{ route('nickname.index') }}')
                            .then(function (response) {
                                this.nicks = response.data;
                            });
                }

            }

        });

        $('#demo-cs-multiselect').chosen({width:'100%'});

    </script>

@endsection