@extends('layouts.app')

@section('content')
    <div id="content-container">

        <div id="page-title">
            <h1 class="page-header text-overflow">보낸 선물 내역</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">작가홈</a></li>
            <li class="active"><a href="#">보낸 선물 내역</a></li>
        </ol>


        <div id="page-content">


            <div class="panel panel-default panel-left">
                <div id="demo-email-list" class="panel-body">
                    <div class="row">
                        <div class="col-sm-7">
                            <a href="{{route('author.send_gift')}}">
                                <button type="button" class="btn btn-primary">선물보내기</button>
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
                                <th class="send">보낸 날짜</th>
                                <th class="from">보낸사람</th>
                                <th class="from">보낸 선물</th>
                                <th>상태</th>
                            </tr>
                            @if($presents->count() == 0)
                                <tr>
                                    <td class="from" colspan="4">보낸 내역이 없습니다.</td>
                                </tr>
                            @endif
                            @foreach ($presents as $present)
                               <tr>

                                    <td class="from">{{ $present->created_at }}</td>
                                    <td class="from">{{ $present->content }}</td>
                                    <td class="from">{{ $present->users->name }}</td>
                                    <td class="from">{{ $present->numbers }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="fixed-table-pagination" style="display: block;">
                        <div class="pull-left">
                            {{--<button class="btn btn-danger" id="destroy">선택삭제</button>--}}
                        </div>

                        <div class="pull-right">
                            @include('pagination', ['collection' => $presents, 'url' => route('author.sent_gifts')])
                        </div>
                    </div>
                </div>

            </div>
            <!--===================================================-->
            <!-- END OF MAIL INBOX -->


        </div>


    </div>
@endsection