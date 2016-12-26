@extends('layouts.app')

@section('content')
    <div id="content-container">

        <div id="page-title">
            <h1 class="page-header text-overflow">작품회차목록</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">작가홈</a></li>
            <li><a href="#">작품관리</a></li>
            <li class="active">작품회차목록</li>
        </ol>


        <div id="page-content">


            <div class="row">
                <div class="col-sm-12">

                    <div class="panel">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <div class="padding-bottom-5">
                                    <a href="#">
                                        <button class="btn btn-primary">회차추가</button>
                                    </a>
                                    {{--  <button type="button" class="btn btn-primary ">유료연재약관</button>--}}

                                </div>
                                <table class="table table-bordered" id="novel_group">
                                    <tbody>

                                    <tr>
                                        <td class="text-center col-md-1"><h4>{{ $novel->title}}</h4>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-primary">{{$today_count}} Today Views</button>
                                                <button class="btn btn-info">{{ $this_week_count}}  Week Views</button>
                                                {{--<a href="/author/update_inning/"@{{ novel.id }}>--}}
                                                <button class="btn btn-success">{{ $this_month_count }}  Month Views</button>

                                                {{-- <button class="btn btn-warning">삭제</button>--}}
                                            </div>

                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="col-md-8">{{ $novel->content}}
                                        </td>
                                     </tr>

                                    </tr>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>


    <script>
      


    </script>

@endsection
