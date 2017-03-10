@extends('layouts.mobile_layout')
@section('content')
        <!-- 내용 -->
<div class="container">

    <div class="cont_wrap" id="ask_question">
        <div class="sel2_wrap">
            <!-- 텝메뉴 -->
            <ul class="tap2_mn">
                <li class="left"><a href="{{route('m.free_board')}}" >자유게시판</a></li>
                <li class="right"><a href="{{route('m.reader_reco')}}" class="tap2_mn_on">독자추천</a></li>
            </ul>
            <!-- 텝메뉴 //-->
        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

                    <!-- 서브컨텐츠 -->
            <div class="content" id="content">

                <div class="mlist_tit_rwap2">
                    <h2 class="mlist_tit4">독자추천 글쓰기
                    </h2>
                </div>
                <div class="dot_top"></div>
                <!-- 문의유형 체크 -->
                <form name="reviews" id="reviews" action="{{route('reviews.store')}}" method="post"
                      enctype="multipart/form-data">
                    {{csrf_field()}}

                            <!-- 문의내용 입력 -->

                    <fieldset style="margin-top:10%;">
                        <legend class="screen_out"></legend>
                        <!-- 제목입력 -->

                        <input type="text" name="title" id="title" class="inputBasic full"
                               style="margin: 10px 0 15px 0;" placeholder="제목을 입력해주세요.">
                        <!-- 내용입력 -->

                    <textarea class="repl_txtar mart15" rows="3" cols="30" name="review"
                              id="review" placeholder="내용을 입력해주세요."></textarea>

                        <div class="padtb20">
                            <input type="hidden" class="text2" name="novel_group_id" id="novel_group_id" value="{{$novel_group_id}}">
                            <button type="submit" class="btn_green full">문의하기</button>
                        </div>
                    </fieldset>
                </form>

                <!-- 문의내용 입력 //-->
            </div>
    </div>
    <!-- 내용 //-->
</div>
<script type="text/javascript">

</script>
@endsection