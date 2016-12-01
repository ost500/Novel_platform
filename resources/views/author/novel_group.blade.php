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
                                    <a href="novel_inning_write.blade.php">
                                        <a href="{{route('author.inning',['id'=> $novel_group->id])}}">
                                            <button class="btn btn-primary">챕터추가</button>
                                        </a>
                                    </a>
                                </div>
                                <table class="table table-bordered">
                                    <tbody>
                                    @foreach($novels as $novel)
                                        <tr>
                                            <td class="text-center col-md-1">2회</td>
                                            <td class="col-md-8">{{ $novel->title }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-primary">유료화</button>
                                                <button class="btn btn-info">공개</button>
                                                <a href="novel_inning_write.blade.php">
                                                    <button class="btn btn-success">수정</button>
                                                </a>
                                                <button class="btn btn-warning">삭제</button>
                                            </td>
                                        </tr>
                                    @endforeach


                                    <tr>
                                        <td class="text-center col-md-1">1회</td>
                                        <td class="col-md-8">어쩌다보니
                                            <button class="btn btn-xs btn-danger btn-circle">19금</button>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-primary">유료화</button>
                                            <button class="btn btn-info">공개</button>
                                            <a href="novel_inning_write.blade.php">
                                                <button class="btn btn-success">수정</button>
                                            </a>
                                            <button class="btn btn-warning">삭제</button>
                                        </td>
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

@endsection
