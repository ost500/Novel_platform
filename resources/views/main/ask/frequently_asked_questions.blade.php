@extends('../layouts.main_layout')
@section    ('content')
    <div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div class="wrap">
            <!-- LNB -->
        @include('main.ask.left_sidebar')
        <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- FAQ 도움말 -->
                <div class="faq-category-box" id="faqs">
                    <strong class="title">여우정원을 처음 이용하시나요?</strong>
                    <ul>
                        <li class="category1"><a href="{{route('ask.faqs').'?category=사이트 이용' }}">사이트 이용</a></li>
                        <li class="category2"><a href="{{route('ask.faqs').'?category=회원정보' }}">회원정보</a></li>
                        <li class="category3"><a href="{{route('ask.faqs').'?category=구매/결제' }}">구매/결제</a></li>
                        <li class="category4"><a href="{{route('ask.faqs').'?category=작가/연재' }}">작가/연재</a></li>
                        <li class="category5"><a href="{{route('ask.faqs').'?category=APP' }}">APP</a></li>
                    </ul>
                </div>
                <form class="faq-search-form" name="faq_search_form" action="#">
                    <fieldset>
                        <legend class="un-hidden">도움말 검색</legend>
                        <input type="text" class="text1" name="search" v-model="search"
                               placeholder="여우정원에 궁금한 것을 물어보세요!" title="검색어" v-on:keyup.enter="searchByTitle">
                        <button class="userbtn userbtn--search" v-on:click="searchByTitle">검색</button>
                    </fieldset>
                </form>
                <!-- //FAQ 도움말 -->

                <!-- 게시판목록 -->
                <div class="list-header">
                    <h2 class="title title--bold">@if($category) {{$category}} @elseif($search) {{$search}} Search
                        Results @else 자주 묻는 질문 Best @endif</h2>
                </div>
                <table class="bbs-list bbs-list-notice">
                    <caption>자주 묻는 질문 목록</caption>
                    <thead>
                    <tr>
                        <th>분류</th>
                        <th>제목</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($faqs as $faq)
                        <tr>
                            <td width="20%" class="col-category">{{$faq->faq_category}}</td>
                            <td width="80%" class="col-subject">
                                <a href="{{route('ask.faq_detail',['id'=>$faq->id]).$query_string}}">{{$faq->title}}</a>

                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <!-- //게시판목록 -->
                <div class="page-nav">
                    @include('pagination_front', ['collection' => $faqs, 'url' => route('ask.faqs').$query_string.'&'])
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
    <script type="text/javascript">
        var app = new Vue({
            el: '#faqs',
            data: {
                search: ''
            },
            methods: {
                searchByTitle: function (e) {
                    window.location.href = '{{route('ask.faqs').'?search='}}' + app.search;
                }
            }
        });
    </script>
@endsection