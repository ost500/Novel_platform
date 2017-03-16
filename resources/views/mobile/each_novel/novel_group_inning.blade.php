@extends('layouts.mobile_layout')
@section('content')
        <!-- 내용 -->
<div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
    @include('mobile_social_share', ['url' =>route('each_novel.novel_group', $novel_group_inning->novel_groups->id),'title'=>$novel_group_inning->novel_groups->title,'thumbnail'=>''])
    <div class="cont_wrap" id="inning">
        <!-- 연재 -->
        <div class="">
            <div class="mlist_tit_rwap" style="padding-top: 45px;">
               <div style="float: left;">
                           <a href="{{ route('each_novel.novel_group', ['id' => $novel_group_inning->novel_groups->id]) }}" style="vertical-align: middle;">
                             {{--  <img src="/mobile/images/menu_icon.png" style="width:65px;"/>--}}
                               <img src="/mobile/images/menu-squares-grey.png" style="width:45px;padding: 11px 14px 0 2px;"/>
                           </a>
                        </div>
                <h2 class="mlist_tit3">

                    {{ str_limit($novel_group_inning->novel_groups->title,25) }}
                </h2>
                <span class="additional">{{ str_limit($novel_group_inning->title) }}</span>

                <div class="mlist_tbtn">
                    <a href="{{ route('each_novel.novel_group', ['id' => $novel_group_inning->novel_groups->id]) }}"><span
                                class="btn_tit down">메뉴보기</span></a>

                    @if(Auth::check() && Auth::user()->id == $novel_group_inning->user_id)
                        {{--<span class="mlist_sli"></span> <a href="{{route('author.inning.update',['id' => $novel_group_inning->id ]) }}"><span
                                     class="btn_tit adm">관리자</span></a>--}}
                    @endif
                </div>
            </div>
            <!-- 페이지 내용 -->
            <div class="bokartic_wrap">
                <!-- 본문 -->
                <div class="bokartic_bor">
                    <div class="bokarticle">
                        <?php echo nl2br($novel_group_inning->content, false); ?>
                    </div>
                    <div class="update_time">
                        작성일 {{$novel_group_inning->created_at}}<br/>
                        최종수정일 {{$novel_group_inning->updated_at}}
                    </div>
                </div>
                <!-- 본문 //-->

                <!-- 작가의 말 -->
                <div class="bokartic_bor">
                    <div class="writer_tit">작가의 말</div>
                    <div class="summary"><?php echo nl2br($novel_group_inning->author_comment, false); ?></div>
                </div>
                <!-- 작가의 말 //-->

                <!-- 공유하기 등 -->
                <div class="participation_area">
                    <div class="al_left">
                        <!--<a href="" class="icon_btn_a"><span class="icon ico_bokmark">즐겨찾기</span></a>-->
                        @if($show_favorite)
                            <a v-on:click="addToFavorite('{{$novel_group_inning->novel_group_id}}')"
                               id="add_favorite" class="icon_btn_a" style="display:none;cursor:pointer;"><span
                                        class="icon ico_bokmark">즐겨찾기</span></a>
                            <a v-on:click="removeFromFavorite('{{$novel_group_inning->novel_group_id}}')"
                               id="remove_favorite" class="icon_btn_a" style="cursor:pointer;"><span
                                        class="icon ico_bokmark_on">즐겨찾기</span></a>
                        @else
                            <a v-on:click="addToFavorite('{{$novel_group_inning->novel_group_id}}')"
                               id="add_favorite" class="icon_btn_a" style="cursor:pointer;"><span
                                        class="icon ico_bokmark">즐겨찾기</span></a>
                            <a v-on:click="removeFromFavorite('{{$novel_group_inning->novel_group_id}}')"
                               id="remove_favorite" class="icon_btn_a" style="display:none;cursor:pointer;"><span
                                        class="icon ico_bokmark_on">즐겨찾기</span></a>
                        @endif
                        <a v-on:click="showSideMenu()" class="icon_btn_a" style="cursor:pointer;"><span
                                    class="icon ico_share">공유하기</span></a>
                        <a href={{route('mails.create',['id'=>$novel_group_inning->user_id])}} class="icon_btn_a"><span
                                    class="icon ico_note">쪽지</span></a>
                    </div>
                    <div class="al_right">
                        <a href="{{ route('accusations', ['id' => $novel_group_inning->user_id]) }}" class="icon_btn_a"><span
                                    class="icon ico_alert">신고</span><span class="al_right_txt">게시물 신고</span></a>
                    </div>
                </div>
                <!-- 공유하기 등 //-->

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


                <!-- 댓글 등록 -->
                <div class="repl_write_wrap">
                    <form name="comment_form" id="comment_form" action="" class="comment-form"
                          method="post" v-on:submit.prevent="commentStore()">
                        <textarea name="comment" id="comment" v-model="info.comment" class="repl_txtar" rows="3"
                                  cols="30" placeholder="여러분의 소중한 댓글을 입력해 주세요">{{ old('comment') }}</textarea>

                        <div class="padt10">
                            <label class="checkbox-wrap">
                                <input type="checkbox" name="comment_secret" id="comment_secret"
                                       v-model="info.comment_secret"><i class="check-icon"></i>
                                <span class="marL8">비밀글</span>
                            </label>
                        </div>
                        <div class="padtb25">
                            <button type="submit" class="btn_green full">등록</button>
                        </div>
                    </form>
                </div>
                <!-- 댓글 등록 //-->

                <!-- 댓글 리스트 -->
                <div class="repl_lst_wrap">
                    <div class="replst_head">
                        <h3 class="mlist_tit4">댓글<span class="repcount">({{count($novel_group_inning->comments)}}
                                )</span></h3>

                        <div class="sort_area">
                            <a href="{{ route('each_novel.novel_group_inning', ['id' => $novel_group_inning->id]).'?order=latest' }}"
                               @if($order == 'latest' or $order == null ) class="sort_btn sort_on"
                               @else class="sort_btn sort_off" @endif>최신순</a>
                            <a href="{{ route('each_novel.novel_group_inning', ['id' => $novel_group_inning->id]).'?order=older' }}"
                               @if($order == 'older')  class="sort_btn sort_on" @else class="sort_btn sort_off" @endif>등록순</a>
                        </div>
                    </div>
                    <ul class="repl_lst">
                        @if(count($novel_group_inning_comments) >0)
                            @foreach($novel_group_inning_comments as $novel_group_inning_comment)
                                <li>
                                    <div class="replst_tit">{{$novel_group_inning_comment[0]->users->name}}<span
                                                class="replst_time">{{$novel_group_inning_comment[0]->created_at}}</span>

                                        @if($novel_group_inning_comment[0]->comment_secret ==true)
                                            <i class="fa fa-user-secret" aria-hidden="true"></i>
                                        @endif
                                    </div>
                                    @if(Auth::check())
                                        @if( ($novel_group_inning_comment[0]->comment_secret ==true && $novel_group_inning_comment[0]->user_id != Auth::user()->id) and ($novel_group_inning_comment[0]->comment_secret ==true && $novel_group_inning->user_id != Auth::user()->id))
                                            <div class="replst_cont">
                                                <p> 비밀글 입니다</p>
                                            </div>
                                        @else

                                            <div class="replst_cont" v-show="!display.status">
                                                {{$novel_group_inning_comment[0]->comment}}
                                            </div>
                                            <div class="replst_btn_wrap">
                                                <a v-on:click="new_box_show({{$novel_group_inning_comment[0]->id}})"
                                                   class="replst_btn">답글</a>
                                                @if(Auth::user()->id == $novel_group_inning_comment[0]->user_id  )
                                                    <a v-on:click="update_box_show({{$novel_group_inning_comment[0]->id}})"
                                                       class="replst_btn">수정</a>
                                                    <a v-on:click="commentDelete('{{$novel_group_inning_comment[0]->id}}')"
                                                       class="replst_btn">삭제</a>
                                                @endif
                                                <a href="{{ route('accusations', ['id' => $novel_group_inning_comment[0]->users->id]) }}"
                                                   class="replst_btn">신고</a>
                                            </div>
                                        @endif
                                    @else
                                        @if($novel_group_inning_comment[0]->comment_secret ==true)
                                            <div class="replst_tit">비밀글입니다.

                                            </div>

                                        @else
                                            <div class="replst_contt">
                                                <p> {{$novel_group_inning_comment[0]->comment}}</p>
                                            </div>
                                            @endif
                                            @endif
                                                    <!-- 댓글 등록 -->
                                            <div class="replst_cont" style="display:none;"
                                                 v-show="new_box_display.status"
                                                 id="comment_box{{$novel_group_inning_comment[0]->id}}"
                                                 v-if="new_box_display.id =={{$novel_group_inning_comment[0]->id}}">

                                          <textarea name="comment" id="comment{{$novel_group_inning_comment[0]->id}}"
                                                    v-model="sub_info.comment" rows="3"
                                                    placeholder="여러분의 소중한 댓글을 입력해 주세요">{{ old('comment') }}</textarea>
                                                <input type="hidden" name="parent_id"
                                                       id="parent_id{{$novel_group_inning_comment[0]->id}}"
                                                       value="{{$novel_group_inning_comment[0]->id}}"/>

                                                <div class="padt10">
                                                    <label class="checkbox-wrap">
                                                        <input type="checkbox" name="comment_secret"
                                                               id="comment_secret{{$novel_group_inning_comment[0]->id}}"
                                                               type="checkbox"
                                                               v-model="sub_info.comment_secret"><i
                                                                class="check-icon"></i>
                                                        <span class="marL8">비밀글</span>
                                                         <span style="margin-left: 2%;"
                                                               id="error{{$novel_group_inning_comment[0]->id}}"></span>
                                                    </label>
                                                </div>
                                                <div class="padtb25">
                                                    <button type="submit"
                                                            id="edit{{$novel_group_inning_comment[0]->id}}"
                                                            v-on:click="subCommentStore('{{$novel_group_inning_comment[0]->id}}')"
                                                            class="btn_green full">등록
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- 댓글 등록 //-->
                                            <!-- 댓글 등록 -->
                                            <div class="replst_cont" style="display:none;" v-show="display.status"
                                                 id="comment_box{{$novel_group_inning_comment[0]->id}}"
                                                 v-if="display.id =={{$novel_group_inning_comment[0]->id}}">

                                                <textarea name="comment"
                                                          id="comment{{$novel_group_inning_comment[0]->id}}"
                                                          rows="3">{{$novel_group_inning_comment[0]->comment}}</textarea>

                                                <div class="padt10">
                                                    <label class="checkbox-wrap">
                                                        <input type="checkbox" name="comment_secret"
                                                               id="comment_secret{{$novel_group_inning_comment[0]->id}}"
                                                               type="checkbox"
                                                               @if($novel_group_inning_comment[0]->comment_secret) checked @endif><i
                                                                class="check-icon"></i>
                                                        <span class="marL8">비밀글</span>
                                                         <span style="margin-left: 2%;"
                                                               id="error{{$novel_group_inning_comment[0]->id}}"></span>
                                                    </label>
                                                </div>
                                                <div class="padtb25">
                                                    <button type="submit"
                                                            id="edit{{$novel_group_inning_comment[0]->id}}"
                                                            v-on:click="commentUpdate('{{$novel_group_inning_comment[0]->id}}')"
                                                            class="btn_green full">수정
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- 댓글 등록 //-->


                                </li>
                                @foreach($novel_group_inning_comments[$loop->index]['children'] as $novel_group_inning_comment_reply)
                                    <li class="repl_lst_re">
                                        <div class="replst_tit">{{$novel_group_inning_comment_reply->users->name}}<span
                                                    class="replst_time">{{$novel_group_inning_comment_reply->created_at}}</span>
                                            @if($novel_group_inning_comment_reply->comment_secret ==true)
                                                <i class="fa fa-user-secret" aria-hidden="true"></i>
                                            @endif
                                        </div>
                                        @if(Auth::check())
                                            @if( ($novel_group_inning_comment_reply->comment_secret ==true && $novel_group_inning_comment_reply->user_id != Auth::user()->id) and ($novel_group_inning_comment_reply->comment_secret ==true && $novel_group_inning->user_id != Auth::user()->id))
                                                <div class="replst_cont">
                                                    <p> 비밀글 입니다</p>
                                                </div>
                                            @else
                                                <div class="replst_cont"
                                                     v-show="!display.status">{{$novel_group_inning_comment_reply->comment}}</div>
                                                <div class="replst_btn_wrap">
                                                    @if(Auth::user()->id == $novel_group_inning_comment_reply->user_id  )
                                                        <a v-on:click="update_box_show({{$novel_group_inning_comment_reply->id}})"
                                                           class="replst_btn">수정</a>
                                                        <a v-on:click="commentDelete('{{$novel_group_inning_comment_reply->id}}')"
                                                           class="replst_btn">삭제</a>
                                                    @endif
                                                    <a href="{{ route('accusations', ['id' => $novel_group_inning_comment_reply->users->id]) }}"
                                                       class="replst_btn">신고</a>
                                                </div>
                                            @endif
                                        @else
                                            @if($novel_group_inning_comment_reply->comment_secret ==true)
                                                <div class="replst_cont">
                                                    <p>비밀글 입니다</p>
                                                </div>

                                            @else
                                                <div class="replst_cont">
                                                    <p>{{$novel_group_inning_comment_reply->comment}}</p>
                                                </div>
                                                @endif
                                                @endif
                                                        <!-- 댓글 등록 -->
                                                <div class="replst_cont" style="display:none;"
                                                     v-show="display.status"
                                                     id="comment_box{{$novel_group_inning_comment_reply->id}}"
                                                     v-if="display.id =={{$novel_group_inning_comment_reply->id}}">

                                                     <textarea name="comment"
                                                               id="comment{{$novel_group_inning_comment_reply->id}}"
                                                               rows="3">{{$novel_group_inning_comment_reply->comment}}</textarea>

                                                    <div class="padt10">
                                                        <label class="checkbox-wrap">
                                                            <input type="checkbox" name="comment_secret"
                                                                   id="comment_secret{{$novel_group_inning_comment_reply->id}}"
                                                                   type="checkbox"
                                                                   @if($novel_group_inning_comment_reply->comment_secret) checked @endif><i
                                                                    class="check-icon"></i>
                                                            <span class="marL8">비밀글</span>
                                                         <span style="margin-left: 2%;"
                                                               id="error{{$novel_group_inning_comment_reply->id}}"></span>
                                                        </label>
                                                    </div>
                                                    <div class="padtb25">

                                                        <button type="submit"
                                                                id="edit{{$novel_group_inning_comment_reply->id}}"
                                                                v-on:click="commentUpdate('{{$novel_group_inning_comment_reply->id}}')"
                                                                class="btn_green full">수정
                                                        </button>
                                                    </div>

                                                </div>
                                                <!-- 댓글 등록 //-->

                                    </li>

                                @endforeach

                            @endforeach
                        @else
                            <ul class="repl_lst">
                                <li>
                                    <div class="noresult_wrap">첫 번째 댓글을 작성해 보세요</div>
                                </li>
                            </ul>
                        @endif

                        {{--<li>
                            <div class="replst_tit secret">비밀글입니다.<span
                                        class="replst_time">2016-06-20 23:00</span>
                            </div>
                        </li>
                        <li class="repl_lst_re">
                            <div class="replst_tit secret">비밀글입니다.<span
                                        class="replst_time">2016-06-20 23:00</span>
                            </div>
                        </li>--}}
                        {{--<li>--}}
                        {{--<div class="replst_tit alert">해당 글은 신고 접수되어 블라인드 처리 되었습니다.</div>--}}
                        {{--</li>--}}
                    </ul>
                    <div class="padt20"><a href="" class="btn_repl_more full">댓글 더보기</a></div>
                </div>
                <!-- 댓글 리스트 //-->
            </div>
            <!-- 페이지 내용 //-->
        </div>
        <!-- 연재 //-->
    </div>
</div>
<!-- 내용 //-->
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
            new_box_display: {id: '', status: false}
        },
        methods: {
            showSideMenu: function () {
                $('#socialbar').show();
            },

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
                                window.location.assign('{{ url('/login')}}');
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
                                window.location.assign('{{ url('/login')}}');
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
                                window.location.assign('{{ url('/login')}}');
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
                            window.location.assign('{{ url('/login')}}');
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
                            window.location.assign('{{ url('/login')}}');
                        });
            }
        }

    });


    /* $(".alert").delay(5000).slideUp(200, function () {
     $(this).alert('close');
     });*/


</script>
@endsection