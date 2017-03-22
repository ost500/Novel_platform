@extends('layouts.mobile_layout')
@section('content')
        <!-- 상단 비주얼 -->
<div class="serial_topvs_wrap" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml"
     xmlns:v-on="http://www.w3.org/1999/xhtml">
    @include('mobile_social_share', ['url' =>route('each_novel.novel_group', $novel_group->id),'title'=>$novel_group->title,'thumbnail'=>''])
            <!-- 상단 비주얼 배경 이미지 -->
    <div class="stvs_bg_wrap">
        <div class="stvs_bg_img"></div>
        <!-- 배경이미지(책 표지) -->
        <div class="stvs_bg_cover"></div>
        <!-- 검은색 반투명 커버 -->
    </div>
    <!-- 상단 비주얼 배경 이미지 //-->
    <!-- 상단 비주얼 내용 -->
    <div class="stvs_cont">
        <!-- 조회수 선호작 -->
        <div class="stvs_cl">
            <div class="">
                <span>조회수</span><span
                        class="stvs_cl_sli"></span><span>{{ $novel_group->getNovelGroupViewCount($novel_group->id)}}</span>
            </div>
            <div class="">
                <span>선호작</span><span class="stvs_cl_sli"></span><span>{{$novel_group->getNovelGroupFavoriteCount($novel_group->id)}}
                    명</span>
            </div>
        </div>
        <!-- 조회수 선호작 //-->
        <!-- 선호작추가 공유하기 -->
        <div class="stvs_cr" id="novel_group">
            <ul class="stvs_cr_ul">
                <li>
                    <a href="#" v-on:click="addToFavorite('{{$novel_group->id}}')" id="add_favorite"
                       v-show="add_favorite_disp" class="stvs_cr_a">
                        <span class="stvs_cr_ico view_bm"></span>
                        <!--<span class="stvs_cr_ico view_bm_on"></span>-->
                        <span class="stvs_cr_sli"></span>
                        <span class="stvs_cr_txt">선호작추가</span>
                    </a>
                    <a href="#" v-on:click="removeFromFavorite()" id="remove_favorite"
                       v-show="remove_favorite_disp" class="stvs_cr_a" style="display:none;">
                        <span class="stvs_cr_ico view_bm_on"></span>
                        <!--<span class="stvs_cr_ico view_bm_on"></span>-->
                        <span class="stvs_cr_sli"></span>
                        <span class="stvs_cr_txt">선호작추가</span>
                    </a>

                </li>
                <li>
                    <a href="#" class="stvs_cr_a" v-on:click="showSideMenu()">
                        <span class="stvs_cr_ico view_share"></span>
                        <span class="stvs_cr_sli"></span>
                        <span class="stvs_cr_txt">공유하기</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- 선호작추가 공유하기 //-->
        <div class="stvs_cc">
            <!-- 책 이미지 -->
            <span class="stvs_img"><img src="/img/novel_covers/{{ $novel_group->cover_photo }}"></span>
            <!-- 책 이미지 //-->
            <!-- 책 제목 -->
            <div class="book_tit">{{str_limit($novel_group->title, 35)}}</div>
            <!-- 책 제목 //-->
            <!-- 작가 및 장르 설명 -->
            <div class="book_info">
                <span class="wr_name">{{$novel_group->nicknames->nickname }}</span>
                <span class="ico_note"><a href="{{ route('mails.create', ['id' => $novel_group->users->id]) }}"><img
                                src="/mobile/images/ico_note.gif"></a></span>
                <span class="marL20">@if(count($novel_group->keywords) >0) {{$novel_group->keywords[0]->name }} @endif</span>
                <span class="stvs_bif_sli"></span>
                <span>총 {{$novel_group->max_inning}}화</span>
            </div>
            <!-- 작가 및 장르 설명 //-->
            <!-- 책 소개 내용 -->
            <div class="summary"> {{$novel_group->description}}</div>
            <!-- 책 소개 내용 //-->
            <!-- 첫화보기 버튼 -->
            <div class="padt40">
                <a href="{{route('each_novel.novel_group.review',['id'=>$novel_group->id])}}"
                   class="btn_line_green full" style="margin-bottom:5px;">독자추천 글쓰기</a>
                @if($novel_group->novels->count() > 0)
                    <a href="{{route('each_novel.novel_group_inning',['id'=>$novel_group->novels[0]->id])}}"
                       class="btn_line_green full">첫화보기</a>
                @endif
            </div>

            <!-- 첫화보기 버튼 //-->
        </div>
    </div>
    <!-- 상단 비주얼 내용 //-->
</div>
<!-- 상단 비주얼 -->
<!-- 내용 -->
<div class="container">
    <div class="cont_wrap">
        @if($recently_visited_novel)
                <!-- 연재회차 -->
        <div class="">
            <div class="mlist_tit_rwap">
                <h2 class="mlist_tit2">최근 읽은 회차</h2>
            </div>
            <!-- 게시글 테이블 -->
            <table class="tbl_line">
                <colgroup>
                    <col width="15%">
                    <col width="*">
                    <col width="12%">
                </colgroup>
                <tbody>
                <tr>
                    <td class="inning">{{ $recently_visited_novel->novels->inning }}화</td>
                    <td class="contxt">
                        <a href="{{route('each_novel.novel_group_inning',['id'=>$recently_visited_novel->novel_id])}}">
                            <div class="borCont">{{str_limit($recently_visited_novel->novels->title,60)}}</div>
                        </a>
                        <span class="time2">{{$recently_visited_novel->novels->created_at}}</span>
                    </td>
                    <td class="talC"> @if($recently_visited_novel->novels->non_free_agreement > 0)  <span
                                class="green">유료</span>@else<span
                                class="gray">무료</span>@endif</td>
                </tr>
                </tbody>
            </table>
            <!-- 게시글 테이블 //-->
        </div>
        <!-- 연재회차 //-->
        @endif
                <!-- 연재회차 -->
        <div class="">
            <div class="mlist_tit_rwap">
                <h2 class="mlist_tit2">연재회차</h2>
            </div>
            <!-- 게시글 테이블 -->
            <table class="tbl_line">
                <colgroup>
                    <col width="15%">
                    <col width="*">
                    <col width="12%">
                </colgroup>
                <tbody>
                @foreach($novel_group->novels as $novel)
                    @if($novel->publish_reservation > $latest_time)  @continue; @endif
                    <tr>
                        <td class="inning">{{$novel->inning}}화</td>
                        <td class="contxt">

                            <a href="{{route('each_novel.novel_group_inning',['id'=>$novel->id])}}">
                                <div class="borCont">{{str_limit($novel->title, 60)}}</div>
                            </a>
                            <span class="time2">{{$novel->created_at}}</span>
                        </td>
                        <td class="talC"> @if($novel->non_free_agreement > 0)  <span class="green">유료</span>@else<span
                                    class="gray">무료</span>@endif</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!-- 게시글 테이블 //-->
        </div>
        <!-- 연재회차 //-->

        <!-- 작가의 다른 작품 -->
        <div class="">
            @if(!$author_novel_groups->isEmpty())
                <div class="mlist_tit_rwap">
                    <h2 class="mlist_tit2">작가의 다른 작품</h2>
                    {{-- <form name="search_other_form" action="{{route('search.index')}}" method="post">
                         {{csrf_field()}}
                         <input type="hidden" name="nickname_id" id="nickname_id" value="{{$novel_group->nickname_id}}">
                         <input type="hidden" name="search_type" id="search_type" value="다른">
                    <button type="submit" class="mlist_more" style="cursor:pointer;">더보기</button>
                    </form>--}}
                    <a href="{{route('search.index').'?nickname_id='.$novel_group->nickname_id.'&search_type=다른 작품'}}"
                       class="mlist_more">더보기</a>
                </div>
                <!-- 리스트 테이블 -->
                <div class="view_else_box">
                    <table class="mlist_tbl" style="border:0;">
                        <colgroup>
                            <col width="30%">
                            <col width="*">
                        </colgroup>
                        <tbody>

                        @foreach($author_novel_groups as $author_novel_group)
                            <tr>
                                <td class="">
                             <span class="mtbl_img">
                                 <a href="{{ route('each_novel.novel_group',['id' => $author_novel_group->id]) }}">
                                     <img src="/img/novel_covers/{{ $author_novel_group->cover_photo }}"
                                          class="mtbl_img"></a>
                               </span>
                                </td>
                                <td class="">
                                    <a href="{{ route('each_novel.novel_group',['id' => $author_novel_group->id]) }}">
                                        <div class="mtbl_tit">{{str_limit($author_novel_group->title, 20)}}</div>
                                    </a>

                                    <div class="mtbl_binfo">@if(count($novel_group->keywords) >0) {{$novel_group->keywords[0]->name }} @endif</div>
                                    <div class="mtbl_binfo2">총 {{$author_novel_group->max_inning}}화</div>
                                    <div class="mtbl_binfo2">선호작 {{$author_novel_group->favorite_count}}명</div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- 리스트 테이블 //-->

                <!-- 페이징 -->
                <div class="pag_wrap">
                    <div class="paging">
                        {{--{{ $author_novel_groups->render() }}--}}
                        @include('pagination_mobile', ['collection' => $author_novel_groups, 'url' => route('each_novel.novel_group',['id'=>$novel_group->id]).'&'])
                    </div>
                </div>
                <!-- 페이징 //-->
        </div>
        @endif
                <!-- 작가의 다른 작품 //-->

        <!-- 해시태그 -->

        @if(!$novel_group->hash_tags->isEmpty())
            <div class="">
                <div class="mlist_tit_rwap">
                    <h2 class="mlist_tit2">해시태그</h2>
                </div>
                <div class="">
                    <ul class="hash_tag">
                        @foreach($novel_group->hash_tags as $hash_tag)
                            <li><a href="" class="hash_tag_a">{{$hash_tag->tag}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
         <!-- 해시태그 //-->
    </div>
</div>
<!-- 내용 //-->
<script type="text/javascript">

    var app = new Vue({
        el: '#novel_group',
        data: {
            favorites_info: {novel_group_id: ''},
            add_favorite_disp: true,
            remove_favorite_disp: false,
            search: ''

        },
        mounted: function () {

            this.checkFavorite();
        },
        methods: {

            checkFavorite: function () {

                var display = '@if(Auth::check()){{$novel_group->checkUserFavourite($novel_group->id)}}@endif';
                if (display) {
                    this.add_favorite_disp = false;
                    this.remove_favorite_disp = true;
                }
            },

            addToFavorite: function (novel_group_id) {
                app.favorites_info.novel_group_id = novel_group_id;
                app.$http.post('{{ route('favorites.store') }}', app.favorites_info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                        .then(function (response) {
                            //  document.getElementById('tab' + publish_company_id).style.display = 'none';
                            app.add_favorite_disp = false;
                            app.remove_favorite_disp = true;
                            // location.reload();
                        })
                        .catch(function (errors) {
                            window.location.assign('{{ url('/login')}}');
                        });
            },
            removeFromFavorite: function () {
                app.$http.delete('{{ route('favorites.destroy',['id'=>$novel_group->id]) }}', {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                        .then(function (response) {
                            //  document.getElementById('tab' + publish_company_id).style.display = 'none';
                            app.add_favorite_disp = true;
                            app.remove_favorite_disp = false;
                            // location.reload();
                        })
                        .catch(function (errors) {

                            window.location.assign('{{ url('/login')}}');
                        });
            },
            showSideMenu: function () {
                $('#socialbar').show();
            }

        }

    });

</script>
@endsection