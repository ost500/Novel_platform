@extends('../layouts.main_layout')
@section('content')
    <div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">
        <div class="wrap" id="sent_gifts">
            <!-- LNB -->
            @include('main.my_page.left_sidebar')
                    <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                @if(Session::has('flash_message'))
                    {{-- important, success, warning, danger and info --}}
                    <div class="alert alert-success">
                        {{Session('flash_message')}}
                    </div>
                    @endif

                            <!-- 페이지헤더 -->
                    <div class="list-header">
                        <h2 class="title">보낸 선물 내역</h2>
                    </div>
                    <!-- //페이지헤더 -->

                    <!-- 게시판목록 -->
                    <table class="bbs-list bbs-list--gift2">
                        <caption>보낸 선물 내역 목록</caption>
                        <thead>
                        <tr>
                            <th>보낸 날짜</th>
                            <th>보낸 선물</th>
                            <th>받은사람</th>
                            <th>개수</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($presents->count() == 0)
                            <tr>
                                <td class="col-no-data" colspan="4">보낸 내역이 없습니다.</td>
                            </tr>
                        @endif
                        @foreach ($presents as $present)
                            <tr>
                                <td class="col-datetime2">{{ $present->created_at }}</td>
                                <td class="col-subject">{{ $present->content }}</td>
                                <td class="col-from">{{ $present->users->name }}</td>
                                <td class="col-state">

                                    <span>{{ $present->numbers }}</span>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- //게시판목록 -->

                    <!-- 하단버튼 -->
                    <div class="list-bottom-btns" style="z-index:10;">
                        <div class="right-btns">
                            <a href="#gift_form" class="btn btn--special" data-modal-id="gift_form" data-modal-fullsize>구슬
                                선물하기</a>
                        </div>

                    </div>
                    <!-- //하단버튼 -->
                    <!-- 페이징 -->
                    <div class="page-nav" >
                        @include('pagination_front', ['collection' => $presents, 'url' => route('my_info.sent_gift')."?"])
                    </div>
                    <!-- //페이징 -->

                    <!-- 공지 -->
                    <p class="mypage-notice mypage-notice--gift2">
                        게시글이나 댓글의 아이디를 클릭하여 구슬을 선물할 수도 있습니다.<br>선물 받은 구슬과 조각은 환불 및 재선물이 되지 않습니다.
                    </p>
                    <!-- //공지 -->
            </div>
            <!-- //서브컨텐츠 -->

            <!-- 구슬선물하기 팝업 -->
            <section id="gift_form" class="fullsize-modal" tabindex="0">
                <div class="popup-container">
                    <button type="button" class="popup-close-btn" data-modal-close>닫기</button>
                    <div class="popup-header">
                        <h2 class="title">구슬 선물하기</h2>
                    </div>
                    <div class="popup-content">
                        <form name="gift_form" action="{{route('presents.store')}}" class="gift-form" method="post"
                              v-on:submit.prevent="submitGift()">
                            {{csrf_field()}}
                            <div class="item-list">
                                <div class="item-cols">
                                    <label for="user_id" class="label">받는사람</label>

                                    <div class="input input--user-search">
                                        <div class="search-input">
                                            <input type="text" name="name" id="name" v-model="search_info.name"
                                                   class="text1"
                                                   placeholder="아이디나 닉네임을 검색하세요." v-on:keyup="searchByName()">
                                            <span class="input-desc" style="color:#b3383c;"
                                                  v-if="errors['user_id']">@{{ errors.user_id.toString() }}</span>
                                        </div>
                                        <button type="button" class="userbtn userbtn--search-submit"
                                                v-on:click="searchByName()"></button>
                                        <!-- 받는사람찾기결과 -->
                                        <div class="user-search-result"
                                             style="height: 100px; overflow-y: scroll;display:none" v-show="display">
                                            <div class="result-item" v-for="user_name in user_names"
                                                 v-if="user_name.id !='{{Auth::user()->id}}'"
                                                 style="padding-right:0;display:block;">
                                                <span class="user-name">@{{ user_name.nickname }}
                                                    (@{{ user_name.name }})</span>
                                                {{-- <button type="button" class="delete-btn">삭제</button> --}}
                                                <label class="checkbox2">
                                                    <input type="radio" name="user_id"
                                                           v-on:click="fillName(user_name.nickname,user_name.id )">
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="result-item" v-if="user_names.length==0" style="border:0 solid">
                                                <span class="user-name">검색 결과가 없습니다.</span>
                                            </div>
                                            <br>

                                        </div>
                                        <!-- //받는사람찾기결과 -->
                                    </div>
                                </div>
                                <div class="item-cols">
                                    <label for="gift_msg" class="label">전할문구</label>

                                    <div class="input input--fullsize">
                                        <input type="text" name="content" id="gift_msg" v-model="gift_info.content"
                                               class="text2"
                                               placeholder="공백 포함 최대 30자까지 가능합니다.">
                                        <span class="input-desc" style="color:#b3383c;"
                                              v-if="errors['content']">@{{ errors.content.toString() }}</span>
                                    </div>
                                </div>
                                <div class="item-cols">
                                    <label for="gift_marble" class="label">구슬선물</label>

                                    <div class="input">
                                        <input type="text" name="numbers" id="gift_marble" class="text2" size="25"
                                               v-model="gift_info.numbers">
                                        <span class="input-desc">구매한 구슬만 선물이 가능합니다.</span><br>
                                        <span class="input-desc" style="color:#b3383c;"
                                              v-if="errors['numbers']">@{{errors.numbers.toString() }}</span>
                                    </div>
                                </div>
                                <div class="my-item">
                                    <i class="marble3-icon"></i><span class="item-name">내가 가진 구슬</span><strong
                                            class="count">{{$user_bead->bead}} 개</strong>
                                </div>
                            </div>
                            <div class="submit">
                                <button type="submit" class="btn btn--submit">선물보내기</button>
                            </div>
                        </form>
                    </div>
                    <button class="popup-close-btn" data-modal-close>닫기</button>
                </div>
            </section>
            <!-- //구슬선물하기 팝업 -->
            <!-- 따라다니는퀵메뉴 -->
            @include('main.quick_menu')
                    <!-- //따라다니는퀵메뉴 -->
        </div>
    </div>
    <!-- //컨테이너 -->
    <!-- 푸터 -->
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
                                if (this.user_names) {
                                  //  console.log( this.user_names.length);
                                    this.display = true;
                                  //  $('#first').css('margin-bottom', '0px');
                                } else {
                                    this.display = false;
                                  //  $('#first').css('margin-bottom', '15px');
                                }

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
                            });

                },

                //Fill the selected user name in the input box
                fillName: function (nickname, user_id) {
                    app_gift.search_info.name = nickname;
                    app_gift.gift_info.user_id = user_id;

                }
            }
        });
        $(".alert").delay(5000).slideUp(200, function () {
            $(this).alert('close');
        });
    </script>

@endsection