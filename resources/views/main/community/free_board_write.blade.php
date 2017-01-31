@extends('../layouts.main_layout')
@section('content')
    <div class="container">

        <div class="wrap">
            <!-- LNB -->
            @include('main.community.LNB')
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
                        <h2 class="title">자유게시판 글쓰기</h2>
                    </div>
                    <!-- //페이지헤더 -->

                    <!-- 게시판쓰기 -->
                    <div class="bbs-write" style="margin-top:2%;">
                        <form name="ask_queston" id="ask_queston" action="{{route('free_board.store')}}" method="post"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="item-list item-list--bbs">

                                <div class="item-cols">
                                    <label for="title" class="label">제목</label>

                                    <div class="input"><input type="text" class="text2" name="title" id="title"></div>
                                </div>
                                <div class="item-cols">
                                    <label for="question" class="label">내용</label>

                                    <div class="input"><textarea class="textarea2" rows="10" name="content"
                                                                 id="content"></textarea></div>
                                </div>

                            </div>
                            <div class="submit">

                                <button class="btn btn--special" type="submit">문의하기</button>

                            </div>
                        </form>
                    </div>
                    <!-- //게시판쓰기 -->

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
    <script>
        /*   $(".alert-dismissable").fadeTo(2000, 500).slideUp(500, function(){
         $(".alert-dismissable").alert('close');
         });*/
        $(".alert").delay(4000).slideUp(200, function () {
            $(this).alert('close');
        });
    </script>
@endsection