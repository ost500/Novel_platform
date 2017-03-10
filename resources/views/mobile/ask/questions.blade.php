@extends('layouts.mobile_layout')
@section('content')
        <!-- 내용 -->
<div class="container">
    <div class="cont_wrap" id="questions">
        @include('mobile.ask.select_bar')

                <!-- 문의내역 -->
        <div>
            <div class="mlist_tit_rwap2">
                <h2 class="mlist_tit4">
                    문의내역
                    <a href="{{route('m.ask.ask_question')}}" class="mlist_tit_btn go">문의하러 가기</a>
                </h2>
            </div>

            <table class="tbl_dotline">
                <colgroup>
                    <col width="*">
                    <col width="20%">
                </colgroup>
                <tbody>
                @foreach($questions as $question)
                    <tr>
                        <td class="contxt">
                            <a href="{{route('m.ask.question_detail',['id'=>$question->id])}}">
                                <div class="borCont">{{$question->title}}</div>
                            </a>

                            <div class=""><span class="brw_22">{{$question->category}}</span>
                                <span class="gra_20 marL8">{{$question->created_at}}</span>
                            </div>
                        </td>
                        @if($question->status == 1)
                            <td class="ans_finish">답변완료</td>
                        @else
                            <td class="unread">읽지않음</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="spac20"></div>
        </div>
        <!-- 문의내역 //-->
        @include('pagination_mobile', ['collection' => $questions, 'url' => route('m.ask.questions').'?'])
    </div>
</div>
<!-- 내용 //-->
<script type="text/javascript">
    var questions = new Vue({
        el: '#questions',
        data: {
            optionValue: ''
        },
        methods: {
            callUrl: function () {

                //Get the selected value
                this.optionValue = $('#servicesSelect').val();
                console.log( this.optionValue);
                //Based on values make a request
                if (this.optionValue == '자주 묻는 질문') {
                    location.assign('{{route('m.ask.faqs')}}');
                } else if (this.optionValue == '1:1문의') {
                    location.assign('{{route('m.ask.ask_question')}}');
                } else if (this.optionValue == '공지사항') {
                    location.assign('{{route('m.ask.notifications')}}');

                }
            }

        }
    });
</script>
@endsection