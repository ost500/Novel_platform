@extends('../layouts.main_layout')
@section('content')
        <!-- //헤더 -->
<!-- 컨테이너 -->
<div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="wrap" id="my_box">
        <!-- LNB -->
        @include('main.mails.left_sidebar')
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
                    <h2 class="title">보관쪽지함 </h2>
                </div>
                <!-- //페이지헤더 -->

                <!-- 게시판목록 -->
                <form name="memo_list" action="#">
                    <table class="bbs-list bbs-list--memo">
                        <caption>보관쪽지함 목록</caption>
                        <thead>
                        <tr>
                            <th><label class="checkbox2">
                                    <input type="checkbox" id="list_all_check">
                                    <span></span><span class="hidden">전체선택</span></label></th>
                            <th>보낸사람</th>
                            <th colspan="2">내용</th>
                            <th>날짜</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($my_box_mails) > 0)
                            @foreach($my_box_mails as $my_box_mail)
                                <tr>
                                    <td class="col-check"><label class="checkbox2 ">
                                            <input type="checkbox" class="checkboxes" data-check-item
                                                   value="{{$my_box_mail->id}}"><span></span></label>
                                    </td>
                                    <td class="col-name">{{$my_box_mail->mailboxs->users->name}}</td>
                                    <td class="col-thumb"><img src="/front/imgs/thumb/memo1.png" alt=""></td>
                                    <td class="col-subject">
                                        <a href="{{ route('mails.detail', ['id' => $my_box_mail->id]) }}">{{$my_box_mail->mailboxs->subject}}</a>
                                    </td>
                                    <td class="col-datetime">{{$my_box_mail->created_at}}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5"> 보관 쪽지가 없습니다.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <!-- 하단버튼 -->

                    <div class="left-btns">
                        <button type="button" class="btn" v-on:click="destroy()"
                                @if(count($my_box_mails) == 0)  disabled @endif>삭제
                        </button>
                    </div>


                    <div class="right-top-margin-btns">
                        <button type="button" class="btn" v-on:click="addToSpam('spam')"
                                @if(count($my_box_mails) == 0)  disabled @endif >차단
                        </button>
                        <a href="{{route('accusations',['id'=>Auth::user()->id])}}">
                            <button type="button" class="btn" @if(count($my_box_mails) == 0)  disabled @endif >신고
                            </button>
                        </a>
                    </div>

                    <!-- //하단버튼 -->

                </form>

                <!-- //게시판목록 -->

                <!-- 페이징 -->
                @include('pagination_front', ['collection' => $my_box_mails, 'url' => route('mails.my_box').'?'])
                        <!-- //페이징 -->
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
    var app = new Vue({
        el: '#my_box',
        data: {
            info: {ids: '', type: ''}
        },

        methods: {
            destroy: function () {

                this.info.ids = $(".checkboxes:checked").map(function () {
                    return this.value;
                }).get();
                if (this.info.ids.length > 0) {
                    if (confirm('삭제 하시겠습니까?')) {
                        app.$http.post('{{ route('mailbox.destroy') }}', this.info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                                .then(function (response) {
                                    location.reload();

                                }).catch(function (errors) {
                                    console.log(errors);
                                });
                    }
                }
            },
            addToSpam: function (type) {

                this.info.ids = $(".checkboxes:checked").map(function () {
                    return this.value;
                }).get();
                this.info.type = type;
                if (this.info.ids.length > 0) {
                    app.$http.put('{{ route('maillog.update') }}', this.info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {
                                location.reload();

                            }).catch(function (errors) {
                                // console.log(errors);
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