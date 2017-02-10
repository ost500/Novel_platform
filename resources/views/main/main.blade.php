@extends('layouts.main_layout')
@section('content')

        <!-- 컨테이너 -->
<div class="container" id="content" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <!-- 정오 -->
    <section class="noon" style="text-align: center;">
        <div class="wrap">
            <h2 class="noon-title"><span>여</span>기, <span>정</span>오의 <span>추천</span></h2>
            <ul class="noon-list clr">
                @foreach($recommends as $recommend)
                    <li>
                        <a href="{{route('each_novel.novel_group',['id'=>$recommend->id])}}">
                            <p class="thumb"><img src="/img/novel_covers/{{$recommend->cover_photo}}" alt=""></p>

                            <p class="book-title">{{str_limit($recommend->title, 15)}}</p>

                            <p class="author">{{str_limit($recommend->nicknames->nickname,15)}}</p>
                        </a>
                    </li>
                @endforeach
            </ul>

        </div>

    </section>
    <!-- //정오 --> {{--left:{{$pop_up_position}}}}px;--}}
    <div id="popup"style="text-align:center;  top: 210px;	overflow: hidden;width:100%;border:0px solid black;z-index: 200;position: absolute;" onmousedown="startDrag(event,popup)">
       {{-- @php $pop_up_position=64; @endphp--}}
        @foreach($notification_popups as $notification_popup)

            <div id="popup{{$notification_popup->id}}" style="text-align:center;display:inline-block;z-index: 200;height:435px;width:20% ;border: 1px solid #cdc7c8;
                 background: #f5f5f5;" onmousedown="startDrag(event,popup{{$notification_popup->id}})">

                    <a href="#" v-on:click="close({{$notification_popup->id}})" class="close">&times;</a><br>

                    <a href="{{route('ask.notification_detail',['id'=>$notification_popup->id])}}">
                        <p style="text-align: center;">
                            <img src="/img/notification_pictures/{{$notification_popup->picture}}"
                                 style="width:96%;height: 350px;" alt="">
                        </p>
                    </a>
                    <form>
                     Disable popup for today? <input type="checkbox" name="popup_disable" id="popup_disable" v-on:click="blockPopup('{{$notification_popup->id}}')">
                    </form>

             {{--   @php $pop_up_position=$pop_up_position+300; @endphp--}}
            </div>
        @endforeach
    </div>
    <!-- 메인소설 -->
    <div class="wrap">
        <!-- 유료연재베스트 -->
        <section class="latest-wrap latest-wrap--charge">
            <h2 class="latest-title"><span>유료연재</span> 투데이 베스트</h2>
            <ol class="latest latest--rank latest--rank--charge"
                @if(count($non_free_today_bests) < 7 ) style="padding-bottom: 110px" @endif >
                @foreach($non_free_today_bests as $today_best)
                    <li>
                        <a href="{{route('each_novel.novel_group',['id'=>$today_best->id])}}">
                            <p class="thumb"><img src="/img/novel_covers/{{$today_best->cover_photo}}" alt="">
                            </p>
                            @if($loop->first)
                                <p class="book-title">{{ str_limit($today_best->title, 17) }}</p>
                            @else
                                <p class="book-title">{{ str_limit($today_best->title, 10) }}</p>
                            @endif
                            <p class="author">{{ str_limit($today_best->nicknames->nickname, 13) }}</p>
                        </a>
                    </li>
                @endforeach
            </ol>
            <a href="{{route('bests')}}" class="latest-more-btn">더보기</a>
        </section>
        <!-- //유료연재베스트 -->

        <!-- 무료,새소설,독자추천 -->
        <div class="latest-content">
            <div class="latest-group">
                <!-- 무료연재베스트 -->
                <section class="latest-wrap latest-wrap--free">
                    <h2 class="latest-title"><span>무료연재</span> 투데이 베스트 </h2>
                    <ol class="latest latest--rank">
                        @foreach($free_today_bests as $free_today_best)
                            <li>
                                <a href="{{route('each_novel.novel_group',['id'=>$free_today_best->id])}}">
                                    <p class="thumb"><img
                                                src="img/novel_covers/{{$free_today_best->cover_photo}}"
                                                alt=""></p>

                                    <p class="book-title">{{ str_limit($free_today_best->title, 15) }}</p>

                                    <p class="author">{{ str_limit($free_today_best->nicknames->nickname, 10) }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ol>
                    <a href="{{route('bests').'/free'}}" class="latest-more-btn">더보기</a>
                </section>
                <!-- //무료연재베스트 -->

                <!-- 새로등록된소설 -->
                <section class="latest-wrap latest-wrap--new">
                    <h2 class="latest-title">새로 등록된 소설</h2>
                    <ul class="latest">
                        @foreach($latests as $latest)
                            <li>
                                <a href="{{route('each_novel.novel_group',['id'=>$latest->id])}}">
                                    <p class="thumb"><img src="img/novel_covers/{{$latest->cover_photo}}"
                                                          alt=""></p>

                                    <p class="book-title">{{ str_limit($latest->title, 15) }}</p>

                                    <p class="author">{{ str_limit($latest->nicknames->nickname, 10) }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    {{--   <a href="{{route('bests')}}" class="latest-more-btn">더보기</a>--}}
                </section>
                <!-- //새로등록된소설 -->
            </div>
            <!-- 독자추천 -->
            <section class="recommend recommend--main">
                <h2 class="recommend-title">독자추천</h2>
                <ul class="recommend-list">
                    @foreach($reader_reviews as $reader_review)
                        <li>
                            <a href="{{route('reader_reco.detail',['id'=>$reader_review->id])}}">
                                <div class="thumb">
                                        <span><img src="img/novel_covers/{{$reader_review->novel_groups->cover_photo}}"
                                                   alt=""></span>
                                </div>
                                <div class="post">
                                    <strong class="title">{{$reader_review->title}}</strong>

                                    <p class="post-content">{{ str_limit($reader_review->review,100)}}</p>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <a href="{{route('reader_reco')}}" class="recommend-more-btn">더보기</a>
            </section>
            <!-- //독자추천 -->
        </div>
        <!-- //무료,새소설,독자추천 -->

        <!-- 회원님을위한추천 -->
        <section class="custom-latest-wrap">

            @if(Auth::check())
                <h2 class="custom-latest-title"><span>
                            {{ Auth::user()->name }}
                            </span>님을 위한 추천</h2>
            @else
                <h2 class="custom-latest-title"><span>
                            추천
                            </span>인기 소설</h2>
            @endif

            <ul class="latest">
                @foreach($recommendations as $recommendation)
                    <li>
                        <a href="{{route('each_novel.novel_group',['id'=>$recommendation->id])}}">
                            <p class="thumb"><img src="img/novel_covers/{{$recommendation->cover_photo}}"
                                                  alt="">
                            </p>

                            <p class="book-title">{{ str_limit($recommendation->title, 15) }}</p>

                            <p class="author">{{ str_limit($recommendation->nicknames->nickname, 10) }}</p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
        <!-- //회원님을위한추천 -->
    </div>
    <!-- //메인소설 -->
</div>
<!-- //컨테이너 -->

<script type="text/javascript">
    var app_main = new Vue({
        el: '#content',
        data: {
            increment: 100,
            pop_up_position: 365
        },

        mounted: function () {
           var abc= localStorage.toLocaleString();
           console.log(abc);
        },

        methods: {
            close: function (popup_id) {
                $('#popup' + popup_id).hide();
            },

            blockPopup: function (popup_id) {
                $('#popup' + popup_id).hide();
                localStorage.setItem('popup_id',popup_id);
                var abc= localStorage.getItem('popup_id');
                console.log(abc);
           /*         app.$http.put('{{--{{ route('maillog.update') }}--}}', popup_id, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {
                                location.reload();

                            }).catch(function (errors) {
                                console.log(errors);
                            });*/

            }




        }
    });

   /* window.onload = function() {

        // Check for LocalStorage support.
        if (localStorage) {
            alert('fdfdf');
      /!*      // Add an event listener for form submissions
            document.getElementById('contactForm').addEventListener('submit', function() {
                // Get the value of the name field.
                var name = document.getElementById('name').value;

                // Save the name in localStorage.
                localStorage.setItem('name', name);
            });*!/

        }else{ alert('dddddddddddd'); }*/


</script>

@endsection