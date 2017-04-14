@extends('../layouts.main_layout')
@section('content')
    <div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">

        <div class="wrap" id="send_mail">
            <!-- LNB -->
        @include('main.mails.left_sidebar')
        <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif
            <!-- 페이지헤더 -->
                <div class="list-header">
                    <h2 class="title">쪽지보내기</h2>
                </div>
                <!-- //페이지헤더 -->

                <!-- 게시판쓰기 -->
                <div class="bbs-write" style="margin-top:2%;">
                    <form name="ask_queston" id="ask_queston" action="{{route('mailbox.store_specific_mail')}}"
                          method="post"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="item-list item-list--bbs">

                            <div class="item-cols">
                                <label for="to" class="label">받는이</label>

                                <div class="input">
                                    @if($user)
                                        <input type="text" class="text2" name="to" id="to" v-model="search_info.name"
                                               value="" v-on:keyup="searchByName()">
                                    @else
                                        <input type="text" class="text2" name="to" id="to" v-model="search_info.name"
                                               value="{{old('to')}}" v-on:keyup="searchByName()">
                                    @endif</div>
                            </div>
                            <div class="item-cols">
                                <label for="to" class="label"></label>
                                <div class="input">
                                    <div class="user-search-result"
                                         style="height: 100px; overflow-y: scroll;display:none" v-show="display">
                                        <div class="result-item" v-for="user_name in user_names"
                                             v-if="user_name.id !='{{Auth::user()->id}}'"
                                             style="padding-right:0;display:block;">
                                                <span class="user-name">@{{ user_name.nickname }}
                                                    (@{{ user_name.email }})</span>
                                            {{-- <button type="button" class="delete-btn">삭제</button> --}}
                                            <label class="checkbox2">
                                                <input type="radio" name="user_id"
                                                       v-on:click="fillName(user_name.email,user_name.id )">
                                                <span></span>
                                            </label>
                                        </div>
                                        <br>

                                    </div>
                                </div>
                            </div>

                            <div class="item-cols">
                                <label for="subject" class="label">제목</label>

                                <div class="input"><input type="text" class="text2" name="subject" id="subject"
                                                          value="{{old('subject')}}"></div>
                            </div>
                            <div class="item-cols">
                                <label for="body" class="label">내용</label>

                                <div class="input"><textarea class="textarea2" rows="10" name="body"
                                                             id="body"> {{old('body')}}</textarea></div>
                            </div>
                            <div class="item-cols">
                                <span class="label">이미지</span>

                                <div class="input input--attach">
                            <span class="typefile">
                                <span class="typefile-button"><i class="plus-icon"></i>첨부파일</span>
                                <span class="typefile-path">선택된 파일 없음</span>
                                <input type="file" class="typefile-input" title="첨부파일" name="attachment"
                                       id="attachment">
                            </span>

                                    <p class="attach-desc">
                                        JPG, GIF, PNG 파일 형식의 이미지를 최대 3장까지 첨부할 수 있습니다.(5MB 이하)<br>
                                        이미지 첨부는 필수 항목이 아닙니다.
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="submit">
                            <input type="hidden" name="redirect" id="redirect" value="1">
                            <button class="btn btn--special" type="submit">보내기</button>

                        </div>
                    </form>
                </div>
                <!-- //게시판쓰기 -->

            </div>
            <!-- //서브컨텐츠 -->
            <!-- 따라다니는퀵메뉴 -->
        @include('main.quick_menu')
        <!-- //따라다니는퀵메뉴 -->
        </div>
    </div>
    <!-- //컨테이너 -->
    <!-- 푸터 -->
    <script>
        $(".alert").delay(4000).slideUp(200, function () {
            $(this).alert('close');
        });

        var app_gift = new Vue({
            el: '#send_mail',
            data: {
                info: {
                    status: ''
                },
                alert_msg: '',
                gift_info: {user_id: '', content: '', numbers: ''},
                search_info: {name: '@if($user){{$user->email}}@endif'},
                user_names: [],
                errors: {},
                display: false
            },
            mounted: function () {

            },
            methods: {

                approve_deny: function (present_id, status, type) {
                    // if type==1 is approve else deny
                    if (type == 1) {
                        app_gift.alert_msg = "승인 하시겠습니까?";
                    }
                    else {
                        app_gift.alert_msg = "반송 하시겠습니까?";
                    }

                    if (confirm(app_gift.alert_msg)) {

                        //approve info
                        app_gift.info.status = status;
                        app_gift.$http.put('{{ url('presents') }}/' + present_id, app_gift.info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                                .then(function (response) {
                                    /*   $('#approve' + present_id).hide();
                                     $('#deny' + present_id).hide();
                                     $('#response' + present_id).html(response.data.data);*/
                                    location.reload();
                                })
                                .catch(function (data, status, request) {
                                    var errors = data.data;
                                });

                    }
                },

                //Show user name suggestions
                searchByName: function () {
                    this.$http.post('{{ route('users.search_by_name') }}', this.search_info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {

                                this.user_names = response.data['user_names'];
                                this.display = true;
                            })
                            .catch(function (response, status, request) {

                                // console.log(response.data);
                            });
                },


                //Fill the selected user name in the input box
                fillName: function (name, user_id) {
                    app_gift.search_info.name = name;
                    app_gift.gift_info.user_id = user_id;

                }
            }
        });
        $(".alert").delay(5000).slideUp(200, function () {
            $(this).alert('close');
        });
    </script>
@endsection