@extends('layouts.app')

@section('content')

    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">

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

                                        <table class="table table-bordered"  v-for="group in novel_groups">
                                            <tbody >
                                            <tr>
                                                <td class="text-center col-md-2"><a
                                                            href="novel_group.blade.php">표지이미지</a>
                                                </td>
                                                <td>
                                                    <table class="table-no-border" style="width:100%;">
                                                        <tr>
                                                            <td><h4>
                                                                    <a style="cursor:pointer" v-on:click="go_to_group(group.id)">@{{ group.title }}</a>
                                                                </h4>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>등록된 회차수 : 2화, 마지막 업로드 일자 : 2016-11-10</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="padding-top-10 text-right">
                                                                <button class="btn btn-primary">댓글 1,000</button>
                                                                <button class="btn btn-info">리뷰 1,000</button>
                                                                <button class="btn btn-success" onclick="window.location.href='{{route('author.novel_group_edit',['id' => $novel_group->id])}}'">수정</button>
                                                                <button class="btn btn-mint">비밀</button>
                                                                <button class="btn btn-warning"
                                                                        v-on:click="destroy(group.id)">삭제
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>


                                </div>

                                <div id="comment_list">
                                    <div class="padding-top-10">
                                        <h4>댓글 3</h4></div>


                                    <div class="novel-review">
                                        <div class="review-write pad-all">
                                        <textarea id="demo-textarea-input" rows="4" class="form-control inline"
                                                  style="width:50%" placeholder="댓글"></textarea>
                                            <button class="btn btn-primary inline"
                                                    style="width:100px;height:83px; vertical-align:top;">등록
                                            </button>
                                        </div>

                                        <div class="review" v-for="my_comment in my_comments">

                                            <div>
                                                <span class="nick">@{{ my_comment.users.name }}</span> @{{ my_comment.created_at }}
                                                <button class="btn btn-xs btn-pink">N</button>
                                            </div>
                                            <div class="content">
                                                <span class="inning">8회</span> @{{ my_comment.comment }}
                                            </div>
                                            <div class="button">
                                                <button class="btn btn-xs btn-mint">답변</button>
                                                <button class="btn btn-xs btn-danger">신고</button>
                                            </div>

                                        </div>
                                        <div class="review reply">
                                            <div>
                                                <span class="nick">닉네임</span> 2016-11-10 00:00:00
                                                <button class="btn btn-xs btn-pink">N</button>
                                            </div>
                                            <div class="content">
                                                <span class="inning">8회</span> 둘이 당췌 먼 사연인지는 모르지만 유부녀가 바에서 꽐라될때까지 술마신거나
                                                속마음
                                                터놓지도 못하는거나 답답합니다 고구마철이라고 고구마 두시는건지
                                            </div>
                                            <div class="button">
                                                <button class="btn btn-xs btn-mint">답변</button>
                                                <button class="btn btn-xs btn-danger">신고</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>

    <script>
        var app4 = new Vue({
            el: '#novel_list',
            data: {
                novel_groups: [],
                my_comments: [],
            },
            mounted: function () {
                this.$http.get('{{ route('novels.index') }}')
                        .then(function (response) {
                            this.novel_groups = response.data;
                        });
                this.$http.get('{{ route('comments.index') }}')
                        .then(function (response) {
                            this.my_comments = response.data;
                        });
            },
            methods: {
                go_to_group: function(id){
                    window.location.assign('{{ url('author/novelgroup') }}'+"/" + id);
                },

                destroy: function (e) {
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
                                Vue.http.headers.common['X-CSRF-TOKEN'] = "{!! csrf_token() !!}";
                                //                    var csrfToken = form.querySelector('input[name="_token"]').value;

                                app4.$http.delete("{{ url('novelgroups') }}/" + e, {headers: {'X-CSRF-TOKEN': '{!! csrf_token() !!}'}})
                                        .then(function (response) {
                                            app4.reload_novel_groups();
                                            $.niftyNoty({
                                                type: 'warning',
                                                icon: 'fa fa-check',
                                                //message : "Hello " + name + ".<br> You've chosen <strong>" + answer + "</strong>",
                                                message: "삭제 되었습니다.",
                                                //container : 'floating',
                                                container: 'page',
                                                timer: 4000
                                            });

                                        })
                                        .catch(function (data, status, request) {
                                            var errors = data.data;
                                            this.formErrors = errors;
                                        });

                            }

                        }
                    });
                },
                reload_novel_groups: function(){
                    this.$http.get('{{ route('novels.index') }}')
                            .then(function (response) {
                                this.novel_groups = response.data;
                            });
                }
            }
        });
        var app5 = new Vue({
            el: '#comment_list',
            data: {
                novel_groups: [],
                my_comments: [],
            },
            mounted: function () {
                this.$http.get('{{ route('novels.index') }}')
                        .then(function (response) {
                            this.novel_groups = response.data;
                        });
                this.$http.get('{{ route('comments.index') }}')
                        .then(function (response) {
                            this.my_comments = response.data;
                        });

            }
        })
    </script>

@endsection
