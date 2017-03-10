@extends('layouts.mobile_layout')
@section('content')
        <!-- 내용 -->
<div class="container">
    <div class="cont_wrap">
        <!-- 타이틀 -->
        <div class="view_tit_box mart20" style="border-top:0;">
            <h2 class="view_tit">{{ $faq->title }}
            </h2>

            <div class="expatiate_wrap">
                <span class="expatiate">작성일 {{ $faq->created_at }}</span>
                <span class="author"
                      style="border-left: 1px solid #cdc7c8;padding-left:1%">Admin</span>
                <span class="expatiate"></span>
            </div>
        </div>
        <!-- 타이틀 //-->

        <!-- 본문 -->
        <div class="view_article_wrap" style="padding: 30px;">
            <div class="view_artic_cont">
                <?php echo nl2br($faq->description); ?>
            </div>
        </div>

        <!-- 버튼 -->
        <div class="veiw_btn_wrap">
            <div class="mart20"><a href="{{ route('ask.faqs') }}" class="btn_list_view full">목록</a></div>
        </div>
        <!-- 버튼 //-->


        @if($pre_faq != null)
            <div class="view_tit_box mart20">
                <span class="head"><i class="fa fa-arrow-up"></i>이전글</span>
                <a href="{{ route('ask.faq_detail',['id'=>$pre_faq->id]).$query_string }}"> <span
                            class="view_tit"> {{str_limit($pre_faq->title,25)}}</span></a>

                <div class="expatiate_wrap">
                    <span class="author">Admin</span>
                    <span class="expatiate">{{ $pre_faq->created_at->format('Y-m-d') }}</span>
                </div>
            </div>
        @endif
        @if($next_faq != null)
            <div class="view_tit_box mart20">
                <span class="head "><i class="fa fa-arrow-down"></i>다음글</span>
                <a href="{{ route('ask.faq_detail',['id'=>$next_faq->id]).$query_string }}">
                    <span class="view_tit">{{str_limit($next_faq->title,25)}}</span></a>

                <div class="expatiate_wrap">
                    <span class="author">Admin</span>
                    <span class="expatiate">{{ $next_faq->created_at->format('Y-m-d') }}</span>
                </div>

            </div>


        @endif


    </div>
</div>
<!-- 내용 //-->
@endsection