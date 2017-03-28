@extends('../layouts.main_layout')
@section('content')
    <div class="container">

        <div class="wrap">
            <!-- LNB -->
            @include('main.mails.left_sidebar')
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
                        <h2 class="title">쪽지보내기</h2>
                    </div>
                    <!-- //페이지헤더 -->

                    <!-- 게시판쓰기 -->
                    <div class="bbs-write" style="margin-top:2%;">
                        <form name="ask_queston" id="ask_queston" action="{{route('mailbox.store_specific_mail')}}"
                              method="post"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="item-list item-list--bbs">

                                <div class="item-cols">
                                    <label for="to" class="label">받는이</label>

                                    <div class="input">
                                        @if($user)
                                            <input type="text" class="text2" name="to" id="to"
                                                   value="{{$user->email}}" >
                                        @else
                                            <input type="text" class="text2" name="to" id="to"
                                                   value="{{old('to')}}">
                                        @endif</div>
                                </div>

                                <div class="item-cols">
                                    <label for="subject" class="label">제목</label>

                                    <div class="input"><input type="text" class="text2" name="subject" id="subject"
                                                              value="{{old('subject')}}" ></div>
                                </div>
                                <div class="item-cols">
                                    <label for="body" class="label">내용</label>

                                    <div class="input"><textarea class="textarea2" rows="10" name="body"
                                                                 id="body" > {{old('body')}}</textarea></div>
                                </div>
                                <div class="item-cols">
                                    <span class="label">이미지</span>

                                    <div class="input input--attach">
                            <span class="typefile">
                                <span class="typefile-button"><i class="plus-icon"></i>첨부파일</span>
                                <span class="typefile-path">선택된 파일 없음</span>
                                <input type="file" class="typefile-input" title="첨부파일" name="attachment"
                                       id="attachment">
                            </span>

                                        <p class="attach-desc">
                                            JPG, GIF, PNG 파일 형식의 이미지를 최대 3장까지 첨부할 수 있습니다.(5MB 이하)<br>
                                            이미지 첨부는 필수 항목이 아닙니다.
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div class="submit">
                                <input type="hidden" name="redirect" id="redirect"  value="1">
                                <button class="btn btn--special" type="submit">보내기</button>

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
        $(".alert").delay(4000).slideUp(200, function () {
            $(this).alert('close');
        });
    </script>
@endsection