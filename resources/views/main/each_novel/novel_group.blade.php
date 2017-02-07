@extends('../layouts.main_layout')
@section('content')
    <div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div class="wrap" id="novel_group">
            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 연재소개 -->
                <section class="novel-detail">
                    <div class="novel-detail-content">
                        <p class="thumb"><span><img src="/img/novel_covers/{{ $novel_group->cover_photo }}"
                                                    alt="공녀 엘린느"></span></p>

                        <div class="post">
                            <div class="post-header">
                                <h2 class="title">{{str_limit($novel_group->title, 35)}}</h2>

                                <p class="writer">{{$novel_group->nicknames->nickname }} <a href="#mode_nav"><i
                                                class="memo-icon">쪽지</i></a></p>

                                <p class="post-info">
                                    <span>@if(count($novel_group->keywords) >0) {{$novel_group->keywords[0]->name }} @endif</span>
                                    <span>총{{$novel_group->max_inning}}화</span>
                                    <span>조회수{{ $novel_group->getNovelGroupViewCount($novel_group->id)}}</span>
                                    <span>선호작 {{$novel_group->getNovelGroupFavoriteCount($novel_group->id)}} 명</span>
                                </p>
                            </div>
                            <div class="post-content">
                                <p>
                                    {{ substr($novel_group->description, 0,59)  }}
                                    <button class="more-btn hidden-content-view">더보기</button>
                                    <span class="hidden-content">{{substr($novel_group->description,59)}} </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="novel-view">
                        <a href="{{route('each_novel.novel_group.review',['id'=>$novel_group->id])}}"
                           class="btn btn--special" style="width:140px;">독자추천 글쓰기</a>
                        @if($novel_group->novels->count() > 0)
                            <a href="{{route('each_novel.novel_group_inning',['id'=>$novel_group->novels[0]->id])}}"
                               class="btn btn--special">첫화보기</a>
                        @endif
                    </div>

                    <div class="scrap-btns">

                        <a href="#" v-on:click="addToFavorite('{{$novel_group->id}}')" id="add_favorite"
                           v-show="add_favorite_disp"><i class="scrap-icon"></i>선호작추가</a>
                        <a href="#" class="is-active" v-on:click="removeFromFavorite()" id="remove_favorite"
                           v-show="remove_favorite_disp"><i class="scrap-active-icon"></i>선호작추가</a>
                        <a href="#share_form" data-modal-id="share_form"><i class="share-icon"></i>공유하기</a>
                    </div>
                </section>
                <!-- //연재소개 -->
                <!-- 연재회차,작가다른작품,해시태그 -->
                <div class="episode-list-content">
                    <div class="episode-list-group">
                        <!-- 최근읽은회차 -->
                        @if($recently_visited_novel)
                            <section class="episode-list-wrap episode-list-wrap--latest">
                                <h2 class="episode-title">최근 읽은 회차</h2>
                                <ul class="episode-list">
                                    <li>
                                        <div class="col-no">
                                            <span class="no">{{ $recently_visited_novel->novels->inning }}화</span>
                                            <span class="datetime">{{$recently_visited_novel->novels->created_at}}</span>
                                        </div>
                                        <div class="col-title"><a
                                                    href="{{route('each_novel.novel_group_inning',['id'=>$recently_visited_novel->novel_id])}}">{{str_limit($recently_visited_novel->novels->title,60)}}
                                                <i
                                                        class="up-icon">Up</i></a></div>
                                        <div class="col-charge"><span class="open">열림</span></div>
                                    </li>
                                </ul>
                            </section>
                            @endif
                                    <!-- //최근읽은회차 -->

                            <!-- 연재회차 -->
                            <section class="episode-list-wrap">
                                <h2 class="episode-title">연재회차</h2>
                                <ul class="episode-list">
                                    @foreach($novel_group->novels as $novel)
                                        <li>
                                            <div class="col-no">
                                                <span class="no">{{$novel->inning}} 화</span>
                                                <span class="datetime">{{$novel->created_at}}</span>
                                            </div>
                                            <div class="col-title"><a
                                                        href="{{route('each_novel.novel_group_inning',['id'=>$novel->id])}}">{{str_limit($novel->title, 60)}}{{--<i
                                                        class="up-icon">Up</i>--}}</a></div>
                                            <div class="col-charge">@if($novel->non_free_agreement > 0) 유료 @else <span
                                                        class="free">무료</span> @endif {{-- <span class="open">열림</span>--}}
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </section>
                            <!-- //연재회차 -->

                    </div>
                    <div class="episode-list-aside">
                        <!-- 작가다른작품 -->
                        <section>
                            <div class="recommend recommend--more">
                                <h2 class="recommend-title">작가의 다른 작품</h2>
                                <ul class="recommend-list">
                                    @foreach($author_novel_groups as $author_novel_group)
                                        <li>
                                            <a href="{{ route('each_novel.novel_group',['id' => $author_novel_group->id]) }}">
                                                <div class="thumb">
                                                    <span><img src="/img/novel_covers/{{ $author_novel_group->cover_photo }}"
                                                               alt=""></span>
                                                </div>
                                                <div class="post">
                                                    <strong class="title">{{str_limit($author_novel_group->title, 20)}}</strong>

                                                    <p class="post-content">
                                                        로맨스판타지<br>
                                                        총 {{$author_novel_group->max_inning}}화<br>
                                                        선호작{{$author_novel_group->favorite_count}}명
                                                    </p>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <a href="#mode_nav" class="recommend-more-btn">더보기</a>
                            </div>
                            <!-- 페이징 -->
                            <div class="page-nav page-nav--small">
                                <nav>
                                    <ul>
                                        {{ $author_novel_groups->render() }}
                                        {{--  <li><a href="#mode_nav" class="prev-page"><span>이전</span></a></li>
                                          <li><a href="#mode_nav" class="current-page">1</a></li>
                                          <li><a href="#mode_nav">2</a></li>
                                          <li><a href="#mode_nav" class="next-page"><span>다음</span></a></li>--}}
                                    </ul>
                                </nav>
                            </div>
                            <!-- //페이징 -->
                        </section>
                        <!-- //작가다른작품 -->

                        <!-- 해시태그 -->
                        <section class="hash-tag">
                            <h2 class="hash-tag-title">해시태그</h2>
                            <ul class="hash-tag-list">
                                @foreach($novel_group->keywords as $keyword)
                                    @if($loop->iteration ==1)
                                        @continue
                                    @endif
                                    <li><a href="#mode_nav">{{$keyword->name}}</a></li>
                                @endforeach

                            </ul>
                        </section>
                        <!-- //해시태그 -->
                    </div>
                </div>
                <!-- //연재회차,작가다른작품,해시태그 -->

            </div>
            <!-- //서브컨텐츠 -->
            <!-- 따라다니는퀵메뉴 -->
            @include('main.quick_menu')
                    <!-- //따라다니는퀵메뉴 -->
        </div>

    </div>
    <!-- //컨테이너 -->
    <!-- 푸터 -->
    <div id="share_form" class="share-modal" tabindex="0">
        <form name="share_form" action="{{route('search.index')}}" class="share-form" method="post">
            {{csrf_field()}}
            <fieldset class="wrap clr">
                <div id="social-links" style="width:100%;height:350px;padding:2%;align-items: center;">
                    <h2 style="color:#998878;border-bottom:1px solid #cdc7c8;">Share With Social Media</h2>

                    <div style="float:left;padding:3%">
                        <ul>
                            <li style="vertical-align:super"><a
                                        href="{{$share->facebook(route('each_novel.novel_group', $novel_group->id))}}"
                                        class="social-button " id="" style="width:2%;margin:2%;">
                                    <i class="fa fa-facebook-square fa-5x" aria-hidden="true"> </i>
                                    <span style="vertical-align:super">Share your favorite novels with friends on Facebook.</span>
                                </a>
                            </li>
                            <li><a href="{{$share->twitter(route('each_novel.novel_group', $novel_group->id))}}"
                                   class="social-button " id="" style="width:2%;margin:2%;">
                                    <i class="fa fa-twitter-square fa-5x" aria-hidden="true"> </i>
                                    <span style="vertical-align:super">Share your favorite novels with friends on twitter.</span>
                                </a>
                            </li>
                            <li><a href="{{$share->googleplus(route('each_novel.novel_group', $novel_group->id))}}"
                                   class="social-button " id="" style="width:2%;margin:2%;">
                                    <i class="fa fa-google-plus-square fa-5x" aria-hidden="true"> </i>
                                    <span style="vertical-align:super">Share your favorite novels with friends on Google+.</span>
                                </a>
                            </li>
                            <li><a href="{{$share->linkedin(route('each_novel.novel_group', $novel_group->id))}}"
                                   class="social-button " id="" style="width:2%;margin:2%;">
                                    <i class="fa fa-linkedin-square fa-5x" aria-hidden="true"> </i>
                                    <span> Share your favorite novels with friends on Linkedin.</span>
                                </a>
                            </li>
                            <li><a href="{{$share->gmail(route('each_novel.novel_group', $novel_group->id))}}"
                                   class="social-button " id="" style="width:2%;margin:2%;">
                                    <i class="fa fa-google fa-5x" aria-hidden="true"> </i>
                                    <span>Share your favorite novels with friends on Gmail.</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div style="float:right;padding:3%;">
                        <ul>
                            <li><a href="{{$share->reddit(route('each_novel.novel_group', $novel_group->id))}}"
                                   class="social-button " id="" style="width:2%;margin:2%;">
                                    <i class="fa fa-reddit-square fa-5x" aria-hidden="true"> </i>
                                    <span style="font-size:12px;">Share your favorite novels with friends on Reddit.</span>
                                </a>
                            </li>
                            <li><a href="{{$share->pinterest(route('each_novel.novel_group', $novel_group->id))}}"
                                   class="social-button " id="" style="width:2%;margin:2%;">
                                    <i class="fa fa-pinterest-square fa-5x" aria-hidden="true"> </i>
                                      <span style="font-size:12px;">Share your favorite novels with friends on Pinterest.</span>
                                </a>
                            </li>
                            <li><a href="{{$share->delicious(route('each_novel.novel_group', $novel_group->id))}}"
                                   class="social-button " id="" style="width:2%;margin:2%;">
                                    <i class="fa fa-delicious fa-5x" aria-hidden="true"> </i>
                                    <span style="font-size:12px;">Share your favorite novels with friends on Delicious.</span>
                                </a>
                            </li>
                            <li><a href="{{$share->tumblr(route('each_novel.novel_group', $novel_group->id))}}"
                                   class="social-button " id="" style="width:2%;margin:2%;">
                                    <i class="fa fa-tumblr-square fa-5x" aria-hidden="true"> </i>
                                    <span style="">Share your favorite novels with friends on Tumblr.</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
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
                                console.log(response);
                                app.add_favorite_disp = false;
                                app.remove_favorite_disp = true;
                                // location.reload();
                            })
                            .catch(function (errors) {
                                // console.log(errors);

                                // alert('login');
                                //  bootbox.alert(alert_message, function () {
                                /* $.niftyNoty({
                                 type: 'info',
                                 icon: 'fa fa-info',
                                 message: 'Thank you',
                                 container: 'floating',
                                 timer: 3000
                                 });*/
                                //  });
                            });
                },
                removeFromFavorite: function () {
                    app.$http.delete('{{ route('favorites.destroy',['id'=>$novel_group->id]) }}', {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {
                                //  document.getElementById('tab' + publish_company_id).style.display = 'none';
                                console.log(response);
                                app.add_favorite_disp = true;
                                app.remove_favorite_disp = false;
                                // location.reload();
                            })
                            .catch(function (errors) {

                                console.log(errors);
                            });
                }

            }

        });

    </script>

@endsection