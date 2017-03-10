@extends('../layouts.main_layout')
@section('content')

    <!-- 컨테이너 -->
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
            <div class="lnb">
                <nav>
                    <h2 class="lnb-title">쪽지</h2>
                    <ul class="lnb-depth1">
                        <li>
                            <a href="{{route('mails.received')}}"
                               class="{{!$mail->spam && !$mail->mybox ? "is-active" : ""}}">받은쪽지함</a>
                        </li>
                        <li>
                            <a href="{{route('mails.sent')}}"
                               class="{{Request::is('mails/sent')?"is-active":""}}">보낸쪽지함</a>
                        </li>
                        <li>
                            <a href="{{route('mails.my_box')}}" class="{{$mail->mybox ? "is-active" : ""}}">
                                보관쪽지함 </a>
                        </li>
                        <li>
                            <a href="{{route('mails.spam')}}"
                               class="{{$mail->spam ? "is-active" : ""}}">스팸쪽지함</a>
                        </li>
                        <li>
                            <a href="{{route('mails.create')}}"
                               class="{{Request::is('mails/create') || Request::is('mails/create/*')?"is-active":""}}">쪽지보내기</a>
                        </li>

                    </ul>
                </nav>
            </div>
            <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 게시판상세 -->
                <article class="bbs-view">
                    <h2 class="bbs-view-title">{{ $mail->mailboxs->subject }}</h2>
                    <div class="bbs-view-info">
                        <div class="writer">{{ $mail['users']['name'] }}</div>
                        <div class="etc"><span>작성일 {{ $mail->created_at }}</span>
                            {{--<span>조회수 {{ $mail->view_count }}</span></div>--}}
                        </div>
                    {{--<div class="bbs-view-manage"><a href="#mode_nav"><i class="setup-icon">수정</i></a></div>--}}
                    <!-- 게시물본문 -->
                        <div class="bbs-view-content">
                            <p>
                                <?php echo nl2br($mail->mailboxs->body); ?>
                            </p>
                        </div>
                        <!-- //게시물본문 -->
                        <div class="bbs-view-content-btns">

                            <div class="right-btns">
                                <a href="#mode_nav" class="report-btn"><i class="report-icon"></i> 메일 신고</a>
                            </div>
                        </div>
                        <div class="bbs-view-btns"><a href="{{ URL::previous()  }}" class="btn">목록</a></div>
                    </div>

                </article>
                <!-- //게시판상세 -->
                <!-- 이전글다음글 -->
                <ul class="prev-next">
                    @if($prev_mail != null)
                        <li>
                            <span class="head head--prev">이전글</span>
                            <span class="subject"><a
                                        href="{{ route('mails.detail',['id'=>$prev_mail->id]) }}">{{$prev_mail->mailboxs->subject}}</a></span>
                            <span class="writer">{{$prev_mail['users']['name']}}</span>
                            <span class="datetime">{{ $prev_mail->created_at->format('Y-m-d') }}</span>
                        </li>
                    @endif
                    @if($next_mail != null)
                        <li>
                            <span class="head head--next">다음글</span>
                    <span class="subject"><a
                                href="{{ route('mails.detail',['id'=>$next_mail->id]) }}">{{$next_mail->mailboxs->subject}}</a></span>
                            <span class="writer">{{$next_mail['users']['name']}}</span>
                            <span class="datetime">{{ $next_mail->created_at->format('Y-m-d') }}</span>
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

@endsection