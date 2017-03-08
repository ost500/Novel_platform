@extends('layouts.mobile_layout')
@section('content')
        <!-- 내용 -->
<div class="container">

    <div class="cont_wrap">
        <div class="sel2_wrap">
            <!-- 텝메뉴 -->
            <ul class="tap2_mn">
                <li class="left"><a href="{{route('m.free_board')}}" class="tap2_mn_on">자유게시판</a></li>
                <li class="right"><a href="{{route('m.reader_reco')}}" class="">독자추천</a></li>
            </ul>
            <!-- 텝메뉴 //-->
        </div>
        @if(Session::has('flash_message'))
            {{-- important, success, warning, danger and info --}}
            <div class="alert alert-success">
                {{Session('flash_message')}}
            </div>
            @endif
                    <!-- 주간 Best -->
            @if($weekly_best->offsetExists(0))
                <div class="">
                    <div class="mlist_tit_rwap2">
                        <h2 class="mlist_tit_crown">
                            Weekly Best
                            <a href="" class="mlist_tit_btn open">내용보기</a>
                            <!--<a href="" class="mlist_tit_btn close">내용닫기</a>-->
                        </h2>
                    </div>

                    <!-- 주간 Best 리스트 -->
                    <table class="tbl_dotline">
                        <colgroup>
                            <col width="10%">
                            <col width="*">
                            <col width="20%">
                        </colgroup>
                        <tbody>
                        @php $counter =0; @endphp
                        @foreach($weekly_best[0] as $best)
                            <tr>
                                <td class="topcount">{{$loop->iteration}}.</td>
                                <td class="contxt">
                                    <a href="{{route('m.free_board.detail',['id'=>$best->id])}}">
                                        <div class="borContTit">{{$best->title}}</div>
                                    </a>

                                    <div class="tbl_binfo">{{str_limit($best['users']['name'])}}<span
                                                class="mtbl_binfo_sl"></span>{{$best->created_at->format('Y-m-d') }}
                                    </div>
                                </td>
                                <td class="talC">
                                    <div class="repl_num">{{$best->comments_count}}</div>
                                    <span class="reply">댓글</span>
                                </td>
                            </tr>
                            @php $counter++; @endphp
                        @endforeach
                        @if($weekly_best->offsetExists(1))
                            @foreach($weekly_best[1] as $best)
                                <tr>
                                    <td class="topcount">{{$counter+$loop->iteration}}.</td>
                                    <td class="contxt">
                                        <a href="{{route('m.free_board.detail',['id'=>$best->id])}}">
                                            <div class="borContTit">{{$best->title}}</div>
                                        </a>

                                        <div class="tbl_binfo">{{str_limit($best['users']['name'])}}<span
                                                    class="mtbl_binfo_sl"></span>{{$best->created_at->format('Y-m-d') }}
                                        </div>
                                    </td>
                                    <td class="talC">
                                        <div class="repl_num">{{$best->comments_count}}</div>
                                        <span class="reply">댓글</span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                    <!-- 주간 Best 리스트 //-->
                </div>
                <!-- 주간 Best //-->
                @endif

                        <!-- 검색 & 리스트 -->
                <div class="">
                    <div class="mlist_tit_rwap">
                        <form action="{{Request::url()}}" class="content-search-form">
                            <div class="msch_1wrap">
                                <!-- 셀렉트박스 -->
                                <div class="msch_sel">
                                    <select name="search_option" class="selstyl2 full">
                                        <option value="title">제목</option>
                                        <option value="content">내용</option>
                                    </select>
                                </div>
                                <!-- 셀렉트박스 //-->
                                <!-- 인풋박스 -->
                                <div class="msch_input2">
                                    <input type="text" name="search_text" class="inputBacol with280">
                                </div>
                                <!-- 인풋박스 //-->
                            </div>
                            <button type="submit" class="list_sch"
                                    style="width:57px;height:57px;border-color:transparent;">검색
                            </button>
                        </form>
                        {{-- <a href="" class="list_sch">검색</a>--}}
                    </div>

                    <!-- 리스트 -->
                    <div class="spac20"></div>
                    <table class="tbl_dotline">
                        <colgroup>
                            <col width="*">
                            <col width="20%">
                        </colgroup>
                        <tbody>
                        @foreach($articles as $article)
                            <tr>
                                <td class="contxt">
                                    <a href="{{ route('m.free_board.detail',['id'=>$article->id]) }}">
                                        <div class="borContTit">{{ $article->title }}</div>
                                    </a>

                                    <div class="tbl_binfo">{{ $article['users']['name'] }}<span
                                                class="mtbl_binfo_sl"></span>{{ $article->created_at->format('Y-m-d') }}
                                    </div>
                                </td>
                                <td class="talC">
                                    <div class="repl_num">{{ $article->comments_count }}</div>
                                    <span class="reply">댓글</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- 리스트 //-->

                    <!-- 페이징 -->
                    @include('pagination_mobile', ['collection' => $articles, 'url' => route('m.free_board')."?search_option=".$search_option."&search_text=".$search_text."&"])
                            <!-- 페이징 //-->

                    <div class=""><input type="button" value="글쓰기" class="btn_line_gray full" style="cursor:pointer;"
                                         onclick="window.location.href='{{ route('m.free_board.write')}}'"></div>
                    <div class="spac20"></div>
                </div>
                <!-- 검색 & 리스트 //-->
    </div>
</div>
<!-- 내용 //-->
<script>
    $(".alert").delay(4000).slideUp(200, function () {
        $(this).alert('close');
    });
</script>
@endsection