@extends('layouts.app')

@section('content')

    <div id="content-container" >

        <div id="page-title">
            <h1 class="page-header text-overflow">작품목록</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">작가홈</a></li>
            <li><a href="#">작품관리</a></li>
            <li class="active">작품목록</li>
        </ol>


        <div id="page-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <div class="padding-bottom-5">
                                    <a href="{{ route('author.novel_group_create') }}">
                                        <button class="btn btn-primary">작품추가</button>
                                    </a>
                                </div>
                                <div id="novel_list">
                                   @foreach($novel_groups as $novel_group)
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td class="text-center col-md-2">
                                                <a style="cursor:pointer" onclick="window.location.href='{{ route('author_novel_group',['id'=>$novel_group->id]) }}'">표지이미지</a>
                                            </td>
                                            <td>
                                                <table class="table-no-border" style="width:100%;">

                                                    <tr>
                                                        <td><h4>
                                                                <a style="cursor:pointer"
                                                                   onclick="window.location.href='{{ route('author_novel_group',['id'=>$novel_group->id]) }}'">{{ $novel_group->title }}</a>
                                                            </h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>등록된 회차수 : 2화, 마지막 업로드 일자 : 2016-11-10</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="padding-top-10 text-right">
                                                            <button class="btn btn-primary"
                                                                    onclick="commentsDisplay({{$novel_group->id}})">댓글
                                                            </button>
                                                            <button class="btn btn-info"
                                                                    onclick="reviewsDisplay({{$novel_group->id}})">리뷰
                                                            </button>
                                                            <button class="btn btn-success"
                                                                    onclick="window.location.href='{{ route('author.novel_group_edit',['id'=>$novel_group->id]) }}'">수정
                                                            </button>
                                                            <button class="btn btn-mint">비밀</button>
                                                            <button class="btn btn-warning"
                                                                    onclick="destroy({{$novel_group->id}})">삭제
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </table>


                                            </td>


                                        </tr>
                                        <tr>
                                            <td colspan="2"
                                                style="border-bottom-style: hidden;border-left-style: hidden;border-right-style: hidden;">
                                                <div id="response{{$novel_group->id}}"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"
                                                style="border-bottom-style: hidden;border-left-style: hidden;border-right-style: hidden;">
                                                <div id="response{{$novel_group->id}}"></div>
                                            </td>
                                        </tr>
                                        </tbody>

                                    </table>

                                    @endforeach


                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>

    <script>

        function commentsDisplay(id){

            $.ajax({
                type: 'GET',
                url: '/comments/'+id,
                success: function (response) {
                     document.getElementById('response' + id).innerHTML = response;
                },
                error: function (data2) {
                    console.log(data2);
                }
            });
        }

        function reviewsDisplay(id){

            $.ajax({
                type: 'GET',
                url: '/reviews/'+id,
                success: function (response) {
                    document.getElementById('response' + id).innerHTML = response;
                },
                error: function (data2) {
                    console.log(data2);
                }
            });
        }

        function destroy(id){

            $.ajax({
                type: 'DELETE',
                url: '/novelgroups/'+id,
                headers: {
                    'X-CSRF-TOKEN': window.Laravel.csrfToken
                },
                success: function (response) {
                    location.reload();
                    $.niftyNoty({
                        type: 'warning',
                        icon: 'fa fa-check',
                        //message : "Hello " + name + ".<br> You've chosen <strong>" + answer + "</strong>",
                        message: "삭제 되었습니다.",
                        //container : 'floating',
                        container: 'page',
                        timer: 4000
                    });
                },
                error: function (data2) {
                    console.log(data2);
                }
            });


        }


    </script>

@endsection
