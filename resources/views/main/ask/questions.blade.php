@extends('../layouts.main_layout')
@section('content')
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
        @include('main.ask.left_sidebar')
        <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 페이지헤더 -->
                <div class="list-header">
                    <h2 class="title">1:1문의</h2>
                    <div class="links">
                        <a href="{{route('ask.ask_question')}}">문의하기</a><a href="{{route('ask.questions')}}"
                                                                           class="is-active">문의내역</a>
                    </div>
                </div>
                <!-- //페이지헤더 -->

                <!-- 게시판목록 -->
                <table class="bbs-list bbs-list--qa">
                    <caption>1:1문의 목록</caption>
                    <thead>
                    <tr>
                        <th>문의유형</th>
                        <th>제목</th>
                        <th>등록일</th>
                        <th>상태</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($questions as $question)
                        <tr>
                            <td class="col-category">{{$question->category}}</td>
                            <td class="col-subject">
                                <a href="{{route('ask.question_detail',['id'=>$question->id])}}">{{$question->title}}</a>
                            </td>
                            <td class="col-datetime">{{$question->created_at}}</td>
                            <td class="col-state">
                                @if($question->status == 1)
                                    <span class="is-answer">답변완료</span>
                                @else
                                    <span >답변대기</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
                <!-- //게시판목록 -->
                <div class="page-nav">
                    @include('pagination_front', ['collection' => $questions, 'url' => route('ask.questions').'?'])
                </div>
            </div>
            <!-- //서브컨텐츠 -->
            <!-- 따라다니는퀵메뉴 -->
        @include('main.quick_menu')
        <!-- //따라다니는퀵메뉴 -->
        </div>
    </div>
    <!-- //컨테이너 -->
    <!-- 푸터 -->
@endsection