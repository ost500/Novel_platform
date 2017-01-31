@extends('layouts.main_layout')
@section('content')
    <div class="container container--novel" id="inning" xmlns:v-on="http://www.w3.org/1999/xhtml"
         xmlns:v-bind="http://www.w3.org/1999/xhtml">
        <div class="wrap">
            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 연재상세 -->
                <article class="episode">
                    <!-- 원글 -->
                    <div class="original" id="original">
                        <!-- 연재상세헤더 -->
                        <header class="episode-header">
                            <div class="titles">
                                <h1 class="series-title"><a href="#mode_nav">공녀 엘린느</a></h1>

                                <p class="episode-title">프롤로그</p>
                            </div>
                            <div class="controls">
                                <span class="more-btn"><a href="#mode_nav"><i class="arrow-icon">다른 회차보기</i></a></span>
                                <span class="setup-btn"><a href="#mode_nav"><i class="setup2-icon">설정</i></a></span>
                            </div>
                        </header>
                        <!-- //연재상세헤더 -->

                        <!-- 연재상세내용 -->
                        <div class="episode-content">
                            <p>
                                <?php echo nl2br($novel_group_inning->content, false); ?>
                            </p>


                        </div>
                        <!-- //연재상세내용 -->
                        <div class="datetime">
                            <div class="reg-datetime">작성일 {{$novel_group_inning->created_at}}</div>
                            <div class="last-datetime">최종수정일 {{$novel_group_inning->updated_at}}</div>
                        </div>
                        <!-- 작가의말 -->
                        <div class="writer-comment">
                            <strong class="title">작가의 말</strong>

                            <div class="writer-comment-content">
                                안녕하세요.<br>이번에 새로 여우정원에 입주한 초율입니다.<br>앞으로 잘 부탁드려요~
                            </div>
                        </div>
                        <!-- //작가의말 -->
                        <div class="episode-content-btns">
                            <a href="#mode_nav" class="scrap-btn"><i class="scrap2-icon"></i> 선호작등록</a>
                            <a href="#mode_nav" class="share-btn"><i class="share2-icon"></i> 공유하기</a>
                            <a href="#mode_nav" class="memo-btn"><i class="memo2-icon"></i> 작가에게 쪽지 보내기</a>

                            <div class="right-btns">
                                <a href="#mode_nav" class="report-btn"><i class="report-icon"></i> 게시물 신고</a>
                            </div>
                        </div>
                        <!-- 이전다음버튼 -->
                        <div class="prev-next-episode">
                            <a href="#mode_nav" class="prev-btn"><i class="prev-episode-icon">이전회</i></a>
                            <a href="#mode_nav" class="next-btn"><i class="next-episode-icon">다음회</i></a>
                        </div>
                        <!-- //이전다음버튼 -->
                    </div>
                    <!-- //원글 -->

                    <!-- 댓글쓰기 -->
                    <div class="episode-comment-form">
                        <form name="comment_form" id="comment_form" action="" class="comment-form"
                              method="post" v-on:submit.prevent="commentStore()">
                            <div class="comment-form-wrap">
                                <textarea name="comment" id="comment" class="textarea2" v-model="info.comment"
                                          placeholder="남을 상처주지 않는 바르고 고운 말을 씁시다." title="댓글내용"></textarea>
                                {{--    <input type="hidden" name="novel_id" id="novel_id"  v-model="info.novel_id"/>--}}
                                {{--<input type="hidden" name="parent_id" id="parent_id" value="0"/>--}}

                                <div class="comment-form-btns">
                                <span class="options">
                                    <label class="checkbox2"><input name="secret" id="secret" type="checkbox">
                                        <span>비밀글</span></label>
                                </span>
                                <span class="submit">
                                    <button type="submit" class="btn">등록</button>
                                </span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- //댓글쓰기 -->

                    <!-- 댓글목록 -->
                    <section class="episode-comment">
                        <div class="comments">
                            <div class="comment-list-header">
                                <h2 class="title">댓글</h2>
                                <span class="count">{{count($novel_group_inning->comments)}}</span>
                                <!-- 댓글정렬 -->
                                <div class="sort-nav sort-nav--comment">
                                    <nav>
                                        <ul>
                                            <li><a href="#mode_nav" class="is-active">최신순</a></li>
                                            <li><a href="#mode_nav">등록순</a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- //댓글정렬 -->
                            </div>
                            <ul class="comment-list">
                                @if(count($novel_group_inning_comments) >0)
                                    @foreach($novel_group_inning_comments as $novel_group_inning_comment)
                                        <li>
                                            <div class="comment-wrap">
                                                <div class="comment-info"><span
                                                            class="writer">{{$novel_group_inning_comment[0]->users->name}}</span><span
                                                            class="datetime">{{$novel_group_inning_comment[0]->created_at}}</span>
                                                </div>
                                                <div class="comment-btns"><a href="#mode_nav">댓글</a><a href="#mode_nav">수정</a><a
                                                            href="#mode_nav">삭제</a><a href="#mode_nav">신고</a></div>
                                                <div class="comment-content">
                                                    <p>{{$novel_group_inning_comment[0]->comment}}</p>
                                                </div>
                                            </div>
                                        </li>
                                        @foreach($novel_group_inning_comments[$loop->index]['children'] as $novel_group_inning_comment_reply)
                                            <li>
                                                <div class="comment-wrap is-reply">
                                                    <div class="comment-info"><span
                                                                class="writer is-author">{{$novel_group_inning_comment_reply->users->name}}</span><span
                                                                class="datetime">{{$novel_group_inning_comment_reply->created_at}}</span>
                                                    </div>
                                                    <div class="comment-btns"><a href="#mode_nav">댓글</a><a
                                                                href="#mode_nav">신고</a></div>
                                                    <div class="comment-content">
                                                        <p>{{$novel_group_inning_comment_reply->comment}}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endforeach
                                @else
                                    <li>
                                        <div class="comment-wrap">
                                            <p class="no-data">
                                                <i class="no-data-icon"></i>
                                                첫 번째 댓글을 작성해 보세요.
                                            </p>
                                        </div>
                                    </li>
                                @endif

                            </ul>
                            <!-- TOP버튼 -->
                            <a href="#original" class="gotop-btn"><i class="gotop-icon"></i>Top</a>
                        </div>
                    </section>
                    <!-- //댓글목록 -->

                </article>
                <!-- //연재상세 -->
            </div>
            <!-- //서브컨텐츠 -->
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
            el: '#inning',
            data: {
                info: {comment: '', novel_id: '{{$novel_group_inning->id}}'}
            },

            methods: {
                commentStore: function () {

                    app.$http.post('{{ route('comments.store') }}', this.info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {
                                location.reload();

                            }).catch(function (errors) {
                                console.log(errors);
                            });
                }
            }
        });

    </script>
@endsection