@extends('layouts.mobile_layout')
@section('content')
        <!-- 상단 비주얼 -->
<div class="serial_topvs_wrap" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml">
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
            {{--  <div class="padt40">
                  <a href="{{route('each_novel.novel_group.review',['id'=>$novel_group->id])}}"
                     class="btn_line_green full" style="margin-bottom:5px;">독자추천 글쓰기</a>
                  @if($novel_group->novels->count() > 0)
                      <a href="{{route('each_novel.novel_group_inning',['id'=>$novel_group->novels[0]->id])}}"
                         class="btn_line_green full">첫화보기</a>
                  @endif
              </div>--}}

            <!-- 첫화보기 버튼 //-->
        </div>
    </div>
    <!-- 상단 비주얼 내용 //-->
</div>
<!-- 상단 비주얼 -->
<!-- 내용 -->
<div class="container">
    <div class="cont_wrap" id="purchase">
        <!-- 연재회차 -->
        <div class="">
            <div class="mlist_tit_rwap">
                <h2 class="mlist_tit2">구입할 소설</h2>
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
                    <td class="inning">{{ $novel->inning }}화</td>
                    <td class="contxt">
                        <a href="{{route('each_novel.novel_group_inning',['id'=>$novel->id])}}">
                            <div class="borCont">{{str_limit($novel->title,60)}}</div>
                        </a>
                        <span class="time2">{{$novel->created_at}}</span>
                    </td>
                    <td class="talC"><span class="red">열림</span></td>
                </tr>
                </tbody>
            </table>
            <!-- 게시글 테이블 //-->
        </div>
        <!-- 연재회차 //-->
        <div class="">
            <div class="mlist_tit_rwap">
                <h2 class="mlist_tit2">구슬충전</h2>
            </div>
            <div class="myInfo_mn_wrap">
                <a href="{{ route('my_info.charge_bead')}}" class="myInfo_mn_a">
                    <span class="btn_green2 "
                          style="font-size: 20px; font-weight: normal;padding: 11px 18px 7px 18px;height:38px;line-height:19px;">구슬충전</span></a>
                <ul class="myInfo_mn" style="border-top: 0px; ">
                    <li style="border-top: 1px solid #99897a;width:50%">
                        <a class="myInfo_mn_a">
                            <span class="icon_img marble">구슬</span>
                            <span class="myInfo_1">보유구슬</span>
                            <span class="myInfo_num">{{ Auth::user()->bead }}개</span>

                            <span class="checkbox1">
                                <input type="checkbox" name="remember" class="chb"
                                       id="auto_login_check" value="Bead"
                                       v-model="purchase_info.BeadOrPiece"
                                       style="float: left;margin: 5px 0 0 65px;">
                                <span class="myInfo_1" style="margin: 13px 50px 0 0;">구슬 사용</span>
                            </span>
                        </a>
                    </li>
                    <li style="border-top: 1px solid #99897a;width:50%">
                        <a class="myInfo_mn_a">
                            <span class="icon_img piece">조각</span>
                            <span class="myInfo_1">보유조각</span>
                            <span class="myInfo_num">{{ Auth::user()->piece }}개</span>
                          <span class="checkbox2">
                              <input type="checkbox" name="remember" class="chb"
                                     id="auto_login_check" value="Piece"
                                     v-model="purchase_info.BeadOrPiece"
                                     style="float: left;margin: 5px 0 0 65px;">
                             <span class="myInfo_1" style="margin: 13px 50px 0 0;">조각 사용</span>
                          </span>
                        </a>
                    </li>

                    <a style="cursor:pointer" v-on:click="purchase()"><span class="btn_green full"
                                                                            style="margin-top:5px;text-align:center;">구입하기</span></a>

                </ul>

            </div>

            <!-- 게시글 테이블 //-->
        </div>
        <!-- 연재회차 //-->

        <!-- 작가의 다른 작품 -->
        @if(!$author_novel_groups->isEmpty())
            <div class="">
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

    var app_purchase = new Vue({
        el: '#purchase',
        data: {
            purchase_info: {
                novel_id: '{{ $novel->id }}',
                BeadOrPiece: ''
            }
        },
        methods: {

            purchase: function () {

                var bead_piece = $(".chb:checked").map(function () {
                    return this.value;
                }).get();
                app_purchase.purchase_info.BeadOrPiece = bead_piece[0];
                if (app_purchase.purchase_info.BeadOrPiece == "") {
                    alert('구슬과 조각 둘 중의 결제 방법을 선택하세요')
                    return;
                } else {

                    if (app_purchase.purchase_info.BeadOrPiece == "Piece") {
                        if (!confirm('조각을 사용하시겠습니까?')) {
                            return;
                        }
                    } else {
                        if (!confirm('구슬을 사용하시겠습니까?')) {
                            return;
                        }
                    }


                }

                app_purchase.$http.post('{{ route('each_novel.novel_group_inning.purchase.post', ['id' => $novel->id]) }}', app_purchase.purchase_info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                        .then(function (response) {

                            //console.log(response);
                            window.location.assign('/novel_group_inning/{{ $novel->id }}');
                        })
                        .catch(function (errors) {

                            //  console.log("error here");
                            // console.log(errors);
                        });
                // console.log(app_purchase.purchase_info);
            }


        }

    });
    $(".chb").change(function () {
        $(".chb").prop('checked', false);
        $(this).prop('checked', true);

    });

</script>
@endsection