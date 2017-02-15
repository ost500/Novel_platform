@extends('../layouts.main_layout')
@section('content')
    <div class="container">

        <div class="wrap">
            <!-- LNB -->
        @include('main.ask.left_sidebar')
        <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                @if(Session::has('flash_message'))
                    {{-- important, success, warning, danger and info --}}
                    <div class="alert alert-success">
                        {{Session('flash_message')}}
                    </div>
                @endif
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
                    <h2 class="title">신고</h2>

                    <div class="links">

                    </div>
                </div>
                <!-- //페이지헤더 -->

                <!-- 게시판쓰기 -->
                <div class="bbs-write">
                    <form name="ask_queston" id="ask_queston" action="{{route('accusations.post')}}" method="post"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input hidden name="accu_id" value="{{$accu_id}}">
                        <input hidden name="link" value="{{$link}}">
                        <div class="item-list item-list--bbs">
                            <div class="item-rows">
                                <div class="label">안내</div>
                                <p class="input input--notice">관리자 검토 후 해당 사용자의 댓글 금지, 게시 금지, 로그인 금지 등과 같은 조치를 취하게
                                    됩니다.</p>
                            </div>

                            <div class="item-rows">
                                <div class="label">신고유형</div>
                                <div class="input input--checklist">
                                    <label class="checkbox2">
                                        <input type="radio" name="category" value="사이트이용"
                                               checked><span>광고</span></label>
                                    <label class="checkbox2">
                                        <input type="radio" name="category" value="회원정보"><span>개인정보 침해</span></label>
                                    <label class="checkbox2">
                                        <input type="radio" name="category"
                                               value="구매/결제"><span>사이버 저작권 침해</span></label>
                                    <label class="checkbox2">
                                        <input type="radio" name="category" value="작가/연재"><span>음란물</span></label>
                                    <label class="checkbox2">
                                        <input type="radio" name="category" value="APP"><span>명예훼손 및 모욕</span></label>

                                    <label class="checkbox2">
                                        <input type="radio" name="category" value="기타"><span>기타</span></label>
                                </div>
                            </div>
                            <div class="item-cols">
                                <label for="title" class="label">제목</label>

                                <div class="input"><input type="text" class="text2" name="title" id="title"></div>
                            </div>
                            <div class="item-cols">
                                <label for="question" class="label">내용</label>

                                <div class="input"><textarea class="textarea2" rows="10" name="contents"
                                                             id="question"></textarea></div>
                            </div>

                        </div>
                        <div class="submit">
                            <input type="hidden" name="ask_question" id="ask_question" value="1">
                            <button class="btn btn--special" type="submit">신고하기</button>

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
        /*   $(".alert-dismissable").fadeTo(2000, 500).slideUp(500, function(){
         $(".alert-dismissable").alert('close');
         });*/
        $(".alert").delay(4000).slideUp(200, function () {
            $(this).alert('close');
        });
    </script>
@endsection