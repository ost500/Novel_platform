@extends('layouts.app')

@section('content')
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


            <div class="row" id="novel_group_edit">
                <div class="col-sm-12">

                    <div class="panel">

                        <form name="novel_group_update" id="novel_group_update"
                              class="panel-body form-horizontal form-padding" method="post"
                              action="{{route('novelgroups.update',['id'=>$id]) }}"
                              enctype="multipart/form-data">
                            <input name="_method" type="hidden" value="PUT">
                            {{ csrf_field() }}
                            {{--  <input name="novel_group_id" id="novel_group_id" type="hidden" :value="fillItem.id" >
                            <meta id="token" name="token" content="{{ csrf_token() }}">  v-on:submit.prevent="onSubmit(fillItem.id)"     --}}

                                    <!--Static-->
                            <!--div class="form-group">
                                <label class="col-md-2 control-label">Static</label>
                                <div class="col-md-9"><p class="form-control-static">Username</p></div>
                            </div-->

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-text-input">필명</label>

                                <div class="col-md-9">
                                    <select class="form-control" name="nickname_id">
                                        {{--<option value="">필명선택</option>--}}
                                        <option v-model="fillItem.nicknames.id"
                                                selected> @{{ fillItem.nicknames.nickname }} </option>
                                        <option v-for="nick_name in nick_names"
                                                :value="nick_name.id"> @{{ nick_name.nickname }} </option>

                                    </select>

                                    <!--small class="help-block">This is a help text</small-->
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-email-input">작품제목</label>

                                <div class="col-md-9">
                                    <input type="text" name="title" id="demo-email-input" class="form-control"
                                           v-model="fillItem.title" placeholder="작품 제목을 입력해 주세요."
                                           data-bv-field="title">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-textarea-input">작품소개</label>

                                <div class="col-md-9">
                                    <textarea name="description" id="demo-textarea-input" rows="9" class="form-control"
                                              placeholder="작품 소개를 입력해 주세요" v-model="fillItem.description"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-text-input">키워드</label>

                                <div class="col-md-9">
                                    <select name="keyword1" class="form-control inline"
                                            v-model="fillItem.keywords[0].id"
                                            style="width:14%;" size=10>
                                        <option value="">장르</option>
                                        <option v-for="keyword in keyword1"
                                                :value="keyword.id"> @{{keyword.name }} </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="demo-text-input">키워드</label>

                                <div class="col-md-9">
                                    <select name="keyword2[]" class="form-control inline"
                                            v-model="fillItem.hash_tags[0].tag"
                                            style="width:14%;" size=10 multiple>
                                        <option value="">배경</option>
                                        <option v-for="keyword in keyword2"
                                                :value="keyword.name"> @{{keyword.name }} </option>

                                    </select>
                                    <input type="hidden" name="keyword2_hash_tag_id" :value="fillItem.hash_tags[0].id">

                                    <select name="keyword3[]" class="form-control inline"
                                            v-model="fillItem.hash_tags[1].tag"
                                            style="width:14%;" size=10 multiple>
                                        <option value="">소재</option>
                                        <option v-for="keyword in keyword3"
                                                :value="keyword.name"> @{{keyword.name }} </option>
                                    </select>
                                    <input type="hidden" name="keyword3_hash_tag_id" :value="fillItem.hash_tags[1].id">
                                    <select name="keyword4[]" class="form-control inline"
                                            v-model="fillItem.hash_tags[2].tag"
                                            style="width:14%;" size=10 multiple>
                                        <option value="">관계</option>
                                        <option v-for="keyword in keyword4"
                                                :value="keyword.name"> @{{keyword.name }} </option>

                                    </select>
                                    <input type="hidden" name="keyword4_hash_tag_id" :value="fillItem.hash_tags[2].id">
                                    <select name="keyword5[]" class="form-control inline"
                                            v-model="fillItem.hash_tags[3].tag"
                                            style="width:14%;" size=10 multiple>
                                        <option value="">남주인공</option>
                                        <option v-for="keyword in keyword5"
                                                :value="keyword.name"> @{{keyword.name }} </option>

                                    </select>
                                    <input type="hidden" name="keyword5_hash_tag_id" :value="fillItem.hash_tags[3].id">
                                    <select name="keyword6[]" class="form-control inline"
                                            v-model="fillItem.hash_tags[4].tag"
                                            style="width:14%;" size=10 multiple>
                                        <option value="">여주인공</option>
                                        <option v-for="keyword in keyword6"
                                                :value="keyword.name"> @{{keyword.name }} </option>
                                    </select>
                                    <input type="hidden" name="keyword6_hash_tag_id" :value="fillItem.hash_tags[4].id">

                                    <select name="keyword7[]" class="form-control inline"
                                            v-model="fillItem.hash_tags[5].tag"
                                            style="width:14%;" size=10 multiple>
                                        <option value="">분위기/기타</option>
                                        <option v-for="keyword in keyword7"
                                                :value="keyword.name"> @{{keyword.name }} </option>
                                    </select>
                                    <input type="hidden" name="keyword7_hash_tag_id" :value="fillItem.hash_tags[5].id">
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

                                    <img v-if="fillItem.cover_photo != null"
                                         v-bind:src="'/img/novel_covers/' + fillItem.cover_photo" class="index_img">
                                    <img v-else v-bind:src="'/img/novel_covers/default_.jpg'" class="index_img">
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

                                    <img v-if="fillItem.cover_photo2 != null"
                                         v-bind:src="'/img/novel_covers/' + fillItem.cover_photo2" class="index_img">
                                    <img v-else v-bind:src="'/img/novel_covers/default_.jpg'" class="index_img">
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
                                    <button type="submit" class="btn btn-lg btn-primary">최신 정보</button>
                                    <button type="button" class="btn btn-lg btn-danger back">취소</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <script>
        //

        var app = new Vue({
            el: '#novel_group_edit',
            data: {
                fillItem: {},
                novel_group: [],
                nick_names: [],
                keyword1: [],
                keyword2: [],
                keyword3: [],
                keyword4: [],
                keyword5: [],
                keyword6: [],
                keyword7: [],


                formErrors: {}

            },

            mounted: function () {
                this.$http.get('{{ route( 'novelgroups.edit',['[id'=>$id]) }}')
                        .then(function (response) {
                            this.fillItem = response.data['novel_group'];
                            /*      console.log(this.fillItem.hash_tags[1].id);*/
                            this.nick_names = response.data['nick_names'];
                            this.keyword1 = response.data['keyword1'];
                            this.keyword2 = response.data['keyword2'];
                            this.keyword3 = response.data['keyword3'];
                            this.keyword4 = response.data['keyword4'];
                            this.keyword5 = response.data['keyword5'];
                            this.keyword6 = response.data['keyword6'];
                            this.keyword7 = response.data['keyword7'];
                            //   console.log(this.keyword3);

                        });

            },
            method: {
                /*     getCoverPhotoName:function(){

                 console.log(this.fillItem.cover_photo);
                 // return this.fillItem.cover_photo;
                 $('#cover_photo').attr('value',this.fillItem.cover_photo);
                 }*/

            }

        });

    </script>

@endsection