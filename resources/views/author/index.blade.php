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
                                <div>
                                    <div class="col-md-10 pad-no padding-bottom-5">
                                        <a href="{{ route('author.novel_group_create') }}">
                                            <button type="button" class="btn btn-primary">작품추가</button>
                                        </a>

                                        <button type="button" class="btn btn-primary novel-agree">연재약관</button>
                                    </div>

                                    <div class="col-md-2 text-right pad-no padding-bottom-5">
                                        <select class="form-control" name="sort">
                                            <option value="">정렬</option>
                                            <option value="1">모든글</option>
                                            <option value="2">연재글</option>
                                            <option value="3">연결글</option>
                                            <option value="4">비밀글</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="novel_list">

                                    <table class="table" v-for="group in novel_groups">
                                        <tbody>
                                        <tr class="table-bordered">
                                            <td class="text-center col-md-2"><a style="cursor:pointer"
                                                                                v-on:click="go_to_group(group.id)">

                                                    <img v-if="group.cover_photo != null"
                                                         v-bind:src="'/img/novel_covers/' + group.cover_photo">
                                                    <img v-else v-bind:src="'/img/novel_covers/default_.jpg'">

                                                </a>
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
                                                        <td>등록된 회차수 : @{{ group.max_inning }}화, 마지막 업로드 일자
                                                            : @{{ latested(group.id) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="padding-top-10 text-right">
                                                            <button class="btn btn-primary"
                                                                    v-on:click="commentsDisplay(group.id)">
                                                                댓글 @{{ check(group.id) }}
                                                            </button>
                                                            <button class="btn btn-info"
                                                                    v-on:click="reviewsDisplay(group.id)">
                                                                리뷰 @{{ check_review(group.id) }}

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
                                            <td colspan="2">
                                                <div v-bind:id="commentId(group.id)" v-show="comment_show"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
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
                commentsCountData: [],
                reviewsCountData: [],
                latested_at: [],
                my_comments: [],
                comment_show: false,
                review_show: false,
                show_count: '',

            },
            mounted: function () {

                this.reload();

                /* this.$http.get('
                {{-- route('comments.index') --}}')
                 .then(function (response) {
                 this.my_comments = response.data;
                 }); */
            },
            methods: {
                check: function (id) {
                    for (var key in this.commentsCountData) {
                        if (id == key) {
                            console.log(id);
                            return this.commentsCountData[id];
                        }
                    }

                },
                check_review: function (id) {
                    console.log(this.reviewsCountData.length);
                    /* for(var i=0;i< this.commentsCountData.length;i++ ){
                     if(id == this.commentsCountData.index){
                     console.log(this.commentsCountData[id]);
                     return this.commentsCountData[id];
                     }
                     }*/
                    for (var key in this.reviewsCountData) {
                        if (id == key) {
                            console.log(id);
                            return this.reviewsCountData[id];
                        }
                    }

                },
                latested: function (id) {
                    console.log(this.reviewsCountData.length);
                    /* for(var i=0;i< this.commentsCountData.length;i++ ){
                     if(id == this.commentsCountData.index){
                     console.log(this.commentsCountData[id]);
                     return this.commentsCountData[id];
                     }
                     }*/
                    for (var key in this.reviewsCountData) {
                        if (id == key) {
                            console.log(id);
                            return this.latested_at[id];
                        }
                    }

                },
                /* get_comment_count: function(id){
                 var c_count =

                 },*/

                go_to_group: function (id) {
                    window.location.assign('{{ url('author/novelgroup') }}' + "/" + id);
                },
                go_to_edit: function (id) {
                    window.location.assign('/author/' + id + '/edit');
                },

                commentsDisplay: function (id) {

                    var comments_url = '/comments/' + id;
                    if (this.comment_show == true) {
                        this.comment_show = false;
                    }
                    else {
                        this.$http.get(comments_url)
                                .then(function (response) {
                                    // document.getElementById('response').setAttribute('id','response'+id)
                                    this.review_show = false;
                                    this.comment_show = true;
                                    $('#response' + id).html(response.data);
                                    myfunc();
                                });
                    }

                },
                commentId: function (id) {
                    return "response" + id;
                },
                reviewsDisplay: function (id) {

                    var comments_url = '/reviews/' + id;
                    if (this.review_show == true) {
                        this.review_show = false;
                    }
                    else{
                        this.$http.get(comments_url)
                                .then(function (response) {
                                    // document.getElementById('response').setAttribute('id','response'+id)
                                    this.comment_show = false;
                                    this.review_show = true;
                                    document.getElementById('review_response' + id).innerHTML = response.data;
                                });
                    }

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
                },
                reload: function () {
                    this.$http.get('{{ route('novels.index') }}')
                            .then(function (response) {
                                this.novel_groups = response.data['novel_groups'];
                                this.commentsCountData = response.data['count_data'];
                                this.reviewsCountData = response.data['review_count_data'];
                                this.latested_at = response.data['latested_at'];
                                console.log(this.novel_groups);
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
