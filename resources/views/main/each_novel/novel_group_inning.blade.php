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
                                <h1 class="series-title"><a
                                            href="{{ route('each_novel.novel_group', ['id' => $novel_group_inning->novel_groups->id]) }}">{{ $novel_group_inning->novel_groups->title }}</a>
                                </h1>

                                <p class="episode-title">
                                    <a  href="{{ route('each_novel.novel_group', ['id' => $novel_group_inning->novel_groups->id]) }}" > {{ $novel_group_inning->title }}</a></p>
                            </div>
                            <div class="controls">
                                    <span class="more-btn">
                                        <a id="inning_title" v-on:click="getOtherNovels()" style="cursor:pointer;"><i
                                                    class="arrow-icon">다른
                                                회차보기</i></a></span>

                                @if(Auth::check() && Auth::user()->id == $novel_group_inning->user_id)
                                    <span class="setup-btn"> <a
                                                href="{{route('author.inning.update',['id' => $novel_group_inning->id ]) }}"><i
                                                    class="setup2-icon">설정</i></a></span>
                                @endif
                            </div>
                        </header>
                        <div id="other_novels" class="other-novels">
                            <div v-on:click="goto_novel_inning(other_novel.id.toString())" class="novel-hover"
                                 v-for=" other_novel in other_novels">
                                <div class="novel-row"> @{{ other_novel.title.toString() }}</div>

                            </div>

                        </div>
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
                                <?php echo nl2br($novel_group_inning->author_comment, false); ?>
                            </div>
                        </div>
                        <!-- //작가의말 -->
                        <div class="episode-content-btns">

                            @if($show_favorite)
                                <a v-on:click="addToFavorite('{{$novel_group_inning->novel_group_id}}')"
                                   id="add_favorite" style="display:none;cursor:pointer;"><i class="scrap-icon"></i>
                                    선호작추가</a>

                                <a class="is-active" v-on:click="removeFromFavorite()" id="remove_favorite"
                                   style="cursor:pointer;">
                                    <i class="scrap-active-icon"></i> 선호작추가</a>

                            @else
                                <a v-on:click="addToFavorite('{{$novel_group_inning->novel_group_id}}')"
                                   id="add_favorite" style="cursor:pointer;"><i class="scrap-icon"></i> 선호작추가</a>

                                <a class="is-active" v-on:click="removeFromFavorite()" id="remove_favorite"
                                   style="display:none;cursor:pointer;"><i class="scrap-active-icon"></i> 선호작추가</a>
                            @endif

                            <a href="#share_form" data-modal-id="share_form"><i class="share2-icon"></i> 공유하기</a>

                            <a href="{{route('mails.create',['id'=>$novel_group_inning->user_id])}}"
                               class="memo-btn"><i class="memo2-icon"></i> 작가에게 쪽지 보내기</a>

                            <div class="right-btns">
                                <a href="{{ route('accusations', ['id' => $novel_group_inning->user_id]) }}"
                                   class="report-btn"><i class="report-icon"></i> 게시물 신고</a>
                            </div>
                        </div>
                        <!-- 이전다음버튼 -->
                        <div class="prev-next-episode">
                            @if($prev_inning_id)
                                <a href="{{ route('each_novel.novel_group_inning', ['id' => $prev_inning_id]) }}"
                                   class="prev-btn"><i class="prev-episode-icon">이전회</i></a>
                            @endif
                            @if($next_inning_id)
                                <a href="{{ route('each_novel.novel_group_inning', ['id' => $next_inning_id]) }}"
                                   class="next-btn"><i class="next-episode-icon">다음회</i></a>
                            @endif
                        </div>
                        <!-- //이전다음버튼 -->
                    </div>
                    <!-- //원글 -->
                    @if(Session::has('flash_message'))
                        {{-- important, success, warning, danger and info --}}
                        <div class="alert alert-@if(Session::has('flash_message_level')){{Session('flash_message_level')}} @endif "
                             style="margin-top:1%; ">
                            {{Session('flash_message')}}
                        </div>
                    @endif
                    <div class="alert alert-danger" id="validateError" style="display:none;margin-top:1%;">
                        <ul>
                            <li v-if="errorsInfo['comment']">@{{ errorsInfo.comment.toString() }}</li>
                        </ul>
                    </div>

                    <!-- 댓글쓰기 -->
                    <div class="episode-comment-form">
                        <form name="comment_form" id="comment_form" action="" class="comment-form"
                              method="post" v-on:submit.prevent="commentStore()">
                            <div class="comment-form-wrap">
                                 <textarea name="comment" id="comment" class="textarea2" v-model="info.comment"
                                           placeholder="남을 상처주지 않는 바르고 고운 말을 씁시다."
                                           title="댓글내용">{{ old('comment') }}</textarea>
                                {{--    <input type="hidden" name="novel_id" id="novel_id"  v-model="info.novel_id"/>--}}
                                {{-- <input type="hidden" name="parent_id" id="parent_id"  v-model="info.parent_id" value="0"/>--}}

                                <div class="comment-form-btns">
                                       <span class="options">
                                           <label class="checkbox2"><input name="comment_secret" id="comment_secret"
                                                                           v-model="info.comment_secret"
                                                                           type="checkbox">
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
                                            <li>
                                                <a href="{{ route('each_novel.novel_group_inning', ['id' => $novel_group_inning->id]).'?order=latest' }}"
                                                   @if($order == 'latest' or $order == null ) class="is-active" @endif>최신순</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('each_novel.novel_group_inning', ['id' => $novel_group_inning->id]).'?order=older' }}"
                                                   @if($order == 'older') class="is-active" @endif>등록순</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- //댓글정렬 -->
                            </div>
                            <ul class="comment-list">
                                @if(count($novel_group_inning_comments) >0)
                                    @foreach($novel_group_inning_comments as $novel_group_inning_comment)
                                        {{--  @if( ($novel_group_inning_comment[0]->comment_secret ==true && $novel_group_inning_comment[0]->user_id != Auth::user()->id) and ($novel_group_inning_comment[0]->comment_secret ==true && $novel_group_inning->user_id != Auth::user()->id))
                                              비밀글 입니다
                                              @continue;
                                          @endif--}}
                                        <li>
                                            <div class="comment-wrap">
                                                <div class="comment-info"><span
                                                            class="writer">{{$novel_group_inning_comment[0]->users->name}}</span><span
                                                            class="datetime"
                                                            style="padding-right:1px;">{{$novel_group_inning_comment[0]->created_at}}</span>
                                                    @if($novel_group_inning_comment[0]->comment_secret ==true)
                                                        <span> <i class="fa fa-user-secret"
                                                                  aria-hidden="true"></i></span>
                                                    @endif
                                                </div>
                                                @if(Auth::check())
                                                    @if( ($novel_group_inning_comment[0]->comment_secret ==true && $novel_group_inning_comment[0]->user_id != Auth::user()->id) and ($novel_group_inning_comment[0]->comment_secret ==true && $novel_group_inning->user_id != Auth::user()->id))
                                                        <div class="comment-content">
                                                            <p> 비밀글 입니다</p>
                                                        </div>
                                                    @else


                                                        <div class="comment-btns">
                                                            <a v-on:click="new_box_show({{$novel_group_inning_comment[0]->id}})"
                                                               style="cursor: pointer;">댓글</a>

                                                            @if(Auth::user()->id == $novel_group_inning_comment[0]->user_id  )

                                                                <a v-on:click="update_box_show({{$novel_group_inning_comment[0]->id}})"
                                                                   style="cursor: pointer;">수정</a>
                                                                <a v-on:click="commentDelete('{{$novel_group_inning_comment[0]->id}}')"
                                                                   style="cursor: pointer;">삭제</a>

                                                            @endif
                                                            <a href="{{ route('accusations', ['id' => $novel_group_inning_comment[0]->users->id]) }}">신고</a>
                                                        </div>

                                                        <div class="comment-content" v-show="!display.status">
                                                            <p> {{$novel_group_inning_comment[0]->comment}}</p>
                                                        </div>
                                                    @endif
                                                @else
                                                    @if($novel_group_inning_comment[0]->comment_secret ==true)
                                                        <div class="comment-content">
                                                            <p> 비밀글 입니다</p>
                                                        </div>

                                                    @else
                                                        <div class="comment-content">
                                                            <p> {{$novel_group_inning_comment[0]->comment}}</p>
                                                        </div>
                                                    @endif
                                                @endif

                                                <div class="comment-content " style="display:none;"
                                                     v-show="new_box_display.status"
                                                     id="comment_box{{$novel_group_inning_comment[0]->id}}"
                                                     v-if="new_box_display.id =={{$novel_group_inning_comment[0]->id}}">
                                                     <textarea name="comment"
                                                               id="comment{{$novel_group_inning_comment[0]->id}}"
                                                               v-model="sub_info.comment" rows="3"
                                                               style="width:65%;">
                                                     </textarea>

                                                    <input type="hidden" name="parent_id"
                                                           id="parent_id{{$novel_group_inning_comment[0]->id}}"
                                                           value="{{$novel_group_inning_comment[0]->id}}"/>

                                                    <button name="submit"
                                                            id="edit{{$novel_group_inning_comment[0]->id}}"
                                                            v-on:click="subCommentStore('{{$novel_group_inning_comment[0]->id}}')"
                                                            class="btn btn-primary inline"
                                                            style="width:100px;height:57px;vertical-align: top;">
                                                        댓글
                                                    </button>
                                                    <br>
                                                     <span class="options">
                                                        <label class="checkbox2">
                                                            <input name="comment_secret"
                                                                   id="comment_secret{{$novel_group_inning_comment[0]->id}}"
                                                                   type="checkbox"
                                                                   v-model="sub_info.comment_secret">
                                                            <span>비밀글</span></label>
                                                       </span>
                                                   <span style="margin-left: 2%;"
                                                         id="error{{$novel_group_inning_comment[0]->id}}"></span>

                                                </div>

                                                <div class="comment-content " style="display:none;"
                                                     v-show="display.status"
                                                     id="comment_box{{$novel_group_inning_comment[0]->id}}"
                                                     v-if="display.id =={{$novel_group_inning_comment[0]->id}}">

                                                     <textarea name="comment"
                                                               id="comment{{$novel_group_inning_comment[0]->id}}"
                                                               rows="3"
                                                               style="width:65%;">{{$novel_group_inning_comment[0]->comment}}</textarea>
                                                    <button name="edit"
                                                            id="edit{{$novel_group_inning_comment[0]->id}}"
                                                            v-on:click="commentUpdate('{{$novel_group_inning_comment[0]->id}}')"
                                                            class="btn btn-primary inline"
                                                            style="width:100px;height:57px;vertical-align: top;">
                                                        수정
                                                    </button>
                                                    <br>
                                                   <span class="options">
                                                    <label class="checkbox2">
                                                        <input name="comment_secret"
                                                               id="comment_secret{{$novel_group_inning_comment[0]->id}}"
                                                               type="checkbox"
                                                               @if($novel_group_inning_comment[0]->comment_secret) checked @endif>
                                                        <span>비밀글</span></label>
                                                   </span>
                                                    <span style="margin-left: 2%;"
                                                          id="error{{$novel_group_inning_comment[0]->id}}"></span>
                                                </div>


                                            </div>
                                        </li>
                                        @foreach($novel_group_inning_comments[$loop->index]['children'] as $novel_group_inning_comment_reply)

                                            <li>
                                                <div class="comment-wrap is-reply">
                                                    <div class="comment-info"><span
                                                                class="writer is-author">{{$novel_group_inning_comment_reply->users->name}}</span><span
                                                                class="datetime"
                                                                style="padding-right:1px;">{{$novel_group_inning_comment_reply->created_at}}</span>
                                                        @if($novel_group_inning_comment_reply->comment_secret ==true)
                                                            <i class="fa fa-user-secret" aria-hidden="true"></i>
                                                        @endif
                                                    </div>
                                                    @if(Auth::check())
                                                        @if( ($novel_group_inning_comment_reply->comment_secret ==true && $novel_group_inning_comment_reply->user_id != Auth::user()->id) and ($novel_group_inning_comment_reply->comment_secret ==true && $novel_group_inning->user_id != Auth::user()->id))
                                                            <div class="comment-content">
                                                                <p> 비밀글 입니다</p>
                                                            </div>
                                                        @else
                                                            <div class="comment-btns">
                                                                @if(Auth::user()->id == $novel_group_inning_comment_reply->user_id  )
                                                                    <a v-on:click="update_box_show({{$novel_group_inning_comment_reply->id}})"
                                                                       style="cursor: pointer;">수정</a>
                                                                    <a v-on:click="commentDelete('{{$novel_group_inning_comment_reply->id}}')"
                                                                       style="cursor: pointer;">삭제</a>
                                                                @endif
                                                                <a href="{{ route('accusations', ['id' => $novel_group_inning_comment_reply->users->id]) }}">신고</a>
                                                            </div>
                                                            <div class="comment-content" v-show="!display.status">
                                                                <p>{{$novel_group_inning_comment_reply->comment}}</p>
                                                            </div>
                                                        @endif
                                                    @else
                                                        @if($novel_group_inning_comment_reply->comment_secret ==true)
                                                            <div class="comment-content">
                                                                <p>비밀글 입니다</p>
                                                            </div>

                                                        @else
                                                            <div class="comment-content">
                                                                <p>{{$novel_group_inning_comment_reply->comment}}</p>
                                                            </div>
                                                        @endif
                                                    @endif

                                                    <div class="comment-content " style="display:none;"
                                                         v-show="display.status"
                                                         id="comment_box{{$novel_group_inning_comment_reply->id}}"
                                                         v-if="display.id =={{$novel_group_inning_comment_reply->id}}">

                                                         <textarea name="comment"
                                                                   id="comment{{$novel_group_inning_comment_reply->id}}"
                                                                   rows="3" style="width:65%;"> {{$novel_group_inning_comment_reply->comment}}
                                                         </textarea>
                                                        <button name="edit"
                                                                id="edit{{$novel_group_inning_comment_reply->id}}"
                                                                v-on:click="commentUpdate('{{$novel_group_inning_comment_reply->id}}')"
                                                                class="btn btn-primary inline"
                                                                style="width:100px;height:57px;vertical-align: top;">
                                                            수정
                                                        </button>
                                                        <br>
                                                       <span class="options">
                                                        <label class="checkbox2">
                                                            <input name="comment_secret"
                                                                   id="comment_secret{{$novel_group_inning_comment_reply->id}}"
                                                                   type="checkbox"
                                                                   @if($novel_group_inning_comment_reply->comment_secret) checked @endif>
                                                            <span>비밀글</span></label>
                                                       </span>
                                                        <span style="margin-left: 2%;"
                                                              id="error{{$novel_group_inning_comment_reply->id}}"></span>
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
    <!-- Social Share-->
    @section('header')
    @include('social_share', ['url' =>route('each_novel.novel_group_inning', $novel_group_inning->id),'title'=>$novel_group_inning->title,'thumbnail'=>''])
    @endsection
            <!--Social Share -->
    <script type="text/javascript">
        var app = new Vue({
            el: '#inning',
            data: {
                info: {comment: '', novel_id: '{{$novel_group_inning->id}}', comment_secret: ''},
                sub_info: {comment: '', novel_id: '{{$novel_group_inning->id}}', comment_secret: '', parent_id: ''},
                favorites_info: {novel_group_id: ''},
                update_info: {comment: '', comment_secret: ''},
                errorsInfo: {},
                display: {id: '', status: false},
                new_box_display: {id: '', status: false},
                other_novels: {}
            },
            methods: {

                update_box_show: function (comment_id) {
                    if (this.display.id == comment_id && this.display.status == true) {
                        //Hide update comment box if already shown
                        this.display.status = false;
                        this.display.id = 0;
                    } else {

                        //Show update comment box
                        this.display.id = comment_id;
                        this.display.status = true;

                        //hide new comment box when clicked on update
                        this.new_box_display.status = false;

                    }


                },

                new_box_show: function (comment_id) {

                    if (this.new_box_display.id == comment_id && this.new_box_display.status == true) {
                        //Hide new comment box if already shown
                        this.new_box_display.status = false;
                        this.new_box_display.id = 0;
                    } else {
                        //Show new comment box
                        this.new_box_display.id = comment_id;
                        this.new_box_display.status = true;
                        //hide update comment box when clicked on comment
                        this.display.status = false;

                    }


                },

                commentStore: function () {
                    console.log(this.info);
                    if (this.info.comment_secret == '') {
                        this.info.comment_secret = false;
                    }
                    app.$http.post('{{ route('comments.store') }}', this.info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {
                                location.reload();

                            }).catch(function (errors) {
                                this.errorsInfo = errors.data;
                                if (this.errorsInfo.error) {
                                    window.location.assign('/login?loginView=true');
                                    exit();
                                }

                                $('#validateError').show();
                            });
                },

                subCommentStore: function (comment_id) {
                    app.sub_info.parent_id = $('#parent_id' + comment_id).val();
                    app.sub_info.comment_secret = $('#comment_secret' + comment_id).is(':checked');
                    app.$http.post('{{ route('comments.store') }}', app.sub_info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
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
                },

                commentUpdate: function (comment_id) {
                    app.update_info.comment = $('#comment' + comment_id).val();
                    app.update_info.comment_secret = $('#comment_secret' + comment_id).is(':checked');

                    app.$http.put('{{ url('comments') }}/' + comment_id, app.update_info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {
                                console.log(response);
                                location.reload();
                            })
                            .catch(function (errors) {
                                this.errorsInfo = errors.data;
                                // $('#validateError').show();
                                $("#error" + comment_id).text(errors.data['comment']);
                                /*     $("#error"+comment_id).delay(5000).slideUp(200, function () {
                                 $(this).alert('close');
                                 });*/

                            });
                },

                commentDelete: function (comment_id) {
                    if (confirm('삭제 하시겠습니까?')) {
                        app.$http.delete('{{ url('comments') }}/' + comment_id, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                                .then(function (response) {
                                    location.reload();
                                })
                                .catch(function (errors) {

                                    window.location.assign('/login?loginView=true');
                                });
                    }
                },

                addToFavorite: function (novel_group_id) {
                    app.favorites_info.novel_group_id = novel_group_id;
                    app.$http.post('{{ route('favorites.store') }}', app.favorites_info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {
                                $('#add_favorite').hide();
                                $('#remove_favorite').show();
                                //  location.reload();
                            })
                            .catch(function (errors) {
                                window.location.assign('/login?loginView=true');
                            });
                },
                removeFromFavorite: function () {
                    app.$http.delete('{{ route('favorites.destroy',['id'=>$novel_group_inning->novel_group_id]) }}', {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {
                                $('#add_favorite').show();
                                $('#remove_favorite').hide();
                                //location.reload();
                            })
                            .catch(function (errors) {

                                window.location.assign('/login?loginView=true');
                            });
                },
                getOtherNovels: function () {


                    app.$http.get('{{ route('novelgroup.novel',['id'=>$novel_group_inning->novel_group_id]) }}')
                            .then(function (response) {
                                this.other_novels = response.data;
                                $('#other_novels').show();
                            })
                            .catch(function (errors) {
                                // window.location.assign('/login?loginView=true');
                            });
                },
                goto_novel_inning: function (id) {
                    window.location.assign('{{url('novel_group_inning')}}/' + id);
                }
            }
        });

        // If an event gets to the body
        $("body").click(function () {
            $('#other_novels').hide();

        });
        $('#other_novels').click(function (e) {
            e.stopPropagation();
        });


        $(".alert").delay(5000).slideUp(200, function () {
            $(this).alert('close');
        });


    </script>
@endsection