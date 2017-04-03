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
                        <h2 class="title">독자추천 수정하기</h2>

                    </div>
                    <!-- //페이지헤더 -->

                    <!-- 게시판쓰기 -->
                    <div class="bbs-write"  style="margin-top:2%;">
                        <form name="reviews" id="reviews" action="{{route('reviews.update',['id'=>$reader_reco->id])}}" method="post"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="PUT">
                            <div class="item-list item-list--bbs">

                                <div class="item-cols">
                                    <label for="title" class="label">제목</label>

                                    <div class="input"><input type="text" class="text2" name="title" id="title" value="{{$reader_reco->title}}"></div>
                                </div>
                                <div class="item-cols">
                                    <label for="question" class="label">내용</label>

                                    <div class="input"><textarea class="textarea2" rows="10" name="review"
                                                                 id="review">{{$reader_reco->review}}</textarea></div>
                                </div>
                            </div>
                            <div class="submit">
                                <button class="btn btn--special" type="submit">수정하기</button>

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