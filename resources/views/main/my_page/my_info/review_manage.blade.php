@extends('layouts.main_layout')
@section('content')
    <!-- 컨테이너 -->
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
        @include('main.my_page.left_sidebar')
        <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 페이지헤더 -->
                <div class="list-header">
                    <h2 class="title">게시글 관리</h2>
                    <div class="links">


                    </div>
                </div>
                <!-- //페이지헤더 -->

                <!-- 게시판목록 -->
                <form name="bbs_list" action="#">
                    <table class="bbs-list bbs-list--post-manage">
                        <caption>게시글 관리 목록</caption>
                        <thead>
                        <tr>
                            <th><label class="checkbox2"><input type="checkbox" id="list_all_check"><span></span><span
                                            class="hidden">전체선택</span></label></th>
                            <th>제목</th>
                            <th>등록일</th>
                            <th>조회수</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($articles as $article)
                            <tr>
                                <td class="col-check"><label class="checkbox2"><input type="checkbox"
                                                                                      data-check-item><span></span></label>
                                </td>
                                <td class="col-subject">
                                    <a href="#mode_nav">{{ $article->title }}</a>
                                    <span class="hidden">댓글 </span><span
                                            class="comment-cnt">{{ $article->comments_count }}</span>
                                </td>
                                <td class="col-datetime">{{ $article->created_at }}</td>
                                <td class="col-view">{{ $article->view_count }}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </form>
                <!-- //게시판목록 -->

                <!-- 페이징 -->
            @include('pagination_front', ['collection' => $articles, 'url' => route('my_info.review_manage').'?'])
                <!-- //페이징 -->
            </div>
            <!-- //서브컨텐츠 -->
            <!-- 따라다니는퀵메뉴 -->
        @include('main.quick_menu')
        <!-- //따라다니는퀵메뉴 -->
        </div>
    </div>
    <!-- //컨테이너 -->

@endsection