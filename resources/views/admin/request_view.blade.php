@extends('layouts.admin_layout')

@section('content')
    <div id="content-container">

        <div id="page-title">
            <h1 class="page-header text-overflow">1:1문의내역</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">어드민</a></li>
            <li class="active"><a href="#">1:1문의내역</a></li>
        </ol>


        <div id="page-content">
            <div id="show_errors"></div>
            <div class="panel">
                <div class="panel-body">


                    <div class="row">
                        <div class="col-sm-7">

                            <!--Sender Information-->
                            <div class="media">
                                <div class="media-body">
                                    <div class="text-bold request-subject">{{ $men_to_men_request->title }}</div>
                                </div>
                            </div>
                        </div>
                        <hr class="hr-sm visible-xs">
                        <div class="col-sm-5 clearfix">

                            <!--Details Information-->
                            <div class="pull-right text-right">
                                <p class="mar-no">

                                <div class="text-muted">{{$men_to_men_request->created_at}}</div>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!--Message-->
                    <!--===================================================-->
                    <div class="pad-all bord-all bg-gray-light">
                        {{$men_to_men_request->question}}
                    </div>

                    <div class="pad-top">
                        @if($men_to_men_request->status == "1")
                            <h5>답변시간 <span>{{$men_to_men_request->updated_at}}</span></h5>
                        @endif
                    </div>

                    <div class="pad-all bord-all bg-gray-light margin-top-10">
                        <form id="answer_form">
                            <div class="review-of pad-all">
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <textarea name="answer" hidden="" id="demo-textarea-input" rows="10"
                                          class="form-control inline" style="width:100%"
                                          placeholder="답변 내용을 입력해주세요.">{{$men_to_men_request->answer}}</textarea>
                                <button id="reply_post_btn" class="btn btn-primary inline"
                                        style="width:100px;height:48px; vertical-align:top;">등록
                                </button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>

            <div class="panel">
                <div class="panel-body">

                    <!--Mail list group-->
                    <ul id="demo-mail-list" class="mail-list">
                    @foreach($men_to_men_requests as $request)
                        <!--Mail list item-->
                            <li class="mail-list-unread">
                                <div class="mail-from">
                                    <button @if($request->answer == "") class="btn btn-xs btn-danger">대기
                                        @else class="btn btn-xs btn-success" >완료 @endif
                                    </button>
                                </div>

                                <div class="mail-time">{{$request->created_at}}</div>

                                <div class="mail-subject">
                                    <a href="{{ url('admin/request/'. $request->id.'?page='.$men_to_men_requests->currentPage()) }}">{{$request->title}} </a>

                                </div>
                            </li>
                        @endforeach

                    </ul>


                    <div class="fixed-table-pagination" style="display: block;">
                        <div class="pull-left">
                            <ul class="pagination">

                                {{-- $men_to_men_requests->render() --}}
                                <li class="page-first  @if($men_to_men_requests->currentPage() ==1)  disabled @endif">
                                    <a href=" @if($men_to_men_requests->currentPage() ==1)  #  @else {{url('/admin/request/'.$men_to_men_request->id."?page=1")}} @endif">
                                        &lt;&lt;</a>
                                </li>
                                @if($men_to_men_requests->currentPage() >= 2)
                                    <li class="page-pre">
                                        <a href="{{url('/admin/request/'.$men_to_men_request->id."?page=".($men_to_men_requests->currentPage()-1))}}">
                                            &lt;</a></li>
                                @endif
                                @if($men_to_men_requests->currentPage() >= 5)
                                    <li class="page-pre"><a
                                                href="{{url('/admin/request/'.$men_to_men_request->id."?page=".($men_to_men_requests->currentPage()-4))}}">{{$men_to_men_requests->currentPage()-4}}</a>
                                    </li>
                                @endif
                                @if($men_to_men_requests->currentPage() >= 4)
                                    <li class="page-pre"><a
                                                href="{{url('/admin/request/'.$men_to_men_request->id."?page=".($men_to_men_requests->currentPage()-3))}}">{{$men_to_men_requests->currentPage()-3}}</a>
                                    </li>
                                @endif
                                @if($men_to_men_requests->currentPage() >= 3)
                                    <li class="page-pre"><a
                                                href="{{url('/admin/request/'.$men_to_men_request->id."?page=".($men_to_men_requests->currentPage()-2))}}">{{$men_to_men_requests->currentPage()-2}}</a>
                                    </li>
                                @endif
                                @if($men_to_men_requests->currentPage() >= 2)
                                    <li class="page-pre"><a
                                                href="{{url('/admin/request/'.$men_to_men_request->id."?page=".($men_to_men_requests->currentPage()-1))}}">{{$men_to_men_requests->currentPage()-1}}</a>
                                    </li>
                                @endif

                                <li class="page-number active"><a href="#">{{ $men_to_men_requests->currentPage()}}</a>
                                </li>

                                @if($men_to_men_requests->lastPage()-1 >= $men_to_men_requests->currentPage())
                                    <li class="page-number"><a
                                                href="{{url('/admin/request/'.$men_to_men_request->id."?page=".($men_to_men_requests->currentPage()+1))}}">{{$men_to_men_requests->currentPage()+1}}</a>
                                    </li>
                                @endif
                                @if($men_to_men_requests->lastPage()-2 >= $men_to_men_requests->currentPage())
                                    <li class="page-number"><a
                                                href="{{url('/admin/request/'.$men_to_men_request->id."?page=".($men_to_men_requests->currentPage()+2))}}">{{$men_to_men_requests->currentPage()+2}}</a>
                                    </li>
                                @endif
                                @if($men_to_men_requests->lastPage()-3 >= $men_to_men_requests->currentPage())
                                    <li class="page-number"><a
                                                href="{{url('/admin/request/'.$men_to_men_request->id."?page=".($men_to_men_requests->currentPage()+3))}}">{{$men_to_men_requests->currentPage()+3}}</a>
                                    </li>
                                @endif
                                @if($men_to_men_requests->lastPage()-4 >= $men_to_men_requests->currentPage())
                                    <li class="page-number"><a
                                                href="{{url('/admin/request/'.$men_to_men_request->id."?page=".($men_to_men_requests->currentPage()+3))}}">{{$men_to_men_requests->currentPage()+4}}</a>
                                    </li>
                                @endif

                                @if($men_to_men_requests->lastPage()-1 >= $men_to_men_requests->currentPage())
                                    <li class="page-next"><a
                                                href="{{url('/admin/request/'.$men_to_men_request->id."?page=".($men_to_men_requests->currentPage()+1))}}">
                                            &gt;</a></li>
                                @endif

                                <li class="page-last  @if($men_to_men_requests->currentPage() == $men_to_men_requests->lastPage())  disabled @endif">
                                    <a href=" @if($men_to_men_requests->currentPage() ==$men_to_men_requests->lastPage())  #  @else{{url('/admin/request/'.$men_to_men_request->id."?page=".($men_to_men_requests->lastPage()))}} @endif">
                                        &gt;&gt;</a>
                                </li>
                            </ul>
                        </div>

                        <div class="pull-right">

                        </div>
                    </div>
                </div>

            </div>
            <!--===================================================-->
            <!-- END OF MAIL INBOX -->


        </div>


    </div>


    <script type="text/javascript">
        $("#reply_post_btn").click(function (e) {
            //  console.log($('#answer_form').serializeArray());
            e.preventDefault();
            var url = "/admin/request/" + {{$men_to_men_request->id}} +"/answer";
            $.ajax({
                url: url,
                type: 'POST',
                data: $('#answer_form').serializeArray(),
                headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken},
                success: function (response) {
                    location.reload();
                    console.log(response.data);
                },
                error: function (response) {
                    console.log(response['responseJSON'].answer);
                    var output = "<div class='alert alert-danger'> <ul>";
                    output += "<li>" + response['responseJSON'].answer + "</li>";
                    output += "</div></ul>";

                    $('#show_errors').html(output);
                },
            });
        });
    </script>
@endsection