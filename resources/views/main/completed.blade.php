@extends('layouts.main_layout')
@section('content')
    <!-- 컨테이너 -->
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
            <div class="lnb">
                <nav>
                    <h2 class="lnb-title">완결</h2>
                    <ul class="lnb-depth1">
                        <li>
                            <a href="{{route('completed')}}" @if(!$free_or_charged)class="is-active"@endif>유료소설</a><br>
                            <a href="{{route('completed')}}"
                               @if(!$free_or_charged && $genre=='%')class="is-active lnb-depth1-2"
                               @else class="lnb-depth1-2" @endif>전체</a><br>
                            <a href="{{route('completed')}}?genre=현대"
                               @if(!$free_or_charged && ($genre=='현대판타지' || $genre == '현대'))class="is-active lnb-depth1-2"
                               @else class="lnb-depth1-2" @endif>현대로맨스</a>
                            <ul class="lnb-depth2">
                                @if(!$free_or_charged && ($genre=='현대판타지' || $genre == '현대'))
                                    <li><a href="{{route('completed')}}?genre=현대"
                                           @if(!$free_or_charged && $genre=='현대')class="is-active"@endif>현대</a></li>
                                    <li><a href="{{route('completed')}}?genre=현대판타지"
                                           @if(!$free_or_charged && $genre=='현대판타지')class="is-active"@endif>현대판타지</a>
                                    </li>
                                @endif
                            </ul>
                            <a href="{{route('completed')}}?genre=시대"
                               @if(!$free_or_charged && ($genre=='시대' or $genre == '사극' or $genre == '동양판타지'))class="is-active lnb-depth1-2"
                               @else class="lnb-depth1-2"@endif>시대로맨스</a>
                            <ul class="lnb-depth2">
                                @if(!$free_or_charged && ($genre=='시대' or $genre == '사극' or $genre == '동양판타지'))
                                    <li><a href="{{route('completed')}}?genre=시대"
                                           @if(!$free_or_charged && $genre=='시대')class="is-active"@endif>시대</a></li>
                                    <li><a href="{{route('completed')}}?genre=사극"
                                           @if(!$free_or_charged && $genre=='사극')class="is-active"@endif>사극</a></li>
                                    <li><a href="{{route('completed')}}?genre=동양판타지"
                                           @if(!$free_or_charged && $genre=='동양판타지')class="is-active"@endif>동양판타지</a>
                                    </li>
                                @endif
                            </ul>
                            <a href="{{route('completed')}}?genre=서양역사"
                               @if(!$free_or_charged && ($genre=='서양역사' or $genre == '로맨스판타지'))class="is-active lnb-depth1-2"
                               @else class="lnb-depth1-2"@endif>서양역사</a>
                            <ul class="lnb-depth2">
                                @if(!$free_or_charged && ($genre=='서양역사' or $genre == '로맨스판타지'))
                                    <li><a href="{{route('completed')}}?genre=서양역사"
                                           @if(!$free_or_charged && $genre=='서양역사')class="is-active"@endif>서양역사</a></li>
                                    <li><a href="{{route('completed')}}?genre=로맨스판타지"
                                           @if(!$free_or_charged && $genre=='로맨스판타지')class="is-active"@endif>로맨스판타지</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('completed', ['free_or_charged'=>'free'])}}"
                               @if($free_or_charged)class="is-active"@endif>무료소설</a><br>
                            <a href="{{route('completed', ['free_or_charged'=>'free'])}}"
                               @if($free_or_charged && $genre=='%')class="is-active lnb-depth1-2"
                               @else class="lnb-depth1-2" @endif>전체</a><br>
                            <a href="{{route('completed', ['free_or_charged'=>'free'])}}?genre=현대"
                               @if($free_or_charged && ($genre=='현대판타지' or $genre == '현대'))class="is-active lnb-depth1-2"
                               @else class="lnb-depth1-2"@endif>현대로맨스</a>
                            <ul class="lnb-depth2">
                                @if($free_or_charged && ($genre=='현대판타지' or $genre == '현대'))
                                    <li><a href="{{route('completed', ['free_or_charged'=>'free'])}}?genre=현대"
                                           @if($free_or_charged && $genre=='현대')class="is-active"@endif>현대</a></li>
                                    <li><a href="{{route('completed', ['free_or_charged'=>'free'])}}?genre=현대판타지"
                                           @if($free_or_charged && $genre=='현대판타지')class="is-active"@endif>현대판타지</a>
                                    </li>
                                @endif
                            </ul>
                            <a href="{{route('completed', ['free_or_charged'=>'free'])}}?genre=시대"
                               @if($free_or_charged && ($genre=='시대' or $genre == '사극' or $genre == '동양판타지'))class="is-active lnb-depth1-2"
                               @else class="lnb-depth1-2"@endif>시대로맨스</a>
                            <ul class="lnb-depth2">
                                @if($free_or_charged && ($genre=='시대' or $genre == '사극' or $genre == '동양판타지'))
                                    <li><a href="{{route('completed', ['free_or_charged'=>'free'])}}?genre=시대"
                                           @if($free_or_charged && $genre=='시대')class="is-active"@endif>시대</a></li>
                                    <li><a href="{{route('completed', ['free_or_charged'=>'free'])}}?genre=사극"
                                           @if($free_or_charged && $genre=='사극')class="is-active"@endif>사극</a></li>
                                    <li><a href="{{route('completed', ['free_or_charged'=>'free'])}}?genre=동양판타지"
                                           @if($free_or_charged && $genre=='동양판타지')class="is-active"@endif>동양판타지</a>
                                    </li>
                                @endif
                            </ul>
                            <a href="{{route('completed', ['free_or_charged'=>'free'])}}?genre=서양역사"
                               @if($free_or_charged && ($genre=='서양역사' or $genre == '로맨스판타지'))class="is-active lnb-depth1-2"
                               @else class="lnb-depth1-2"@endif>서양역사</a>
                            <ul class="lnb-depth2">
                                @if($free_or_charged && ($genre=='서양역사' or $genre == '로맨스판타지'))
                                    <li><a href="{{route('completed', ['free_or_charged'=>'free'])}}?genre=서양역사"
                                           @if($free_or_charged && $genre=='서양역사')class="is-active"@endif>서양역사</a></li>
                                    <li><a href="{{route('completed', ['free_or_charged'=>'free'])}}?genre=로맨스판타지"
                                           @if($free_or_charged && $genre=='로맨스판타지')class="is-active"@endif>로맨스판타지</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 작품목록정렬 -->
                <div class="sort-nav sort-nav--novel">
                    <nav>
                        <ul>
                            <li><a href="{{route('completed',['free_or_charged'=>$free_or_charged])."?genre=".$genre}}"
                                   @if(!isset($order))class="is-active"@endif>업데이트순</a></li>
                            <li>
                                <a href="{{route('completed',['free_or_charged'=>$free_or_charged])."?genre=".$genre."&order=favorite"}}"
                                   @if($order=="favorite")class="is-active"@endif>선호작순</a>
                            </li>
                            <li>
                                <a href="{{route('completed',['free_or_charged'=>$free_or_charged])."?genre=".$genre."&order=view"}}"
                                   @if($order=="view")class="is-active"@endif>조회순</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- //작품목록정렬 -->
                <!-- **작품목록정렬과 작품목록 사이에는 태그삽입 금지 -->
                <!-- 작품목록 -->
                <ul class="novel-list">
                    @foreach($novel_groups as $novel_group)
                        <li>
                            <div class="thumb">
                                <span><a href="{{ route('each_novel.novel_group',['id'=>$novel_group->id]) }}"><img
                                                src="/img/novel_covers/{{$novel_group->cover_photo}}"
                                                alt="망의 연월"></a></span>
                            </div>
                            <div class="post">
                                <div class="post-header">
                                    <strong class="title"><a
                                                href="{{ route('each_novel.novel_group',['id'=>$novel_group->id]) }}">{{$novel_group->title}}</a></strong>
                                    <span class="writer">{{ $novel_group->nicknames->nickname }}</span>
                                    <span class="datetime">{{ time_elapsed_string($novel_group->new) }}</span>
                                </div>
                                <p class="post-content"><?php echo nl2br($novel_group->description, false); ?>
                                </p>
                                <p class="post-info">@foreach($novel_group->keywords as $keyword)
                                        <span>{{$keyword->name}}</span>@break @endforeach
                                    <span>총 {{$novel_group->novels_count}}화</span>
                                    <span>조회수 {{$novel_group->total_count}}</span></p>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <!-- //작품목록 -->
                <!-- 페이징 -->
            @include('pagination_front', ['collection' => $novel_groups, 'url' => route('completed',['free_or_charged'=>$free_or_charged])."?genre=".$genre."&order=".$order])
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