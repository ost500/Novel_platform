@extends('layouts.main_layout')
@section('content')
        <!-- 컨테이너 -->
<div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="wrap" id="review_comments">
        <!-- LNB -->

        <div class="lnb">
            <nav>
                <h2 class="lnb-title">커뮤니티</h2>
                <ul class="lnb-depth1">
                    <li>
                        <a href="{{route('free_board')}}">자유게시판</a>
                    </li>
                    <li>


                        <a href="{{route('reader_reco')}}" class="is-active">독자추천</a><br>
                        <a href="{{route('reader_reco')}}"
                           @if($genre=='%')class="is-active lnb-depth1-2"
                           @else class="lnb-depth1-2" @endif>전체</a><br>
                        <a href="{{route('reader_reco')}}?genre=현대"
                           @if($genre=='현대판타지' || $genre == '현대')class="is-active lnb-depth1-2"
                           @else class="lnb-depth1-2"@endif>현대로맨스</a>
                        <ul class="lnb-depth2">
                            @if($genre=='현대판타지' || $genre == '현대')
                                <li><a href="{{route('reader_reco')}}?genre=현대"
                                       @if($genre=='현대')class="is-active"@endif>현대</a></li>
                                <li><a href="{{route('reader_reco')}}?genre=현대판타지"
                                       @if($genre=='현대판타지')class="is-active"@endif>현대판타지</a></li>
                            @endif
                        </ul>
                        <a href="{{route('reader_reco')}}?genre=시대"
                           @if(($genre=='시대' or $genre == '사극' or $genre == '동양판타지'))class="is-active lnb-depth1-2"
                           @else class="lnb-depth1-2"@endif>시대로맨스</a>
                        <ul class="lnb-depth2">
                            @if(($genre=='시대' or $genre == '사극' or $genre == '동양판타지'))
                                <li><a href="{{route('reader_reco')}}?genre=시대"
                                       @if($genre=='시대')class="is-active"@endif>시대</a></li>
                                <li><a href="{{route('reader_reco')}}?genre=사극"
                                       @if($genre=='사극')class="is-active"@endif>사극</a></li>
                                <li><a href="{{route('reader_reco')}}?genre=동양판타지"
                                       @if($genre=='동양판타지')class="is-active"@endif>동양판타지</a></li>
                            @endif
                        </ul>
                        <a href="{{route('reader_reco')}}?genre=서양역사"
                           @if(($genre=='서양역사' or $genre == '로맨스판타지'))class="is-active lnb-depth1-2"
                           @else class="lnb-depth1-2"@endif>서양역사</a>
                        <ul class="lnb-depth2">
                            @if(($genre=='서양역사' or $genre == '로맨스판타지'))
                                <li><a href="{{route('reader_reco')}}?genre=서양역사"
                                       @if($genre=='서양역사')class="is-active"@endif>서양역사</a></li>
                                <li><a href="{{route('reader_reco')}}?genre=로맨스판타지"
                                       @if($genre=='로맨스판타지')class="is-active"@endif>로맨스판타지</a></li>
                            @endif
                        </ul>
                    </li>
                </ul>

            </nav>
        </div>
        <!-- //LNB -->

        <!-- 서브컨텐츠 -->
        <div class="content" id="content">
            <!-- 연재소개 -->
            @if(Session::has('flash_message'))
                {{-- important, success, warning, danger and info --}}
                <div class="alert alert-success">
                    {{Session('flash_message')}}
                </div>
            @endif
            <section class="novel-detail novel-detail--bbs">
                <div class="novel-detail-content">
                    <p class="thumb"><span><img style="width: 138px; height: 206px;"
                                                src="/img/novel_covers/{{$review->novel_groups->cover_photo}}"
                                                alt="망의 연월"></span></p>

                    <div class="post">
                        <div class="post-header">
                            <h2 class="title"><a
                                        href="{{ route('each_novel.novel_group', ['id' => $review->novel_groups->id]) }}">{{ $review->novel_groups->title }}</a>
                            </h2>

                            <p class="writer">{{ $review->novel_groups->users->name }}<a href="{{ route('mails.create', ['id' =>$review->novel_groups->users->id]) }}"><i
                                            class="memo-icon"></i><span
                                            class="hidden">쪽지</span></a></p>

                            <p class="post-info">
                                <span>{{$review->novel_groups->keywords[0]->name}}</span>
                                <span>총 {{$review->novel_groups->novels->count()}}화</span>
                                <span>조회수 {{ $review->total_count }}</span>
                                <span>선호작 {{ $review->novel_groups->favorites->count() }}명</span>
                            </p>
                        </div>
                        <div class="post-content">
                            <p>
                                <?php echo substr(nl2br($review->novel_groups->description), 0, 59) ?>
                                <button class="more-btn hidden-content-view">더보기</button>
                                <span class="hidden-content"><?php echo substr(nl2br($review->novel_groups->description), 59) ?></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="novel-view"><a href="#mode_nav" class="btn btn--special">첫화보기</a></div>
                <div class="scrap-btns">

                </div>
            </section>
            <!-- //연재소개 -->

            <!-- 게시판상세 -->
            <article class="bbs-view">
                <h2 class="bbs-view-title">{{ $review->review_title }}</h2>

                <div class="bbs-view-info">
                    <div class="writer">{{ $review->users->name }}</div>
                    <div class="etc">
                        <span>작성일 {{ $review->created_at }}</span>
                        <span>조회수 {{ $review->view_count }}</span>
                    </div>
                </div>

                @if(Auth::check() && Auth::user()->id == $review->user_id)
                <div class="bbs-view-manage"><a href="{{route('reader_reco.edit',['id' => $review->review_id ]) }}"><i
                                class="setup-icon"></i><span
                                class="hidden">수정</span></a>
                </div>
                @endif
                        <!-- 게시물본문 -->
                <div class="bbs-view-content">
                    <?php echo nl2br($review->review); ?>
                </div>
                <!-- //게시물본문 -->
                <div class="bbs-view-content-btns">
                    <div class="right-btns">
                        <a href="{{ route('accusations', ['id' => $review->users->id]) }}" class="report-btn"><i
                                    class="report-icon"></i>게시물 신고</a>
                    </div>
                </div>
                <div class="bbs-view-btns">
                    <a href="{{ route('reader_reco') }}" class="btn">목록</a>

                    <div class="right-btns">
                        <a href="{{route('reader_reco').'?novel_group='.$review->novel_groups->id}}"
                           class="btn btn--special">이 소설의 다른 추천 보기</a>
                        <a href="{{route('reader_reco').'?review_user='.$review->users->id}}"
                           class="btn btn--special2">작성자의 다른 추천 보기</a>
                    </div>
                </div>
                <!-- 댓글목록 -->
                <section class="bbs-comment">
                    <div class="comments">
                        <div class="comment-list-header">
                            <h2 class="title">댓글</h2>
                            <span class="count">{{ $review->comments->count() }}</span>
                            <!-- 댓글목록정렬 -->
                            <div class="sort-nav sort-nav--comment">
                                <nav>
                                    <ul>
                                        <li>
                                            <a href="{{ route('reader_reco.detail', ['id' => $review->id]).'?order=latest' }}"
                                               @if($order == 'latest' or $order == null ) class="is-active" @endif>최신순</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('reader_reco.detail', ['id' => $review->id]).'?order=oldest' }}"
                                               @if($order == 'oldest') class="is-active" @endif>등록순</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- //작품목록정렬 -->
                        </div>
                        <ul class="comment-list">
                            @foreach ($review_comments as $comment)
                                <li>
                                    <div class="comment-wrap">
                                        <div class="comment-info"><span
                                                    class="writer">{{ $comment[0]->users->name }}</span> <span
                                                    class="datetime">{{ $comment[0]->created_at }}</span>
                                        </div>
                                        <div class="comment-btns"><a  v-on:click="new_box_show({{$comment[0]->id}})"
                                                                      style="cursor: pointer;">답글</a><a
                                                    href="{{ route('accusations', ['id' => $comment[0]->users->id]) }}">신고</a>
                                        </div>
                                        <div class="comment-content">
                                            <p><?php echo nl2br($comment[0]->comment); ?></p>
                                        </div>
                                        <div class="comment-content " style="display:none;"
                                             v-show="new_box_display.status"
                                             id="comment_box{{$comment[0]->id}}"
                                             v-if="new_box_display.id =={{$comment[0]->id}}">
                                                     <textarea name="comment"
                                                               id="comment{{$comment[0]->id}}"
                                                               v-model="sub_info.comment" rows="3"
                                                               style="width:65%;">
                                                     </textarea>

                                            <input type="hidden" name="parent_id"
                                                   id="parent_id{{$comment[0]->id}}"
                                                   value="{{$comment[0]->id}}"/>

                                            <button name="submit"
                                                    id="edit{{$comment[0]->id}}"
                                                    v-on:click="subCommentStore('{{$comment[0]->id}}')"
                                                    class="btn btn-primary inline"
                                                    style="width:100px;height:57px;vertical-align: top;">
                                                댓글
                                            </button>
                                            <br>
                                            <span style="margin-left: 2%;" id="error{{$comment[0]->id}}"></span>

                                        </div>
                                    </div>
                                </li>
                                @foreach($review_comments[$loop->index]['children'] as $comment_reply)
                                    <li>
                                        <div class="comment-wrap is-reply">
                                            <div class="comment-info"><span
                                                        class="writer">{{ $comment_reply['users']['name'] }}</span><span
                                                        class="datetime">{{ $comment_reply->created_at }}</span></div>
                                            <div class="comment-btns">
                                                <a href="{{ route('accusations', ['id' => $comment_reply->users->id]) }}">신고</a>
                                            </div>
                                            <div class="comment-content">
                                                <p><?php echo nl2br($comment_reply->comment); ?></p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @endforeach
                        </ul>
                    </div>
                </section>
                <!-- //댓글목록 -->
                <!-- 댓글쓰기 -->
                <div class="bbs-comment-form">
                    <form
                            method="post"
                            action="{{route('reader_reco.comment',['id'=>$review->review_id])}}"

                            class="comment-form">
                        {!! csrf_field() !!}
                        <div class="comment-form-wrap">
                                <textarea name="comment" class="textarea2" placeholder="남을 상처주지 않는 바르고 고운 말을 씁시다."
                                          title="댓글내용"
                                          @if($errors->count() > 0)autofocus @endif>{{ old('comment') }}</textarea>

                            <div class="comment-form-btns">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                <span class="submit">
                                    <button type="submit" class="btn">등록</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- //댓글쓰기 -->
            </article>
            <!-- //게시판상세 -->
            <!-- 이전글다음글 -->
            <ul class="prev-next">
                @if($prev_review != null)
                    <li>
                        <span class="head head--prev">이전글</span>
                            <span class="subject"><a
                                        href="{{ route('reader_reco.detail',['id' => $prev_review->id]) }}">{{ $prev_review->title }}</a></span>
                        <span class="writer">{{ $prev_review->users->name }}</span>
                        <span class="datetime">{{ $prev_review->created_at->format('Y-m-d') }}</span>
                    </li>
                @endif
                @if($next_review != null)
                    <li>
                        <span class="head head--next">다음글</span>
                            <span class="subject"><a
                                        href="{{ route('reader_reco.detail',['id' => $next_review->id]) }}">{{ $next_review->title }}</a></span>
                        <span class="writer">{{ $next_review->users->name }}</span>
                        <span class="datetime">{{ $next_review->created_at->format('Y-m-d') }}</span>
                    </li>
                @endif

            </ul>
            <!-- //이전글다음글 -->
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
        el: '#review_comments',
        data: {

            sub_info: {comment: '', parent_id: ''},
            new_box_display: {id: '', status: false}
        },
        methods: {


            new_box_show: function (comment_id) {

                if (this.new_box_display.id == comment_id && this.new_box_display.status == true) {
                    //Hide new comment box if already shown
                    this.new_box_display.status = false;
                    this.new_box_display.id = 0;
                } else {
                    //Show new comment box
                    this.new_box_display.id = comment_id;
                    this.new_box_display.status = true;

                }


            },
            subCommentStore: function (comment_id) {
                app.sub_info.parent_id = $('#parent_id' + comment_id).val();
                app.$http.post('{{route('reader_reco.comment',['id'=>$review->review_id])}}', app.sub_info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                        .then(function (response) {
                            location.reload();

                        }).catch(function (errors) {
                            this.errorsInfo = errors.data;
                            if (this.errorsInfo.error) {
                                window.location.assign('/login?loginView=true');
                                exit();
                            }
                            $("#error" + comment_id).text(errors.data['comment']);
                            //  $('#validateError').show();
                        });
            }
        }
    });
</script>
@endsection