@extends('layouts.main_layout')
@section('content')
    <div class="container container--novel">
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
                                {{$novel_group_inning->content}}
                            </p>

                            <p>
                                한때는 이 나라에서 제일 귀했던 여인이 이 어두컴컴한 곳에 갇혀 있었다.
                            </p>

                            <p>
                                여인의 이름은 엘린느.
                            </p>

                            <p>
                                제국을 받치는 세 개의 기둥인 플로레르 공작가의 공녀였다. 원래대로라면 황후가 되었어야할, 황태자의 약혼녀.
                            </p>

                            <p>
                                나는…… 왜 여기 있지.
                            </p>

                            <p>
                                엘린느는 파랗게 질린 입술을 떨며 몸을 웅크렸다. 풍성하게 펼쳐진 은색의 드레스 위로 순금을 녹여 가느다랗게 뽑아낸 것 같은 백금발의 머리카락이 아래로
                                흘러내렸다. 여신께서 추앙하셨다는 천상의 미. 그토록 여신이 아낀다는 보라색까지 눈동자로 같이 내려주셨지만.
                            </p>

                            <p>
                                제국의 달은, 제가 아니었다.
                            </p>

                            <p>
                                내가 있어야 할 곳은…… 이곳이 아닌데.
                            </p>

                            <p>
                                엘린느는 몸을 웅크렸다.
                            </p>

                            <p>
                                오 년. 오 년이었다. 누군가를 사랑하고 마음에 품은 나이. 처음 만났을 때부터 엘린느는 황태자가 좋았다. 제 유일한 반려라고 생각했다. 그래서 그의 곁에
                                있으려 노력했다.
                            </p>

                            <p>
                                피나는 노력으로 예법과 교양을 익히고 미래의 황후로써 한치의 소홀함도 놓치지 않았다. 그의 옆에 서기 위해 노력했다. 그랬는데.
                            </p>

                            <p>
                                당연하게 생각했던 저의 자리를 잃어버렸다.
                            </p>

                            <p>
                                뎅.
                            </p>

                            <p>
                                멀리서 커다랗게 종소리가 울렸다. 황제의 반려인 황후가 드디어 정해졌다는 의미였다. 손바닥만큼 열려있는 작은 창문 사이로 커다란 함성 소리가 들려왔다. 모든
                                이들이 기뻐하고 있었다.
                            </p>

                            <p>
                                자신만 빼고.
                            </p>

                            <p>
                                엘린느는 비틀비틀 몸을 일으켰다.
                            </p>

                            <p>
                                “하, 하하…….”
                            </p>

                            <p>
                                엘린느는 자신도 모르게 웃음을 터트렸다. 눈부시게 빛나는 하늘이 파랬다. 세상 모든 것들이 전부 다 황제와 황후를 축복해 주는 것만 같았다. 제 세상은 그날
                                이후로 멈춰 있는데, 그에게 부정당한 날로부터 움직이질 않는데.
                            </p>

                            <p>
                                엘린느는 고개를 숙여 손에 끼고 있던 반지를 보았다.
                            </p>

                            <p>
                                가주의 인장.
                            </p>

                            <p>
                                핏줄이 하나밖에 남지 않은, 플로레르 공작가의 유일한 후계자가 바로 자신이었다. 제가 황후가 되었다면 공작가는 문을 닫았을 것이다. 그마저도 감수할 정도로
                                그를 사랑했다.
                            </p>

                            <p>
                                사랑…… 했었다.
                            </p>

                            <p>
                                달칵.
                            </p>

                            <p>
                                손에 끼고 있던 반지를 돌리자 뾰족한 침이 나왔다. 가주의 인장 안에 숨겨진, 또 다른 기능이었다. 엘린느는 반지를 들어 목덜미에 가져다 댔다.
                            </p>

                            <p>
                                푸욱.
                            </p>

                            <p>
                                여린 살 끝을 타고 독이 몸에 퍼지기 시작했다. 휘청거리는 몸에 힘을 주며 엘
                                린느는 두 손을 맞잡아 기도했다.
                            </p>

                            <p>
                                여신이시여.
                            </p>

                            <p>
                                눈앞이 뿌옇게 흐려졌다.
                            </p>

                            <p>
                                만일, 제게 다시 한 번의 기회가 주어진다면, 그때는.
                            </p>

                            <p>
                                한줄기 눈물이 볼을 타고 흘러내렸다.
                            </p>

                            <p>
                                그때는…… 당신을…….<br><br><br>
                            </p>

                            <p>
                                “간수!”
                            </p>

                            <p>
                                어수선한 발소리가 감옥 안으로 뛰쳐 들어왔다. 급하게 문을 열고 들어온 그곳엔 핏물만 가득할 뿐, 머리카락 한점 남은 것이 없었다.
                            </p>

                            <p>
                                제국의 꽃이자 한때는 미래의 황후로 내정되어 있었던 엘린느 라 플로레르.
                            </p>

                            <p>
                                새 황후의 즉위식 날, 감옥에서 스스로 죽음을 맞이하다.
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
                        <form name="comment_form" action="{{route('comments.store')}}" class="comment-form"
                              method="post">
                            {{csrf_field()}}
                            <div class="comment-form-wrap">
                                <textarea name="comment" id="comment" class="textarea2"
                                          placeholder="남을 상처주지 않는 바르고 고운 말을 씁시다." title="댓글내용"></textarea>
                                <input type="hidden" name="novel_id" id="novel_id" value="{{$novel_group_inning->id}}"/>
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
        </div>
    </div>
    <!-- //컨테이너 -->
    <!-- 푸터 -->
@endsection