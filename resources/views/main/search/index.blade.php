@extends('layouts.main_layout')
@section('content')
        <!-- 컨테이너 -->
<div class="container">
    <div class="wrap">
        <!-- LNB -->
        {{--   <div class="lnb">
             <nav>
                  <h2 class="lnb-title">연재</h2>
                  <ul class="lnb-depth1">
                      <li>
                          <a href="" class="is-active">유료소설</a>
                          <ul class="lnb-depth2">
                              <li><a href=""
                                     class="is-active">전체</a></li>
                              --}}{{--            <li><a href="{{route('series')}}?genre=현대판타지"
                                                @if(!$free_or_charged && $genre=='현대판타지')class="is-active"@endif>현대판타지</a></li>
                                         <li><a href="{{route('series')}}?genre=사극/현대물"
                                                @if(!$free_or_charged && $genre=='사극/현대물')class="is-active"@endif>사극/현대물</a>
                                         </li>
                                         <li><a href="{{route('series')}}?genre=동양판타지"
                                                @if(!$free_or_charged && $genre=='동양판타지')class="is-active"@endif>동양판타지</a>
                                         </li>
                                         <li><a href="{{route('series')}}?genre=서양/중세"
                                                @if(!$free_or_charged && $genre=='서양/중세')class="is-active"@endif>서양/중세</a>
                                         </li>
                                         <li><a href="{{route('series')}}?genre=로맨스판타지"
                                                @if(!$free_or_charged && $genre=='로맨스판타지')class="is-active"@endif>로맨스판타지</a>
                                         </li>
                                         <li><a href="{{route('series')}}?genre=미래/SF"
                                                @if(!$free_or_charged && $genre=='미래/SF')class="is-active"@endif>미래/SF</a>
                                         </li>
                                         <li><a href="{{route('series')}}?genre=메디컬로맨스"
                                                @if(!$free_or_charged && $genre=='메디컬로맨스')class="is-active"@endif>메디컬로맨스</a>
                                         </li>
                                         <li><a href="{{route('series')}}?genre=전문직로맨스"
                                                @if(!$free_or_charged && $genre=='전문직로맨스')class="is-active"@endif>전문직로맨스</a>
                                         </li>
                                         <li><a href="{{route('series')}}?genre=캠퍼스로맨스"
                                                @if(!$free_or_charged && $genre=='캠퍼스로맨스')class="is-active"@endif>캠퍼스로맨스</a>
                                         </li>
                                         <li><a href="{{route('series')}}?genre=학원로맨스"
                                                @if(!$free_or_charged && $genre=='학원로맨스')class="is-active"@endif>학원로맨스</a>
                                         </li>
                                         <li><a href="{{route('series')}}?genre=할리퀸로맨스"
                                                @if(!$free_or_charged && $genre=='할리퀸로맨스')class="is-active"@endif>할리퀸로맨스</a>
                                         </li>
                                         <li><a href="{{route('series')}}?genre=스포츠"
                                                @if(!$free_or_charged && $genre=='스포츠')class="is-active"@endif>스포츠</a></li>
                                         <li><a href="{{route('series')}}?genre=연예계"
                                                @if(!$free_or_charged && $genre=='연예계')class="is-active"@endif>연예계</a></li>--}}{{--
                          </ul>
                      </li>
                      --}}{{--       <li>
                                  <a href="{{route('series',['free_or_charged'=>'free'])}}"
                                     @if($free_or_charged)class="is-active"@endif>무료소설</a>
                                  <ul class="lnb-depth2">
                                      <li><a href="{{route('series',['free_or_charged'=>'free'])}}"
                                             @if($free_or_charged && $genre=='%')class="is-active"@endif>전체</a></li>
                                      <li><a href="{{route('series',['free_or_charged'=>'free'])}}?genre=현대판타지"
                                             @if($free_or_charged && $genre=='현대판타지')class="is-active"@endif>현대판타지</a></li>
                                      <li><a href="{{route('series',['free_or_charged'=>'free'])}}?genre=사극/현대물"
                                             @if($free_or_charged && $genre=='사극/현대물')class="is-active"@endif>사극/현대물</a>
                                      </li>
                                      <li><a href="{{route('series',['free_or_charged'=>'free'])}}?genre=동양판타지"
                                             @if($free_or_charged && $genre=='동양판타지')class="is-active"@endif>동양판타지</a>
                                      </li>
                                      <li><a href="{{route('series',['free_or_charged'=>'free'])}}?genre=서양/중세"
                                             @if($free_or_charged && $genre=='서양/중세')class="is-active"@endif>서양/중세</a>
                                      </li>
                                      <li><a href="{{route('series',['free_or_charged'=>'free'])}}?genre=로맨스판타지"
                                             @if($free_or_charged && $genre=='로맨스판타지')class="is-active"@endif>로맨스판타지</a>
                                      </li>
                                      <li><a href="{{route('series',['free_or_charged'=>'free'])}}?genre=미래/SF"
                                             @if($free_or_charged && $genre=='미래/SF')class="is-active"@endif>미래/SF</a>
                                      </li>
                                      <li><a href="{{route('series',['free_or_charged'=>'free'])}}?genre=메디컬로맨스"
                                             @if($free_or_charged && $genre=='메디컬로맨스')class="is-active"@endif>메디컬로맨스</a>
                                      </li>
                                      <li><a href="{{route('series',['free_or_charged'=>'free'])}}?genre=전문직로맨스"
                                             @if($free_or_charged && $genre=='전문직로맨스')class="is-active"@endif>전문직로맨스</a>
                                      </li>
                                      <li><a href="{{route('series',['free_or_charged'=>'free'])}}?genre=캠퍼스로맨스"
                                             @if($free_or_charged && $genre=='캠퍼스로맨스')class="is-active"@endif>캠퍼스로맨스</a>
                                      </li>
                                      <li><a href="{{route('series',['free_or_charged'=>'free'])}}?genre=학원로맨스"
                                             @if($free_or_charged && $genre=='학원로맨스')class="is-active"@endif>학원로맨스</a>
                                      </li>
                                      <li><a href="{{route('series',['free_or_charged'=>'free'])}}?genre=할리퀸로맨스"
                                             @if($free_or_charged && $genre=='할리퀸로맨스')class="is-active"@endif>할리퀸로맨스</a>
                                      </li>
                                      <li><a href="{{route('series',['free_or_charged'=>'free'])}}?genre=스포츠"
                                             @if($free_or_charged && $genre=='스포츠')class="is-active"@endif>스포츠</a></li>
                                      <li><a href="{{route('series',['free_or_charged'=>'free'])}}?genre=연예계"
                                             @if($free_or_charged && $genre=='연예계')class="is-active"@endif>연예계</a></li>
                                  </ul>
                              </li>--}}{{--
                          </ul>
                      </nav>
                  </div>--}}
        <!-- //LNB -->

        <!-- 서브컨텐츠 -->
        <div class="content" id="content">
            <!-- 작품목록정렬 -->
            <div class="sort-nav sort-nav--novel">
                <div style="float:left;margin-left: 10px;">
                    검색 [ @if($search_type) 검색 조건: {{$search_type}} , @endif
                    @if($title) 제목: {{$title}},@endif @if($keyword_name)  해시 태그:{{$keyword_name}} @endif]
                </div>
                <div style="float:right;margin-right: 10px;">
                    전체 {{$novel_groups->Total()}} 개의 결과물
                </div>
                <nav>
                    <ul>

                        {{-- <li><a href="{{route('series',['free_or_charged'=>])."?genre=".}}"
                                @if(!isset($order))class="is-active"@endif>업데이트순</a></li>
                         <li>
                             <a href="{{route('series',['free_or_charged'=>])."?genre=".."&order=favorite"}}"
                                @if($order=="favorite")class="is-active"@endif>선호작순</a>
                         </li>
                         <li>
                             <a href="{{route('series',['free_or_charged'=>])."?genre=".."&order=view"}}"
                                @if($order=="view")class="is-active"@endif>조회순</a></li>--}}
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
                                    <span>{{$keyword->name}}</span>@endforeach
                                <span>총 {{$novel_group->novels_count}}화</span>
                                <span>조회수 {{$novel_group->total_count}}</span></p>
                        </div>
                    </li>
                @endforeach
            </ul>
            <!-- //작품목록 -->
            <!-- 페이징 -->
            @include('pagination_front', ['collection' => $novel_groups, 'url' => route('search.index').'?search_type='.$search_type.'&title='.$title.'&keyword_name='.$keyword_name.'&'])
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