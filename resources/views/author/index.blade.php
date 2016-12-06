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

            @include('partials.flash')
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

                                    <table class="table table-bordered" v-for="group in novel_groups">
                                        <tbody>
                                        <tr>
                                            <td class="text-center col-md-2"><a
                                                        href="novel_group.blade.php">표지이미지</a>
                                            </td>
                                            <td>
                                                <table class="table-no-border" style="width:100%;">

                                                    <tr>
                                                        <td><h4>
                                                                <a style="cursor:pointer"
                                                                   v-on:click="go_to_group(group.id)">@{{ group.title }}</a>
                                                            </h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>등록된 회차수 : 2화, 마지막 업로드 일자 : 2016-11-10</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="padding-top-10 text-right">
                                                            <button class="btn btn-primary"
                                                                    v-on:click="commentsDisplay(group.id)"> 댓글 1,000
                                                            </button>
                                                            <button class="btn btn-info"
                                                                    v-on:click="reviewsDisplay(group.id)">리뷰 1,000
                                                            </button>
                                                            <button class="btn btn-success"
                                                                    v-on:click="go_to_edit(group.id)">수정
                                                            </button>
                                                            <button class="btn btn-mint">비밀</button>
                                                            <button class="btn btn-warning"
                                                                    v-on:click="destroy(group.id)">삭제
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </table>


                                            </td>


                                        </tr>
                                        <tr>
                                            <td colspan="2"
                                                style="border-bottom-style: hidden;border-left-style: hidden;border-right-style: hidden;">
                                                <div v-bind:id="commentId(group.id)" v-show="comment_show"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"
                                                style="border-bottom-style: hidden;border-left-style: hidden;border-right-style: hidden;">
                                                <div v-bind:id="reviewId(group.id)" v-show="review_show"></div>
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


    </div>

    <script>
        var app4 = new Vue({
            el: '#novel_list',
            data: {
                novel_groups: [],
                my_comments: [],
                comment_show: true,
                review_show: true,

            },
            mounted: function () {
                this.$http.get('{{ route('novels.index') }}')
                        .then(function (response) {
                            this.novel_groups = response.data;
                        });
                /* this.$http.get('
                {{-- route('comments.index') --}}')
                 .then(function (response) {
                 this.my_comments = response.data;
                 }); */
            },
            methods: {
                go_to_group: function (id) {
                    window.location.assign('{{ url('author/novelgroup') }}' + "/" + id);
                },
                go_to_edit: function (id) {
                    window.location.assign('/author/' + id + '/edit');
                },

                commentsDisplay: function (id) {

                    var comments_url = '/comments/' + id;

                    this.$http.get(comments_url)
                            .then(function (response) {
                                // document.getElementById('response').setAttribute('id','response'+id)
                                this.review_show = false;
                                this.comment_show = true;
                                document.getElementById('response' + id).innerHTML = response.data;
                            });
                },
                commentId: function (id) {
                    return "response" + id;
                },
                reviewsDisplay: function (id) {

                    var comments_url = '/reviews/' + id;

                    this.$http.get(comments_url)
                            .then(function (response) {
                                // document.getElementById('response').setAttribute('id','response'+id)
                                this.comment_show = false;
                                this.review_show = true;
                                document.getElementById('review_response' + id).innerHTML = response.data;
                            });
                },
                reviewId: function (id) {
                    return "review_response" + id;
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
                reload_novel_groups: function () {
                    this.$http.get('{{ route('novels.index') }}')
                            .then(function (response) {
                                this.novel_groups = response.data;
                            });
                }
            }
        });
        /*  var app5 = new Vue({
         el: '#comment_list',
         data: {
         novel_groups: [],
         my_comments: [],
         },
         mounted: function () {
         this.$http.get('{{-- route('novels.index')--}}')
         .then(function (response) {
         this.novel_groups = response.data;
         });
         this.$http.get('{{-- route('comments.index') --}}')
         .then(function (response) {
         this.my_comments = response.data;
         });

         }
         })*/
    </script>

@endsection
