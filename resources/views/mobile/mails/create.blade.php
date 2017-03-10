@extends('layouts.mobile_mypage_layout')
@section('content')
        <!-- 내용 -->
<div class="container">
    <div class="cont_wrap">
        @include('mobile.my_page.select_bar')

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

                    <!-- 서브컨텐츠 -->
            <div class="content" id="content">

                <div class="mlist_tit_rwap2">
                    <h2 class="mlist_tit4">쪽지보내기</h2>
                </div>
                <div class="dot_top"></div>

                <!-- 문의유형 체크 -->
                <form name="ask_queston" id="ask_queston" action="{{route('mailbox.store_specific_mail')}}"
                      method="post"
                      enctype="multipart/form-data">
                    {{csrf_field()}}
                    <fieldset style="margin-top:10%;">
                        <legend class="screen_out">쪽지보내기</legend>


                        @if($user)
                            <input type="text" name="to" id="to" class="inputBasic full"  value="{{$user->email}}"
                                   placeholder="Enter Email.">
                        @else
                            <input type="text" name="to" id="to"  class="inputBasic full" value="{{old('to')}}"
                                   placeholder="Enter Email.">
                        @endif
                                    <!-- 제목입력 -->
                            <input type="text" name="subject" id="subject" class="inputBasic full  mart15"
                                   value="{{old('subject')}}" placeholder="제목을 입력해주세요.">
                            <!-- 내용입력 -->
                            <textarea class="repl_txtar mart15" rows="3" cols="30" placeholder="내용을 입력해주세요." name="body"
                                      id="body" >@if(old('body')){{old('body')}} @endif</textarea>

                            <div class="padtb20">
                                <a class="file_att" style="cursor:pointer;">첨부파일<input type="file" title="첨부파일" name="attachment"
                                                               id="attachment" style="position:absolute;left:40px;opacity:0;width:85%;height: 5%;cursor:pointer;"></a>
                                <span class="file_path">파일이 없습니다.</span>

                            </div>
                            <div class="otherinf">JPG, GIF, PNG 파일 형식의 이미지를 최대 3장까지 첨부할 수 있습니다.(5MB 이하)</div>

                            <div class="padtb20">
                                <input type="hidden" name="redirect" id="redirect" value="1">
                                <button type="submit" class="btn_green full">문의하기</button>
                            </div>
                    </fieldset>
                </form>

                <!-- 문의내용 입력 //-->
            </div>
    </div>
    <!-- 내용 //-->
</div>
<script type="text/javascript">
$('#attachment').change( function(){
    var file= $('#attachment')[0].files[0];
   if(file) {
       $('.file_path').html(file.name);
   }
});

</script>
@endsection