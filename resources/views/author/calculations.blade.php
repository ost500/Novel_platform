@extends('layouts.app')
@section('content')


    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml">

        <div id="page-title">
            <h1 class="page-header text-overflow">퍼블리싱내역</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">작가홈</a></li>
            <li><a href="#">수익내역</a></li>
            <li class="active">퍼블리싱내역</li>
        </ol>


        <div id="page-content">


            <div class="row">
                <div class="col-sm-12">

                    <div class="panel">

                        <div class="panel-body">

                            <div class="table-responsive" style="min-height:500px">

                                <div id="manage_apply">
                                    <div class="fixed-table margin-bottom-10">
                                        <form action="{{route('calculation')}}" menthod="post">
                                            <div class="form-group">
                                                <div class="col-md-2" style="margin:0 55px 10px 0;">
                                                    <select class="form-control" name="nickname_id">
                                                        <option value="">필명선택</option>
                                                        @foreach($nicknames as $nickname)
                                                            <option value="{{$nickname}}">{{$nickname->nickname}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2" style="margin:0 55px 10px 0;">
                                                    <select class="form-control" name="title">
                                                        <option value="">필명선택</option>
                                                        @foreach($allNovelGroups as $novel_group)
                                                            <option value="{{$novel_group->id}}}">{{$novel_group->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2" style="margin:0 55px 10px 0;">
                                                    <select class="form-control" name="year">
                                                        <option value="">필명선택</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2" style="margin:0 55px 10px 0;">
                                                    <select class="form-control" name="month">
                                                        @for( $i=1;$i<=12;$i++)
                                                            <option value="{{$i}}">{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="" style="margin:0 55px 10px 0;">
                                                    <button type="submit" class="btn btn-info">Search</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>

                                    <table id="demo-foo-addrow"
                                           class="table table-bordered table-hover toggle-circle default footable-loaded footable"
                                           data-page-size="7">

                                        <thead>
                                        <tr>

                                            <th class="text-center">번호</th>

                                            <th class="text-center">코드번호</th>
                                            <th class="text-center">작품명</th>
                                            <th class="text-center">퍼블리싱</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($myNovelGroups as $novelGroup)

                                            <tr>
                                                <a href="#">
                                                    <td class="col-md-1 text-center">{{ $novelGroup->id }}</td>

                                                    <td class="col-md-1 text-center">{{ $novelGroup->code_number }}</td>
                                                    <td class="col-md-2 text-center"><a
                                                                href="{{ route('author.calculations_detail', ['id' => $novelGroup->code_number]) }}">{{ $novelGroup->title }}</a>
                                                    </td>
                                                    <td class="col-md-1 text-center">{{ $novelGroup->calculation_eaches_count }}
                                                    </td>
                                                </a>
                                            </tr>

                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            {{-- <div id="response"></div>--}}

                            <div class="fixed-table-pagination" style="display: block;">
                                <div class="pull-left">
                                    {{-- <button class="btn btn-danger">선택삭제</button>--}}
                                </div>

                                <div class="pull-right">
                                    @include('pagination', ['collection' => $myNovelGroups, 'url' => route('author.benefit')])
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>

@endsection