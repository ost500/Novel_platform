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
                            @if(!$free_or_charged)
                                <ul class="lnb-depth1">
                                    <li><a href="{{route('bests')}}?period=today_count"
                                           class="lnb-depth1-2 @if(!$free_or_charged && $period=='today_count' && !($option == "현대로맨스" or $option == "시대로맨스" or $option == "로맨스판타지")) is-active @endif">투데이베스트</a>
                                    </li>
                                    <li><a href="{{route('bests')}}?period=week_count"
                                           class="lnb-depth1-2 @if(!$free_or_charged && $period=='week_count') is-active @endif ">주간베스트</a>
                                    </li>
                                    <li><a href="{{route('bests')}}?period=month_count"
                                           class="lnb-depth1-2 @if(!$free_or_charged && $period=='month_count' && $option!='completed') is-active @endif ">월간베스트</a>
                                    </li>
                                    <li><a href="{{route('bests')}}?period=year_count&option=steady"
                                           class="lnb-depth1-2 @if(!$free_or_charged && $period=='year_count') is-active @endif ">스테디셀러</a>
                                    </li>
                                    <li><a href="{{route('bests')}}?period=today_count&option=현대로맨스"
                                           class="lnb-depth1-2 @if(!$free_or_charged && $period=='today_count' && ($option == "현대로맨스" or $option == "시대로맨스" or $option == "로맨스판타지")) is-active @endif ">장르별베스트</a>
                                    </li>
                                    <li><a href="{{route('bests')}}?period=month_count&option=completed"
                                           class="lnb-depth1-2 @if(!$free_or_charged && $period=='month_count' && $option=='completed') is-active @endif ">완결베스트</a>
                                    </li>
                                </ul>
                            @endif
                        </li>
                    </ul>
                    <ul class="lnb-depth1">
                        <li>
                            <a href="{{route('bests',['free_or_charged'=>'free'])}}"
                               @if($free_or_charged)class="is-active"@endif>무료소설 베스트</a>
                            @if($free_or_charged)
                                <ul class="lnb-depth1">
                                    <li><a href="{{route('bests',['free_or_charged'=>'free'])}}?period=today_count"
                                           class="lnb-depth1-2 @if($free_or_charged && $period=='today_count' && !($option == "현대로맨스" or $option == "시대로맨스" or $option == "로맨스판타지")) is-active @endif">투데이베스트</a>
                                    </li>
                                    <li><a href="{{route('bests',['free_or_charged'=>'free'])}}?period=week_count"
                                           class="lnb-depth1-2 @if($free_or_charged && $period=='week_count') is-active @endif">주간베스트</a>
                                    </li>
                                    <li><a href="{{route('bests',['free_or_charged'=>'free'])}}?period=month_count"
                                           class="lnb-depth1-2 @if($free_or_charged && $period=='month_count' && $option!='completed') is-active @endif">월간베스트</a>
                                    </li>
                                    <li>
                                        <a href="{{route('bests',['free_or_charged'=>'free'])}}?period=year_count&option=steady"
                                           class="lnb-depth1-2 @if($free_or_charged && $period=='year_count') is-active @endif">스테디셀러</a>
                                    </li>
                                    <li>
                                        <a href="{{route('bests',['free_or_charged'=>'free'])}}?period=today_count&option=현대로맨스"
                                           class="lnb-depth1-2 @if($free_or_charged && $period=='today_count' && ($option == "현대로맨스" or $option == "시대로맨스" or $option == "로맨스판타지")) is-active @endif">장르별베스트</a>
                                    </li>
                                    <li>
                                        <a href="{{route('bests',['free_or_charged'=>'free'])}}?period=month_count&option=completed"
                                           class="lnb-depth1-2 @if($free_or_charged && $period=='month_count' && $option=='completed') is-active @endif">완결베스트</a>
                                    </li>

                                </ul>
                            @endif
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
            @if ($option == "현대로맨스" or $option == "시대로맨스" or $option == "로맨스판타지")
                <!-- 작품목록정렬 -->
                    <div class="sort-nav sort-nav--novel">
                        <nav>
                            <ul>


                                <li>
                                    <a href="{{route('bests',['free_or_charged'=> $free_or_charged]) .'?period=today_count&option=현대로맨스' }}"
                                       @if($option == "현대로맨스") class="is-active" @endif>현대로맨스</a>
                                </li>
                                <li>
                                    <a href="{{route('bests',['free_or_charged'=> $free_or_charged]) .'?period=today_count&option=시대로맨스' }}"
                                       @if($option == "시대로맨스") class="is-active" @endif>시대로맨스</a>
                                </li>
                                <li>
                                    <a href="{{route('bests',['free_or_charged'=> $free_or_charged]) .'?period=today_count&option=로맨스판타지' }}"
                                       @if($option == "로맨스판타지") class="is-active" @endif>로맨스판타지</a>
                                </li>

                            </ul>
                        </nav>
                    </div>
            @endif
            <!-- //작품목록정렬 -->
                <!-- **작품목록정렬과 작품목록 사이에는 태그삽입 금지 -->
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
                                                href="{{ route('each_novel.novel_group',['id'=>$novel_group->id]) }}">{{str_limit($novel_group->title, 40)}}</a></strong>
                                    <span class="writer">{{ $novel_group->nicknames->nickname }}</span>
                                    <span class="datetime">{{ time_elapsed_string($novel_group->new) }}</span>
                                </div>
                                <p class="post-content"><?php echo str_limit($novel_group->description, 260); ?></p>
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
        @include('main.quick_menu')
        <!-- //따라다니는퀵메뉴 -->
        </div>
    </div>
    <!-- //컨테이너 -->

@endsection