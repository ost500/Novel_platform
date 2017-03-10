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
                    <h2 class="mlist_tit4">독자추천 수정하기
                    </h2>
                </div>
                <div class="dot_top"></div>
                <!-- 문의유형 체크 -->
                <form name="ask_queston" id="ask_queston"
                      action="{{route('reviews.update',['id'=>$reader_reco->id])}}" method="post"
                      enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="PUT">
                    <!-- 문의내용 입력 -->

                    <fieldset style="margin-top:10%;">
                        <legend class="screen_out">문의 내용 등록</legend>
                        <!-- 제목입력 -->
                        <input type="text" name="title" id="title" value="{{$reader_reco->title}}"
                               class="inputBasic full" style="margin: 10px 0 15px 0;" placeholder="제목을 입력해주세요.">
                        <!-- 내용입력 -->
                        <textarea class="repl_txtar mart15" rows="3" cols="30" name="review"
                                  id="review" placeholder="내용을 입력해주세요.">{{$reader_reco->review}}</textarea>

                        <div class="padtb20">
                            <button type="submit" class="btn_green full">수정하기</button>
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