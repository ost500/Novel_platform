@extends('layouts.main_layout')
@section('content')
        <!-- 컨테이너 -->
<div class="container">
    <div class="wrap">
        <!-- LNB -->
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
        @include('main.quick_menu')
        <!-- //따라다니는퀵메뉴 -->
    </div>
</div>
<!-- //컨테이너 -->


@endsection