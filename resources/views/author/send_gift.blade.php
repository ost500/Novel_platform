@extends('layouts.app')
@section('content')

    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml">

        <div id="page-title">
            <h1 class="page-header text-overflow">구슬 선물하기</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">작가홈</a></li>
            <li class="active"><a href="#">구슬 선물하기</a></li>
        </ol>


        <div id="page-content">

            <div id="sent_gifts" class="panel panel-default panel-left">
                <div class="alert alert-danger" id="errorDisplay" style="display:none;">
                    <ul>
                        <li v-if="errors['user_id']">@{{ errors.user_id.toString() }}</li>
                        <li v-if="errors['content']">@{{ errors.content.toString() }}</li>
                        <li v-if="errors['numbers']">@{{ errors.numbers.toString() }}</li>
                    </ul>
                </div>
                <div class="panel-body">

                    <form role="form" class="form-horizontal" action="{{ route('presents.store')}}" method="post"
                          v-on:submit.prevent="submitGift()">
                        <meta id="token" name="token" content="{{ csrf_token() }}">
                        <div class="form-group" id="first">
                            <label class="col-lg-1 control-label text-left" for="inputSubject">받는사람</label>

                            <div class="col-lg-11">
                                <input type="text" name="name" id="name" v-model="search_info.name" class="form-control"
                                       placeholder="아이디나 닉네임을 검색하세요" v-on:keyup="searchByName()">

                                {{-- <span v-if="errors['name']" class="error text-danger"> @{{ errors['name'] }}</span>--}}
                            </div>


                        </div>
                        <!-- 받는사람찾기결과 -->
                      <div style="margin-left: 139px;margin-bottom:1%; top: 18.7%;
    width: 30%;height: 125px;border:1px solid #e9e9e9;
    background-color: #fff; overflow-y: scroll;display:none" v-show="display">

                            <div class="col-lg-11" style="padding-top: 6px;" v-for="user_name in user_names"
                                 v-if="user_name.id !='{{Auth::user()->id}}'"
                                 style=" display:block;">
                                                <span class="user-name">@{{ user_name.name }}
                                                    (@{{ user_name.email }})</span>
                               {{-- <button type="button" class="delete-btn">삭제</button> --}}
                                <label class="form-radio form-normal form-primary form-text">
                                    <input type="radio" name="user_id"
                                           v-on:click="fillName(user_name.name,user_name.id )">
                                    <span></span>
                                </label>
                            </div>
                            <br>

                        </div>

                        <!-- //받는사람찾기결과 -->
                        <div class="form-group">
                            <label class="col-lg-1 control-label text-left" for="inputSubject">전할문구</label>

                            <div class="col-lg-11">
                                <input type="text" name="content" id="gift_msg" v-model="gift_info.content"
                                       class="form-control"
                                       placeholder="공백 포함 최대 30자까지 가능합니다.">
                                {{--<span v-if="errors['content']" class="error text-danger">@{{ errors['content'] }}</span>--}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-1 control-label text-left" for="inputSubject">구슬선물</label>

                            <div class="col-lg-11">
                                <input type="text" name="numbers" id="gift_marble" v-model="gift_info.numbers"
                                       class="form-control">
                                <span class="text">구매한 구슬만 선물이 가능합니다.</span><br>
                                {{--<span v-if="errors['numbers']" class="error text-danger">@{{ errors['numbers'] }}</span>--}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-1 control-label text-left" for="inputSubject"></label>

                            <div class="col-lg-11">
                                <img src="/img/marble3_icon.png"><span class="item-name">내가 가진 구슬</span>
                                <strong class="item-name" style="color:green;font-size: medium;"> {{$user_bead->bead}}개</strong>
                            </div>
                        </div>

                        <div id="demo-mail-compose"></div>

                        <div class="text-center">
                            <button type="submit" id="mail-send-btn" class="btn btn-primary btn-labeled">
                                <span class="btn-label"><i class="fa fa-paper-plane"></i></span> 선물보내기
                            </button>


                            <a href="{{route('author.sent_gifts')}}">
                                <button type="button" class="btn btn-danger">취소</button>
                            </a>


                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>

    //
    <script type="text/javascript">
        var app_gift = new Vue({
            el: '#sent_gifts',
            data: {
                info: {
                    status: ''
                },
                alert_msg: '',
                gift_info: {user_id: '', content: '', numbers: ''},
                search_info: {name: ''},
                user_names: [],
                errors: {},
                display: false
            },
            mounted: function () {
                this.searchByName();
            },
            methods: {

                //Show user name suggestions
                searchByName: function () {
                    this.$http.post('{{ route('users.search_by_name') }}', this.search_info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {

                                this.user_names = response.data['user_names'];
                                this.display = true;
                                $('#first').css('margin-bottom','0px');
                            })
                            .catch(function (response, status, request) {

                                // console.log(response.data);
                            });
                },

                //Submit the gift
                submitGift: function () {

                    app_gift.$http.post('{{ route('presents.store') }}', app_gift.gift_info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {
                                location.reload();
                            })
                            .catch(function (response, status, request) {
                                //show validation errors
                                this.errors = response.data;
                                $('#errorDisplay').show();
                            });

                },

                //Fill the selected user name in the input box
                fillName: function (name, user_id) {
                    app_gift.search_info.name = name;
                    app_gift.gift_info.user_id = user_id;

                }
            }
        });
        $(".chb").change(function () {
            $(".chb").prop('checked', false);
            $(this).prop('checked', true);

        });
    </script>


@endsection