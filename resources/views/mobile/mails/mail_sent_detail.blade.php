@extends('layouts.mobile_layout')
@section('content')
        <!-- 내용 -->
<div class="container">
    <div class="cont_wrap">
        <!-- 타이틀 -->
        <div class="view_tit_box mart20" style="border-top:0;">
            <h2 class="view_tit">{{ $mail->subject }}
            </h2>

            <div class="expatiate_wrap">
                <span class="expatiate">작성일 {{ $mail->created_at }}</span>
                 <span class="author"
                       style="border-left: 1px solid #cdc7c8;padding-left:1%">{{ $mail['users']['name'] }}</span>
            </div>
        </div>
        <!-- 타이틀 //-->

        <!-- 본문 -->
        <div class="view_article_wrap" style="padding: 30px;">
            <div class="view_artic_cont">
                <?php echo nl2br($mail->body); ?>
            </div>
        </div>

        <!-- 버튼 -->
        <div class="veiw_btn_wrap">
            <div class="mart20"><a href="{{ route('mails.sent') }}" class="btn_list_view full">목록</a></div>
        </div>
        <!-- 버튼 //-->


        @if($prev_mail != null)
            <div class="view_tit_box mart20">
                <span class="head"><i class="fa fa-arrow-up"></i>이전글</span>
                <a href="{{ route('mails.sent_detail',['id'=>$prev_mail->id]) }}"> <span
                            class="view_tit"> {{str_limit($prev_mail->subject,25)}}</span></a>

                <div class="expatiate_wrap">
                    <span class="author">{{$prev_mail['users']['name']}}</span>
                    <span class="expatiate">{{ $prev_mail->created_at->format('Y-m-d') }}</span>
                </div>
            </div>
        @endif
        @if($next_mail != null)
            <div class="view_tit_box mart20">
                <span class="head "><i class="fa fa-arrow-down"></i>다음글</span>
                <a href="{{ route('mails.sent_detail',['id'=>$next_mail->id]) }}">
                    <span class="view_tit">{{str_limit($next_mail->subject,25)}}</span></a>

                <div class="expatiate_wrap">
                    <span class="author">{{$next_mail['users']['name']}}</span>
                    <span class="expatiate">{{ $next_mail->created_at->format('Y-m-d') }}</span>
                </div>

            </div>


        @endif


    </div>
</div>
<!-- 내용 //-->
@endsection