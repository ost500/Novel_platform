@extends('layouts.main_layout')
@section('content')
        <!-- 컨테이너 -->
<div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="wrap" id="post_manage">
        <!-- LNB -->
        @include('main.my_page.left_sidebar')
                <!-- //LNB -->

        <!-- 서브컨텐츠 -->
        <div class="content" id="content">
            @if(Session::has('flash_message'))
                {{-- important, success, warning, danger and info --}}
                <div class="alert alert-success">
                    {{Session('flash_message')}}
                </div>
                @endif
            <!-- 페이지헤더 -->
            <div class="list-header">
                <h2 class="title">게시글 관리</h2>
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
                            <td class="col-check"><label class="checkbox2">
                                    <input type="checkbox" class="checkboxes" data-check-item
                                           value="{{$article->id}}"><span></span></label>
                            </td>
                            <td class="col-subject">
                                <a href="{{ route('free_board.detail', ['id' => $article->id]) }}">{{ $article->title }}</a>
                                <span class="hidden">댓글 </span><span
                                        class="comment-cnt">{{ $article->comments_count }}</span>
                            </td>
                            <td class="col-datetime">{{ $article->created_at }}</td>
                            <td class="col-view">{{ $article->view_count }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div class="left-btns">
                    <button type="button" class="btn" v-on:click="destroy()"
                            @if(count($articles) == 0)  disabled @endif>삭제
                    </button>
                </div>
            </form>
            <!-- //게시판목록 -->

            <!-- 페이징 -->
            @include('pagination_front', ['collection' => $articles, 'url' => route('my_info.post_manage').'?'])
                    <!-- //페이징 -->
        </div>
        <!-- //서브컨텐츠 -->
        <!-- 따라다니는퀵메뉴 -->
        @include('main.quick_menu')
                <!-- //따라다니는퀵메뉴 -->
    </div>
</div>
<!-- //컨테이너 -->
<script type="text/javascript">
    var app = new Vue({
        el: '#post_manage',
        data: {
            info: {ids: '', type: ''}
        },

        methods: {
            destroy: function () {

                this.info.ids = $(".checkboxes:checked").map(function () {
                    return this.value;
                }).get();
                if (this.info.ids.length > 0) {

                    if (confirm('삭제 하시겠습니까?')) {
                        app.$http.post('{{ route('free_board.destroy') }}', this.info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                                .then(function (response) {
                                   location.reload();

                                }).catch(function (errors) {
                                    //console.log(errors);
                                });
                    }
                }
            }

        }
    });

    $(".alert").delay(4000).slideUp(200, function () {
        $(this).alert('close');
    });
</script>
@endsection