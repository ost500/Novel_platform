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

                                <p class="writer">{{$novel_group->nicknames->nickname }} <a
                                            href="{{ route('mails.create', ['id' => $novel_group->users->id]) }}"><i
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


                        <section class="episode-list-wrap episode-list-wrap--latest">
                            <h2 class="episode-title">구입할 소설</h2>
                            <ul class="episode-list">
                                <li>
                                    <div class="col-no">
                                        <span class="no">{{ $novel->inning }}화</span>
                                        <span class="datetime">{{$novel->created_at}}</span>
                                    </div>
                                    <div class="col-title"><a
                                                href="{{route('each_novel.novel_group_inning',['id'=>$novel->id])}}">{{str_limit($novel->title,60)}}
                                            <i
                                                    class="up-icon">Up</i></a></div>
                                    <div class="col-charge"><span class="open">열림</span></div>
                                </li>
                            </ul>
                        </section>
                        <a href="{{route('my_info.charge_bead')}}" class="btn btn--submit">구슬충전</a>
                        <section class="myinfo">
                            <div class="myinfo-box">

                                <!-- 보유구슬 -->
                                <div class="col-marble">
                                    <i class="marble3-icon"></i>
                                    <span class="item-name">보유구슬</span>
                                    <strong class="item-count">{{ Auth::user()->bead }}개</strong>
                                    <span class="item-etc">
                                        <span class="checkbox1">
                                            <input type="radio" name="remember"
                                                   id="auto_login_check" value="Bead"
                                                   v-model="purchase_info.BeadOrPiece">
                                            <label for="auto_login_check">구슬 사용</label>
                                        </span>
                                    </span>
                                </div>
                                <!-- 보유조각 -->
                                <div class="col-piece">
                                    <i class="piece3-icon"></i>
                                    <span class="item-name">보유조각</span>
                                    <strong class="item-count">{{ Auth::user()->piece }}개</strong>
                                    <span class="item-etc">
                                        <span class="checkbox1">
                                            <input type="radio"
                                                   name="remember"
                                                   id="auto_login_check" value="Piece"
                                                   v-model="purchase_info.BeadOrPiece">
                                            <label for="auto_login_check">조각 사용</label>
                                        </span>
                                    </span>
                                </div>

                            </div>
                        </section>

                        <!-- //최근읽은회차 -->
                        <section class="novel-detail">

                            <div style="position:static; float:right" class="novel-view">
                                <a style="cursor:pointer" v-on:click="purchase()"
                                   class="btn btn--special">구입하기</a>
                            </div>
                        </section>
                    </div>
                    <div class="episode-list-aside">
                        <!-- 작가다른작품 -->
                        @if(!$author_novel_groups->isEmpty())
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
                                                            @if(count($novel_group->keywords) >0) {{$novel_group->keywords[0]->name }} @endif
                                                            <br>
                                                            총 {{$author_novel_group->max_inning}}화<br>
                                                            선호작{{$author_novel_group->favorite_count}}명
                                                        </p>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    {{--<a href="#mode_nav" class="recommend-more-btn">더보기</a>--}}
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
                            @endif

                                    <!-- 해시태그 -->
                            @if(!$novel_group->hash_tags->isEmpty())
                                <section class="hash-tag">
                                    <h2 class="hash-tag-title">해시태그</h2>
                                    <ul class="hash-tag-list">
                                        @foreach($novel_group->hash_tags as $hash_tag)
                                            <li><a href="">{{$hash_tag->tag}}</a></li>
                                        @endforeach

                                    </ul>
                                </section>
                             @endif
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
@section('header')
    {{--  @php $thumbnail = 'http://homestead.app/img/novel_covers/{{$novel_group->cover_photo}}' @endphp--}}
    @include('social_share', ['url' =>route('each_novel.novel_group', $novel_group->id),'title'=>$novel_group->title,'thumbnail'=>''])
@endsection
<script type="text/javascript">
    var app = new Vue({
        el: '#novel_group',
        data: {
            favorites_info: {novel_group_id: ''},
            add_favorite_disp: true,
            remove_favorite_disp: false,
            search: '',
            purchase_info: {
                novel_id: '{{ $novel->id }}',
                BeadOrPiece: ''
            }

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
                            //  console.log(response);
                            app.add_favorite_disp = false;
                            app.remove_favorite_disp = true;
                            // location.reload();
                        })
                        .catch(function (errors) {
                            window.location.assign('/login?loginView=true');
                        });
            },
            removeFromFavorite: function () {
                app.$http.delete('{{ route('favorites.destroy',['id'=>$novel_group->id]) }}', {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                        .then(function (response) {
                            //  document.getElementById('tab' + publish_company_id).style.display = 'none';
                            // console.log(response);
                            app.add_favorite_disp = true;
                            app.remove_favorite_disp = false;
                            // location.reload();
                        })
                        .catch(function (errors) {

                            window.location.assign('/login?loginView=true');
                        });
            },
            purchase: function () {

                if (app.purchase_info.BeadOrPiece == "") {
                    alert('구슬과 조각 둘 중의 결제 방법을 선택하세요')
                    return;
                } else {

                    if (app.purchase_info.BeadOrPiece == "Piece") {
                        if (!confirm('조각을 사용하시겠습니까?')) {
                            return;
                        }
                    } else {
                        if (!confirm('구슬을 사용하시겠습니까?')) {
                            return;
                        }
                    }


                }

                app.$http.post('{{ route('each_novel.novel_group_inning.purchase.post', ['id' => $novel->id]) }}', app.purchase_info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                        .then(function (response) {

                            // console.log(response);
                            window.location.assign('/novel_group_inning/{{ $novel->id }}');
                        })
                        .catch(function (errors) {

                            //console.log("error here");
                            //console.log(errors);
                        });
                //  console.log(app.purchase_info);
            }


        }

    });


</script>

@endsection