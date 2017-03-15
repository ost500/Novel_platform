@extends('../layouts.main_layout')
@section('content')
    <!-- 컨테이너 -->
    <div class="container">
        <div class="wrap">
            <!-- LNB -->
        @include('main.my_page.left_sidebar')
        <!-- //LNB -->

            <!-- 서브컨텐츠 -->
            <div class="content" id="content">
                <!-- 페이지헤더 -->
                <div class="list-header">
                    <h2 class="title">소식</h2>
                </div>
                <!-- 페이지헤더 -->

                <!-- 소식 -->
                <ul class="alarm-list alarm-list--news">
                    @foreach ($new_speeds as $new_speed)
                        <li>
                            <div class="thumb">
                                <img src="{{ $new_speed->image }}" alt="">
                            </div>
                            <div class="post">
                                <p class="post-content">
                                    <a @if (!$new_speed->read)style="color: #5db38e" @endif
                                    href="{{ route('my_page.novels.new_speed.read', ['id' => $new_speed->id]) }}">{{ $new_speed->title }}</a>
                                </p>
                                <p class="post-datetime">{{ time_elapsed_string($new_speed->created_at) }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <!-- //소식 -->
                @include('pagination_front', ['collection' => $new_speeds, 'url' => route('my_page.novels.new_speed')."?"])
            </div>
            <!-- //서브컨텐츠 -->

            <!-- 따라다니는퀵메뉴 -->
            @include('main.quick_menu')
            <!-- //따라다니는퀵메뉴 -->
        </div>
    </div>
    <!-- //컨테이너 -->

@endsection