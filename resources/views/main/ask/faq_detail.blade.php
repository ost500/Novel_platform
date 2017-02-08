@extends('../layouts.main_layout')
@section('content')

        <!-- 컨테이너 -->
<div class="container">
    <div class="wrap">
        <!-- LNB -->
        @include('main.ask.left_sidebar')>
        <!-- //LNB -->

        <!-- 서브컨텐츠 -->
        <div class="content" id="content">
            <!-- 게시판상세 -->
            <article class="bbs-view">
                <h2 class="bbs-view-title">{{ $faq->title }}</h2>

                <div class="bbs-view-info">
                    <div class="writer">admin</div>
                    <div class="etc"><span>작성일 {{ $faq->created_at }}</span>
                        {{--<span>조회수 {{ $mail->view_count }}</span></div>--}}
                    </div>
                    {{--<div class="bbs-view-manage"><a href="#mode_nav"><i class="setup-icon">수정</i></a></div>--}}
                    <!-- 게시물본문 -->
                    <div class="bbs-view-content">
                        <p>
                            <?php echo nl2br($faq->description); ?>
                        </p>
                    </div>
                                <!-- //게시물본문 -->
                        <div class="bbs-view-content-btns">

                            <div class="right-btns">
                                <a href="#mode_nav" class="report-btn"><i class="report-icon"></i> 메일 신고</a>
                            </div>
                        </div>
                        <div class="bbs-view-btns"><a href="{{ route('ask.faqs') }}" class="btn">목록</a></div>
                </div>

            </article>
            <!-- //게시판상세 -->
            <!-- 이전글다음글 -->
            <ul class="prev-next">
                @if($pre_faq != null)
                    <li>
                        <span class="head head--prev">이전글</span>
                            <span class="subject"><a
                                        href="{{ route('ask.faq_detail',['id'=>$pre_faq->id]).$query_string }}">{{$pre_faq->title}}</a></span>
                        <span class="writer">admin</span>
                        <span class="datetime">{{ $pre_faq->created_at->format('Y-m-d') }}</span>
                    </li>
                @endif
                @if($next_faq != null)
                    <li>
                        <span class="head head--next">다음글</span>
                    <span class="subject">
                      <a href="{{ route('ask.faq_detail',['id'=>$next_faq->id]).$query_string }}">{{$next_faq->title}}</a></span>
                        <span class="writer">admin</span>
                        <span class="datetime">{{ $next_faq->created_at->format('Y-m-d') }}</span>
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