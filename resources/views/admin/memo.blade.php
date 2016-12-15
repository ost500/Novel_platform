@extends('layouts.admin_layout')

@section('content')
 <div id="content-container">

    <div id="page-title">
        <h1 class="page-header text-overflow">쪽지함</h1>
    </div>


    <ol class="breadcrumb">
        <li><a href="#">어드민</a></li>
        <li class="active"><a href="#">쪽지함</a></li>
    </ol>


    <div id="page-content">



        <div class="panel panel-default panel-left">
            <div id="demo-email-list" class="panel-body">
                <div class="row">
                    <div class="col-sm-7">
                        <a href="{{route('admin.memo_create')}}">
                            <button type="button" class="btn btn-primary">쪽지보내기</button>
                        </a>
                    </div>
                    <hr class="hr-sm visible-xs">
                    <div class="col-sm-5 clearfix">
                        <div class="pull-right">
                        </div>
                    </div>
                </div>
                <hr class="hr-sm">

                <div>
                    <table class="novel_memo">
                        <tbody>
                        <tr>
                            <th class="check"><input type="checkbox" name="checkAll" id="checkAll"></th>
                            <th class="from">보낸사람</th>
                            <th>제목</th>
                            <th class="send">보낸시간</th>
                            <th class="read">읽은시간</th>
                        </tr>
                        @foreach($novel_mail_messages as $novel_mail_message)
                        <tr>
                            <td class="check"><input type="checkbox" class="checkboxes"
                                                     value="{{ $novel_mail_message->id }}"></td>
                            <td class="from"><a href="#">@if($novel_mail_message->users) {{$novel_mail_message->users->name}} @endif</a></td>
                            <td class="text-left"><a href="{{route('admin.memo_view',['id'=> $novel_mail_message->id ])}}" >{{$novel_mail_message->subject}} </a></td>
                            <td class="send">{{$novel_mail_message->created_at}}</td>
                            <td class="read">읽은시간</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="fixed-table-pagination" style="display: block;">
                    <div class="pull-left">
                        <button class="btn btn-danger" id="destroy">선택삭제</button>
                    </div>

                    <div class="pull-right">
                        <ul class="pagination"><li class="page-first disabled"><a href="javascript:void(0)">&lt;&lt;</a></li><li class="page-pre disabled"><a href="javascript:void(0)">&lt;</a></li><li class="page-number active disabled"><a href="javascript:void(0)">1</a></li><li class="page-number"><a href="javascript:void(0)">2</a></li><li class="page-number"><a href="javascript:void(0)">3</a></li><li class="page-number"><a href="javascript:void(0)">4</a></li><li class="page-number"><a href="javascript:void(0)">5</a></li><li class="page-next"><a href="javascript:void(0)">&gt;</a></li><li class="page-last"><a href="javascript:void(0)">&gt;&gt;</a></li></ul>
                    </div>
                </div>
            </div>

        </div>
        <!--===================================================-->
        <!-- END OF MAIL INBOX -->


    </div>


 </div>

   <script>
       $("#checkAll").change(function () {
           $("input:checkbox").prop('checked', $(this).prop("checked"));
       });

       // function destroySelected() {
       $("#destroy").click(function () {

           bootbox.confirm({
               message: "삭제 하시겠습니까?",
               buttons: {
                   confirm: {
                       label: "삭제"
                   },
                   cancel: {
                       label: '취소'
                   }
               },
               callback: function (result) {
                   if (result) {

                       var checked_data = $(".checkboxes:checked").map(function() {
                           return this.value;
                       }).get();

                     /*  $.ajax({
                           type: 'POST',
                           data:{'ids':checked_data},
                           url: '{{-- route('mailbox.destroy') --}}',
                           headers: {
                               'X-CSRF-TOKEN': window.Laravel.csrfToken
                           },
                           success: function (response) {
                               location.reload();
                               /* $.niftyNoty({
                                type: 'warning',
                                icon: 'fa fa-check',
                                message: "삭제 되었습니다.",
                                container: 'page',
                                timer: 4000
                                });
                           },
                           error: function (data2) {
                               console.log(data2);
                           }
                       });*/

                   }
               }
           })
       });



   </script>

@endsection