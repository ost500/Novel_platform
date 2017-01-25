@extends('../layouts.main_layout')
@section('content')
        <!-- //헤더 -->
<!-- 컨테이너 -->
<div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="wrap" id="sent">
        <!-- LNB -->
        @include('main.mails.left_sidebar')
                <!-- //LNB -->

        <!-- 서브컨텐츠 -->
        <div class="content" id="content">
            <!-- 페이지헤더 -->
            <div class="list-header">
                <h2 class="title">보낸쪽지함 </h2>
            </div>
            <!-- //페이지헤더 -->

            <!-- 게시판목록 -->
            <form name="memo_list" action="#">
                <table class="bbs-list bbs-list--memo">
                    <caption>보낸쪽지함  목록</caption>
                    <thead>
                    <tr>
                        <th><label class="checkbox2"><input type="checkbox" id="list_all_check"><span></span><span
                                        class="hidden">전체선택</span></label></th>
                        <th>보낸사람</th>
                        <th colspan="2">내용</th>
                        <th>날짜</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($sent_mails) > 0)
                        @foreach($sent_mails as $sent_mail)
                            <tr @if($week_gap < $sent_mail->created_at) class="is-new" @endif>
                                <td class="col-check"><label class="checkbox2 ">
                                        <input type="checkbox" class="checkboxes" data-check-item
                                               value="{{$sent_mail->id}}"><span></span></label>
                                </td>
                                <td class="col-name">{{$sent_mail->users->name}}</td>
                                <td class="col-thumb"><img src="/front/imgs/thumb/memo1.png" alt=""></td>
                                <td class="col-subject">
                                    <a href="#mode_nav">{{$sent_mail->subject}}</a>
                                </td>
                                <td class="col-datetime">{{$sent_mail->created_at}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5"> 해당 조건의 작품이 없습니다.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <!-- 하단버튼 -->

                <div class="left-btns">
                    <button type="button" class="btn" v-on:click="destroy()"  @if(count($sent_mails) == 0)  disabled @endif>삭제</button>
                </div>



                <!-- //하단버튼 -->

            </form>

            <!-- //게시판목록 -->

            <!-- 페이징 -->
            @include('pagination_front', ['collection' => $sent_mails, 'url' => route('mails.sent').'?'])
                    <!-- //페이징 -->
        </div>
        <!-- //서브컨텐츠 -->
        <!-- 따라다니는퀵메뉴 -->
        <div class="aside-nav" id="aside_nav">
            <nav>
                <ul class="aside-menu">
                    <li><a href="#mode_nav" class="userbtn userbtn--alarm"><span>알림</span></a></li>
                    <li><a href="#mode_nav" class="userbtn userbtn--memo"><span>쪽지</span></a></li>
                    <li><a href="#mode_nav" class="userbtn userbtn--myinfo"><span>마이메뉴</span></a></li>
                    <li><a href="#mode_nav" class="userbtn userbtn--scrap"><span>선호작</span></a></li>
                    <li><a href="#mode_nav" class="userbtn userbtn--marble"><span>보유구슬</span></a></li>
                </ul>
            </nav>
        </div>
        <!-- //따라다니는퀵메뉴 -->
    </div>
</div>
<!-- //컨테이너 -->
<!-- 푸터 -->
<script type="text/javascript">
    var app = new Vue({
        el: '#sent',
        data: {
            info: {ids: ''}
        },

        methods: {
            destroy: function () {

                /*     bootbox.confirm({
                 message: "삭제 하시겠습니까?",
                 buttons: {
                 confirm: {
                 label: "삭제"
                 },
                 cancel: {
                 label: '취소'
                 }
                 },
                 callback: function (result) {
                 if (result) {*/

                var checked_data = $(".checkboxes:checked").map(function () {
                    return this.value;
                }).get();
                this.info.ids = checked_data;
                app.$http.post('{{ route('mailbox.destroy') }}', this.info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                        .then(function (response) {
                            //    console.log(response);
                            location.reload();

                        }).catch(function (errors) {
                            console.log(errors);
                        });
                /*         }

                 }
                 });*/
            }
        }
    });
</script>
@endsection