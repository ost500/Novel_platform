@extends('../layouts.main_layout')
@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div class="wrap" id="novel_group_notifications">
            <!-- LNB -->
            @include('main.my_page.left_sidebar')
                    <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 페이지헤더 -->
                <div class="list-header">
                    <h2 class="title">신작알림</h2>
                </div>
                <!-- //페이지헤더 -->

                <!-- 신작알림 -->
                <ul class="new-work-list">
                    @if($authors->isEmpty())
                        <ul class="author-new-work-list" style="margin-left: 80px;">
                            <li style="width:100%;text-align:center;">
                                <div class="post" style="margin-left: 30px;"><span class="title"> 신작이 없습니다.</span>
                                </div>
                            </li>
                        </ul>

                    @endif

                    @foreach($authors as $author )
                        <li>
                            <strong class="author-name">{{$author->nickname}}</strong>
                            <ul class="author-new-work-list">
                                @foreach($notifications[$author->user_id] as $notification )
                                    <li>
                                        <div class="thumb"><a
                                                    href="{{route('each_novel.novel_group',['id'=>$notification->id])}}"><img
                                                        src="/img/novel_covers/{{$notification->cover_photo}}"
                                                        alt="괴롭히고 싶다"></a></div>
                                        <div class="post">
                                            <strong class="title"><a
                                                        href="{{route('each_novel.novel_group',['id'=>$notification->id])}}">{{str_limit($notification->title,20)}}</a></strong>
                                            <span class="datetime">{{$notification->notification_date}}</span>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                          <div class="new-work-close">
                                  <button type="button" class="userbtn userbtn--close" v-on:click="remove_notifications('{{$author->user_id}}')" >삭제</button>
                            </div>
                        </li>
                    @endforeach

                </ul>
                <!-- //신작알림 -->
            </div>
            <!-- //서브컨텐츠 -->
            <!-- 따라다니는퀵메뉴 -->
            @include('main.quick_menu')
                    <!-- //따라다니는퀵메뉴 -->
        </div>
    </div>
    <!-- //컨테이너 -->
    <!-- 푸터 -->

    <script>
        var app_noti = new Vue({
            el: '#novel_group_notifications',
            data: {

            },

            methods: {
                remove_notifications:function(author_id){
                    if(confirm('선호작에서 제외 하시겠습니까?')){
                        this.$http.delete('{{ route('novel_group_notifications.destroy',['id'=>""]) }}/'+author_id, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                                .then(function (response) {
                                    location.reload();
                                })
                                .catch(function (errors) {

                                    window.location.assign('/login?loginView=true');
                                });
                    }

                }
            }
        });
    </script>
@endsection