@extends('layouts.app')
@section('content')
 <div id="content-container">

    <div id="page-title">
        <h1 class="page-header text-overflow">1:1문의내역</h1>
    </div>


    <ol class="breadcrumb">
        <li><a href="#">작가홈</a></li>
        <li class="active"><a href="#">1:1문의내역</a></li>
    </ol>


    <div id="page-content">



        <div class="panel panel-default panel-left">
            <div id="demo-email-list" class="panel-body">
                <div class="row">
                    <div class="col-sm-7">
                        <a href="novel_request.php"><button class="btn btn-primary">문의하기</button></a>
                    </div>
                    <hr class="hr-sm visible-xs">
                    <div class="col-sm-12 clearfix">
                        <div class="pull-left">

                        </div>
                    </div>
                </div>
                <hr class="hr-sm">

                <!--Mail list group-->
                <ul id="demo-mail-list" class="mail-list">

                    <!--Mail list item-->
                    @foreach($men_to_men_requests as $men_to_men_request)
                    <!--Mail list item-->
                    <li class="mail-list-unread">
                        <div class="mail-from"><button  @if($men_to_men_request->status==0) class="btn btn-xs btn-danger" @else class="btn btn-xs btn-success"  @endif >대기</button></div>

                        <div class="mail-time">{{$men_to_men_request->created_at}}</div>

                        <div class="mail-subject">
                            <a href="{{ route('author.novel_request_view',['id' => $men_to_men_request->id]) }}">{{$men_to_men_request->title}} </a>
                        </div>
                    </li>
                    @endforeach

                   
                </ul>


                <div class="fixed-table-pagination" style="display: block;">
                    <div class="pull-left">
                        <ul class="pagination"><li class="page-first disabled"><a href="javascript:void(0)">&lt;&lt;</a></li><li class="page-pre disabled"><a href="javascript:void(0)">&lt;</a></li><li class="page-number active disabled"><a href="javascript:void(0)">1</a></li><li class="page-number"><a href="javascript:void(0)">2</a></li><li class="page-number"><a href="javascript:void(0)">3</a></li><li class="page-number"><a href="javascript:void(0)">4</a></li><li class="page-number"><a href="javascript:void(0)">5</a></li><li class="page-next"><a href="javascript:void(0)">&gt;</a></li><li class="page-last"><a href="javascript:void(0)">&gt;&gt;</a></li></ul>
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
@endsection