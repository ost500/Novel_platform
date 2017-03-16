@extends('layouts.mobile_mypage_layout')
@section('content')
    <div class="popup_bg" id="sent_gifts" style="display:none;" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div class="mbgift_popin">
            <a href="" class="sidemn_close"><span class="ico_close">닫기</span></a>

            <h1 class="mbgift_pop_tit">구슬 선물하기</h1>

            <h2 class="mbgift_pop_subtit">받는사람</h2>

            <form name="gift_form" action="{{route('pieces.store')}}" class="gift-form" method="post"
                  v-on:submit.prevent="submitGift()">
                {{csrf_field()}}
                <div class="recipient_wrap">
                    <input type="text" name="name" id="name" v-model="search_info.name" v-on:keyup="searchByName()"
                           class="inputBacol with447" placeholder="아이디나 닉네임을 검색하세요.">
                    <a v-on:click="searchByName()" style="cursor: pointer;" class="rec_sch_btn">검색</a>
                 <span class="red22ng"
                       v-if="errors['user_id']">@{{ errors.user_id.toString() }}</span>
                </div>
                <div class="recipient_wrap" style="height: 100px; overflow-y: scroll;display:none;margin-top:6px;font-size:large;" v-show="display">
                    <div v-for="user_name in user_names"
                         v-if="user_name.id !='{{Auth::user()->id}}'"
                         style="padding:2px;display:block;">
                        <span class="">@{{ user_name.name }} (@{{ user_name.email }})</span>
                        {{-- <button type="button" class="delete-btn">삭제</button> --}}
                        <label class="checkbox-wrap"><input type="checkbox"  class="chb" name="user_id"
                                   v-on:click="fillName(user_name.name,user_name.id )">
                            <i class="check-icon"></i>
                            <span></span>
                        </label>
                    </div>

                 </div>
                <h2 class="mbgift_pop_subtit">전할문구</h2>

                <div>
                    <input type="text" name="content" id="gift_msg" v-model="gift_info.content"
                           class="inputBasic2 full" placeholder="공백 포함 최대 30자까지 가능합니다.">
                    <span class="red22ng" v-if="errors['content']">@{{ errors.content.toString() }}</span>
                </div>

                <h2 class="mbgift_pop_subtit">구슬선물</h2>

                <div>
                    <input type="text" name="numbers" id="gift_marble" v-model="gift_info.numbers"
                           class="inputBasic2 with214">
                    <span class="gra_20">구매한 구슬만 선물이 가능합니다.</span>
                <span class="red22ng" v-if="errors['numbers']">@{{errors.numbers.toString() }}</span>
                </div>

                <div class="mlist_tit_rwap4">
                    <div class="marble_ico_tit">내가 가진 구슬<span class="marble_num marL8">{{$user_bead->bead}}개</span>
                    </div>
                </div>

                <div class="padtb10"><input type="submit" value="선물보내기" class="btn_green2 full" style="cursor:pointer;"></div>
            </form>
        </div>
    </div>
    <!-- 내용 -->
    <div class="container">
        <div class="cont_wrap">
            <!-- 셀렉트박스 -->
            @include('mobile.my_page.select_bar')
                    <!-- 셀렉트박스 //-->
            @if(Session::has('flash_message'))
                {{-- important, success, warning, danger and info --}}
                <div class="alert alert-success">
                    {{Session('flash_message')}}
                </div>
                @endif

                        <!-- 안내문구 -->
                <div class="alert_box">
                    <div class="bro22">게시글이나 댓글의 아이디를 클릭하여 구슬을 선물할 수도 있습니다. 선물 받은 구슬과 조각은 환불 및 재선물이 되지 않습니다.</div>
                </div>
                <!-- 안내문구 //-->

                <div class="mlist_tit_rwap">
                    <h2 class="mlist_tit5">보낸 선물 내역 <a style="cursor:pointer;" id="show_popup" class="mlist_tit_btn short_cut">구슬 선물하기</a></h2>
                </div>

                <!-- 리스트 -->
                <table class="tbl_dotline2">
                    <colgroup>
                        <col width="*">
                        <col width="25%">
                    </colgroup>
                    <tbody>
                    @if($presents->count() == 0)
                        <tr>
                            <td class="contxt2" colspan="4">보낸 내역이 없습니다.</td>
                        </tr>
                    @endif
                    @foreach ($presents as $present)
                        <tr>
                            <td class="contxt2">
                                <div class="borContTit">{{ $present->content }}</div>
                                <div><span class="green_20">{{ $present->users->name }}</span><span
                                            class="gra_20 marL8">{{ $present->created_at }}</span></div>
                            </td>
                            <td class="buy">{{ $present->status }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- 리스트 //-->

                <!-- 페이징 -->
                @include('pagination_mobile', ['collection' => $presents, 'url' => route('my_info.sent_gift')."?"])
                        <!-- 페이징 //-->
        </div>
    </div>
    <!-- 내용 //-->
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
                    app_gift.$http.post('{{ route('users.search_by_name') }}', app_gift.search_info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {

                                this.user_names = response.data['user_names'];
                                this.display = true;
                            })
                            .catch(function (response, status, request) {

                                //console.log(response.data);
                            });
                },

                //Submit the gift
                submitGift: function () {

                    app_gift.$http.post('{{ route('pieces.store') }}', app_gift.gift_info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {
                                location.reload();
                            })
                            .catch(function (response, status, request) {
                                //show validation errors
                                this.errors = response.data;
                            });

                },

                //Fill the selected user name in the input box
                fillName: function (name, user_id) {
                    app_gift.search_info.name = name;
                    app_gift.gift_info.user_id = user_id;

                    $(".chb").change(function () {
                        $(".chb").prop('checked', false);
                        $(this).prop('checked', true);

                    });

                }
            }


        });



        $(".alert").delay(5000).slideUp(200, function () {
            $(this).alert('close');
        });
        $('#show_popup').click(function () {
            $('#sent_gifts').show();
        });


    </script>
@endsection