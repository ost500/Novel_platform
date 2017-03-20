@extends('../layouts.main_layout')
@section('content')
    <div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div class="wrap" id="received_gifts">
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
                    <h2 class="title">받은 선물 내역</h2>
                </div>
                <!-- //페이지헤더 -->

                <!-- 게시판목록 -->
                <table class="bbs-list bbs-list--gift">
                    <caption>받은 선물 내역 목록</caption>
                    <thead>
                    <tr>
                        <th>보낸날짜</th>
                        <th>받은 선물</th>
                        <th>보낸사람</th>
                        <th>상태</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($presents->count() == 0)
                        <tr>
                            <td class="col-no-data" colspan="4">받은 내역이 없습니다.</td>
                        </tr>
                    @endif
                    @foreach ($presents as $present)
                        <tr>
                            <td class="col-datetime2">{{ $present->created_at }}</td>
                            <td class="col-subject">{{ $present->content }}</td>
                            <td class="col-from">{{ $present->fromUser->name }}</td>
                            <td class="col-state">
                               {{-- @if($present->status == '대기')
                                    <span id="response{{$present->id}}"></span>
                                    <button class="btn btn-sm btn-primary" style="padding-left:9px;padding-right:9px;font-size: small;"
                                            id="approve{{$present->id}}"
                                            v-on:click="approve_deny('{{$present->id}}','수령',1)"> 수령
                                    </button>

                                    <button class="btn btn-sm btn-danger" style="padding-left:9px;padding-right:9px;font-size: small;"
                                            id="deny{{$present->id}}"
                                            v-on:click="approve_deny('{{$present->id}}','반송',0)"> 반송
                                    </button>
                                @else
                                    <span>{{ $present->status }}</span>
                                @endif--}}
                                {{ $present->numbers }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- //게시판목록 -->

                <!-- 페이징 -->
                @include('pagination_front', ['collection' => $presents, 'url' => route('my_info.received_gift')."?"])
                        <!-- //페이징 -->

                <!-- 공지 -->
                <p class="mypage-notice mypage-notice--gift">
                    선물 받은 구슬과 조각은 여우정원에 등록된 작품을 구매할 때 사용할 수 있습니다.<br>선물을 수령하지 않으면 30일 후 자동으로 반송됩니다.
                </p>
                <!-- //공지 -->
            </div>
            <!-- //서브컨텐츠 -->
            <!-- 따라다니는퀵메뉴 -->
            @include('main.quick_menu')
                    <!-- //따라다니는퀵메뉴 -->
        </div>
    </div>
    <!-- //컨테이너 -->
    <!-- 푸터 -->

    <script type="text/javascript">
        var app_gift = new Vue({
            el: '#received_gifts',
            data: {
                info: {
                    status: ''
                },
                alert_msg: ''
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
                }
            }
        });
        $(".alert").delay(4000).slideUp(200, function () {
            $(this).alert('close');
        });
    </script>
@endsection