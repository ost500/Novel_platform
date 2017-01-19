@extends('layouts.main_layout')
@section('content')
    <!-- 컨테이너 -->
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
            <div class="lnb">
                <nav>
                    <h2 class="lnb-title">베스트</h2>
                    <ul class="lnb-depth1">
                        <li>
                            <a href="{{route('bests')}}" @if(!$free_or_charged)class="is-active"@endif>유료소설 베스트</a>
                            <ul class="lnb-depth2">
                                <li><a href="{{route('bests')}}?period=today_count"
                                       @if(!$free_or_charged && $period=='today_count')class="is-active"@endif>투데이베스트</a>
                                </li>
                                <li><a href="{{route('bests')}}?period=week_count"
                                       @if(!$free_or_charged && $period=='week_count')class="is-active"@endif>주간베스트</a>
                                </li>
                                <li><a href="{{route('bests')}}?period=month_count"
                                       @if(!$free_or_charged && $period=='month_count' && $option!='completed')class="is-active"@endif>월간베스트</a>
                                </li>
                                <li><a href="{{route('bests')}}?period=year_count&option=steady"
                                       @if(!$free_or_charged && $period=='year_count')class="is-active"@endif>스테디셀러</a>
                                </li>
                                <li><a href="{{route('bests')}}?period=today_count"
                                       @if(!$free_or_charged && $period=='today_count')class="is-active"@endif>장르별베스트</a>
                                </li>
                                <li><a href="{{route('bests')}}?period=month_count&option=completed"
                                       @if(!$free_or_charged && $period=='month_count' && $option=='completed')class="is-active"@endif>완결베스트</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="lnb-depth1">
                        <li>
                            <a href="{{route('bests',['free_or_charged'=>'free'])}}"
                               @if($free_or_charged)class="is-active"@endif>무료소설 베스트</a>
                            <ul class="lnb-depth2">
                                <li><a href="{{route('bests',['free_or_charged'=>'free'])}}?period=today_count"
                                       @if($free_or_charged && $period=='today_count')class="is-active"@endif>투데이베스트</a>
                                </li>
                                <li><a href="{{route('bests',['free_or_charged'=>'free'])}}?period=week_count"
                                       @if($free_or_charged && $period=='week_count')class="is-active"@endif>주간베스트</a>
                                </li>
                                <li><a href="{{route('bests',['free_or_charged'=>'free'])}}?period=month_count"
                                       @if($free_or_charged && $period=='month_count' && $option!='completed')class="is-active"@endif>월간베스트</a>
                                </li>
                                <li>
                                    <a href="{{route('bests',['free_or_charged'=>'free'])}}?period=year_count&option=steady"
                                       @if($free_or_charged && $period=='year_count')class="is-active"@endif>스테디셀러</a>
                                </li>
                                <li><a href="{{route('bests',['free_or_charged'=>'free'])}}?period=today_count"
                                       @if($free_or_charged && $period=='today_count')class="is-active"@endif>장르별베스트</a>
                                </li>
                                <li>
                                    <a href="{{route('bests',['free_or_charged'=>'free'])}}?period=month_count&option=completed"
                                       @if($free_or_charged && $period=='month_count' && $option=='completed')class="is-active"@endif>완결베스트</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 작품목록 -->
                <ul class="novel-list novel-list--best">
                    @foreach($novel_groups as $novel_group)
                        <li>
                            <div class="rank">{{(10 * ($page-1)) + $loop->index + 1}}</div>
                            <div class="thumb">
                                <span><a href="{{ route('each_novel.novel_group',['id'=>$novel_group->id]) }}"><img
                                                src="/img/novel_covers/{{$novel_group->cover_photo}}"
                                                alt="{{$novel_group->title}}"></a></span>
                            </div>
                            <div class="post">
                                <div class="post-header">
                                    <strong class="title"><a
                                                href="{{ route('each_novel.novel_group',['id'=>$novel_group->id]) }}">{{$novel_group->title}}</a></strong>
                                    <span class="writer">{{ $novel_group->nicknames->nickname }}</span>
                                    <span class="datetime">{{ time_elapsed_string($novel_group->new) }}</span>
                                </div>
                                <p class="post-content"><?php echo nl2br($novel_group->description, false); ?></p>
                                <p class="post-info">@foreach($novel_group->keywords as $keyword)
                                        <span>{{$keyword->name}}</span>@endforeach
                                    <span>총 {{$novel_group->novels_count}}화</span>
                                    <span>조회수 {{$novel_group->total_count}}</span>
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <!-- 작품목록 -->
                <!-- 베스트페이징 -->
                <div class="bestpage-nav">
                    <nav>
                        <ul>
                            <li>
                                <a href="{{route('bests',['free_or_charged'=>$free_or_charged])."?period=".$period."&option=".$option}}&page=1"
                                   @if($page =='1')class="current-page"@endif>1-20위</a></li>
                            <li>
                                <a href="{{route('bests',['free_or_charged'=>$free_or_charged])."?period=".$period."&option=".$option}}&page=2"
                                   @if($page =='2')class="current-page"@endif>21-40위</a></li>
                            <li>
                                <a href="{{route('bests',['free_or_charged'=>$free_or_charged])."?period=".$period."&option=".$option}}&page=3"
                                   @if($page =='3')class="current-page"@endif>41-60위</a></li>
                            <li>
                                <a href="{{route('bests',['free_or_charged'=>$free_or_charged])."?period=".$period."&option=".$option}}&page=4"
                                   @if($page =='4')class="current-page"@endif>61-80위</a></li>
                            <li>
                                <a href="{{route('bests',['free_or_charged'=>$free_or_charged])."?period=".$period."&option=".$option}}&page=5"
                                   @if($page =='5')class="current-page"@endif>81-100위</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- //페이징 -->
            </div>
            <!-- //서브컨텐츠 -->
            <!-- 따라다니는퀵메뉴 -->
            <div class="aside-nav" id="aside_nav">
                <nav>
                    <ul class="aside-menu">
                        <li><a href="#mode_nav" class="userbtn userbtn--alarm"><span>알림</span></a></li>
                        <li><a href="#mode_nav" class="userbtn userbtn--memo"><span>쪽지</span></a></li>
                        <li><a href="#mode_nav" class="userbtn userbtn--myinfo"><span>마이메뉴</span></a></li>
                        <li><a href="#mode_nav" class="userbtn userbtn--scrap"><span>선호작</span></a></li>
                        <li><a href="#mode_nav" class="userbtn userbtn--marble"><span>보유구슬</span></a></li>
                    </ul>
                </nav>
            </div>
            <!-- //따라다니는퀵메뉴 -->
        </div>
    </div>
    <!-- //컨테이너 -->

@endsection