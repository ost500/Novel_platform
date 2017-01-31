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
            <!-- 댓글목록 -->
            <div class="comments comments--manage">
                <div class="comment-list-header">
                    <h2 class="title">일반 댓글 관리</h2>
                    <span class="count">{{count($comments) }}</span>
                    <!-- 댓글정렬 -->
                    <div class="sort-nav sort-nav--comment">
                        <nav>
                            <ul>
                                <li>
                                    <a href="{{route('my_info.free_board_review_comments_manage').'?filter='.$filter.'&order=latest' }}"
                                       @if($order=='latest' or $order=='' ) class="is-active" @endif>최신순</a></li>
                                <li>
                                    <a href="{{route('my_info.free_board_review_comments_manage').'?filter='.$filter.'&order=normal' }}"
                                       @if($order=='normal') class="is-active" @endif >등록순</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- //댓글정렬 -->
                </div>
                <div class="list-header">
                    <div class="links" style="margin-top: 5px;">
                        <a href="{{route('my_info.free_board_review_comments_manage').'?filter=free_board_comments&order='.$order }}"
                           @if( $filter =='free_board_comments' or $filter == null ) class="is-active"
                           @endif style="margin-right: 5px;">문의하기</a>

                        <a href="{{route('my_info.free_board_review_comments_manage').'?filter=review_comments&order='.$order }}"
                           @if( $filter =='review_comments') class="is-active" @endif>문의내역</a>
                    </div>
                </div>
                <ul class="comment-list">

                    <li>
                        <div class="comment-wrap is-reply">
                            <div class="comment-info"><span class="parent-subject">&lt;검든꽃&gt; 기다무에 떴어요</span><span
                                        class="writer">불면증사탕</span></div>
                            <div class="comment-btns"><a href="#mode_nav">수정</a><a href="#mode_nav">삭제</a></div>
                            <div class="comment-content">
                                <p>저도 이북파라서 그냥 기다리려구요~ 카카오는 그래도 네웹이랑은 다르니까 2017년 안에는 나오지 않을까 하는 생각...</p>
                            </div>
                            <div class="comment-etc-info">자유게시판<span class="datetime">1분 전</span></div>
                        </div>
                    </li>
                    @foreach($comments as $comment)
                        <li>
                            <div class="comment-wrap">
                                <div class="comment-info"><span class="parent-subject">{{$comment->title}}</span><span
                                            class="writer">{{$comment->user_name}}</span></div>
                                <div class="comment-btns"><a href="#mode_nav">수정</a><a href="#mode_nav">삭제</a></div>
                                <div class="comment-content">
                                    <p>{{$comment->comment}}</p>
                                </div>
                                <div class="comment-etc-info">자유게시판<span
                                            class="datetime">{{time_elapsed_string($comment->created_at)}}</span></div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!-- //댓글목록 -->
            <!-- 페이징 -->
            <div class="page-nav">
                @include('pagination_front', ['collection' => $comments, 'url' => route('my_info.free_board_review_comments_manage').'?filter='.$filter.'&order='.$order.'&'])
            </div>
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