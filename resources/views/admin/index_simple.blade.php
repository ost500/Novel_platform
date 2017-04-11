@extends('layouts.admin_layout')

@section('content')
    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">

        <div id="page-title">
            <h1 class="page-header text-overflow">작품 코드번호 입력</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">어드민</a></li>
            <li><a href="#">정산관리</a></li>
            <li class="active">작품 코드번호 입력</li>
        </ol>


        <div id="page-content">
            <div class="row">
                <div class="col-lg-12">
                    <div id="novel_list">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="table-responsive" style="min-height:500px">
                                    <div id="manage_apply">
                                        <div class="fixed-table-pagination" style="display: block;">


                                            <div class="pull-right">

                                                <button v-on:click="save_code_num()" type="button"
                                                        class="btn btn-primary">코드번호 저장
                                                </button>

                                            </div>
                                        </div>

                                        <table id="demo-foo-addrow"
                                               class="table table-bordered table-hover toggle-circle default footable-loaded footable"
                                               data-page-size="7">

                                            <thead>
                                            <tr>

                                                <th class="text-center">번호</th>

                                                <th class="text-center">작품 제목</th>
                                                <th class="text-center">등록된 회차수</th>
                                                <th class="text-center">마지막 업로드 일자</th>
                                                <th class="text-center">최초 등록 일자</th>
                                                <th class="text-center">코드번호</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            <tr v-for="group in novel_groups">

                                                <td class="col-md-1 text-center">@{{ group.id }}</td>
                                                <td class="col-md-2"><a style="cursor:pointer"
                                                                        v-on:click="go_to_group(group.id)">@{{ group.title }}</a></a>
                                                </td>
                                                <td class="col-md-1 text-center">@{{ group.max_inning }}</td>
                                                <td class="col-md-2 text-center">@{{ latested(group.id) }}
                                                </td>
                                                <td class="col-md-2 text-center">@{{ group.created_at }}
                                                </td>
                                                <td class="col-md-1 text-center">
                                                    <input v-model="group.code_number" id="columnX"
                                                           style="text-align: center" type="text" class="form-control"
                                                           v-bind:value="group.code_number">
                                                </td>


                                            </tr>


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
                                        <ul class="pagination">

                                            <li v-if="page.page_first" class="page-first"><a v-on:click="pagination(1)"
                                                                                             href="#">&lt;&lt;</a></li>
                                            <li v-else class="page-first disabled"><a v-on:click="pagination(1)"
                                                                                      href="#">&lt;&lt;</a></li>

                                            <li v-if="page.page_pre" class="page-pre"><a
                                                        v-on:click="pagination(page.current_page - 1)" href="#">&lt;</a>
                                            </li>
                                            <li v-else class="page-pre disabled"><a
                                                        v-on:click="pagination(page.current_page - 1)" href="#">&lt;</a>
                                            </li>


                                            <li v-if="page.current_page >= 5" class="page-number">
                                                <a v-on:click="pagination(page.current_page - 4)"
                                                   href="#">@{{ page.current_page - 4 }}</a></li>
                                            <li v-if="page.current_page >= 4" class="page-number">
                                                <a v-on:click="pagination(page.current_page - 3)"
                                                   href="#">@{{ page.current_page - 3 }}</a></li>
                                            <li v-if="page.current_page >= 3" class="page-number">
                                                <a v-on:click="pagination(page.current_page - 2)"
                                                   href="#">@{{ page.current_page - 2 }}</a></li>
                                            <li v-if="page.current_page >= 2" class="page-number">
                                                <a v-on:click="pagination(page.current_page - 1)"
                                                   href="#">@{{ page.current_page - 1 }}</a></li>

                                            <li class="page-number active"><a>@{{ page.current_page }}</a></li>

                                            <li v-if="(page.last_page-1) >= page.current_page" class="page-number">
                                                <a v-on:click="pagination(page.current_page + 1)"
                                                   href="#">@{{ page.current_page + 1 }}</a></li>
                                            <li v-if="(page.last_page-2) >= page.current_page" class="page-number">
                                                <a v-on:click="pagination(page.current_page + 2)"
                                                   href="#">@{{ page.current_page + 2 }}</a></li>
                                            <li v-if="(page.last_page-3) >= page.current_page" class="page-number">
                                                <a v-on:click="pagination(page.current_page + 3)"
                                                   href="#">@{{ page.current_page + 3 }}</a></li>
                                            <li v-if="(page.last_page-4) >= page.current_page" class="page-number">
                                                <a v-on:click="pagination(page.current_page + 4)"
                                                   href="#">@{{ page.current_page + 4 }}</a></li>


                                            <li v-if="page.page_next" class="page-next"><a
                                                        v-on:click="pagination(page.current_page + 1)" href="#">&gt;</a>
                                            </li>
                                            <li v-else class="page-next disabled"><a
                                                        v-on:click="pagination(page.current_page + 1)" href="#">&gt;</a>
                                            </li>
                                            <li v-if="page.page_last" class="page-last"><a
                                                        v-on:click="pagination(page.last_page)" href="#">&gt;&gt;</a>
                                            </li>
                                            <li v-else class="page-last disabled"><a
                                                        v-on:click="pagination(page.last_page)" href="#">&gt;&gt;</a>
                                            </li>
                                        </ul>
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
        var app4_index = new Vue({
            el: '#novel_list',
            data: {
                novel_groups: [],
                commentsCountData: [],
                reviewsCountData: [],
                latested_at: [],
                my_comments: [],
                comment_show: {'id': 0, 'TF': false},
                review_show: {'id': 0, 'TF': false},
                show_count: '',
                author: [],
                page: {
                    'page_first': false,
                    'page_pre': false,
                    'page_next': false,
                    'page_last': false,
                    'current_page': 0,
                    'from': 0,
                    'last_page': 0
                },
                order: "정렬",
                code_number: [],


            },
            mounted: function () {

                this.reload();


                /* this.$http.get('
                {{-- route('comments.index') --}}')
                 .then(function (response) {
                 this.my_comments = response.data;
                 }); */
            },

            watch: {
                order: function (val) {

                    this.pagination(this.page.current_page);
                }
            },

            methods: {

                save_code_num: function () {

                    this.code_number = [];
                    console.log(this.novel_groups);
                    this.novel_groups.forEach(function (group) {
                        app4_index.code_number.push({"id": group.id, "code_number": group.code_number});
                    });
                    console.log(app4_index.code_number);

                    app4_index.$http.put("{{ route('novelgroup.code_num_save') }}", this.code_number, {headers: {'X-CSRF-TOKEN': '{!! csrf_token() !!}'}})
                            .then(function (response) {

                                $.niftyNoty({
                                    type: 'warning',
                                    icon: 'fa fa-check',
                                    //message : "Hello " + name + ".<br> You've chosen <strong>" + answer + "</strong>",
                                    message: "코드번호를 저장했습니다",
                                    //container : 'floating',
                                    container: 'page',
                                    timer: 4000
                                });

                                console.log(response);
                            })
                            .catch(function (data, status, request) {
                                var errors = data.data;
                                this.formErrors = errors;
                            });

                },

                pagination: function (page) {
                    this.$http.get('{{ route('novelgroups.index') }}?page=' + page + '&order=' + this.order)
                            .then(function (response) {
                                console.log(response.data.novel_groups.data);
                                this.novel_groups = [];
                                this.novel_groups = response.data.novel_groups.data;
                                console.log(this.novel_groups);
                                this.commentsCountData = response.data['count_data'];
                                this.reviewsCountData = response.data['review_count_data'];
                                this.latested_at = response.data['latested_at'];

//                                console.log(this.author.author_agreement);
                                this.author = response.data['author'];
                                if (this.author.author_agreement == 0) {
                                    //  $('.author_agreement_dialog').show();
                                    agreement();
                                }
                                // this.check_agreemet();


                                //about page
                                if (response.data.novel_groups.current_page > 1) {
                                    this.page.page_first = true;


                                }
                                if (response.data.novel_groups.current_page >= 2) {
                                    this.page.page_pre = true;

                                }
                                if (response.data.novel_groups.last_page - 1 >= response.data.novel_groups.current_page) {
                                    this.page.page_next = true;

                                }
                                if (response.data.novel_groups.last_page != response.data.novel_groups.current_page) {
                                    this.page.page_last = true;

                                }
                                //store current page value
                                this.page.current_page = response.data.novel_groups.current_page;
                                this.page.from = response.data.novel_groups.from;
                                this.page.last_page = response.data.novel_groups.last_page;


                            });

                },

                comment_show_func: function (id) {
                    if (comment_show.id == id) {
                        return true;
                    }
                    else {
                        return false;
                    }
                },
                check: function (id) {
                    for (var key in this.commentsCountData) {
                        if (id == key) {
                            return this.commentsCountData[id];
                        }
                    }

                },
                check_review: function (id) {
                    for (var key in this.reviewsCountData) {
                        if (id == key) {

                            return this.reviewsCountData[id];
                        }
                    }

                },
                latested: function (id) {
                    for (var key in this.reviewsCountData) {
                        if (id == key) {

                            return this.latested_at[id];
                        }
                    }

                },

                go_to_group: function (id) {
                    window.location.assign('{{ url('/author/management/novelgroups') }}' + "/" + id);
                },
                go_to_edit: function (id) {
                    window.location.assign('/author/management/novelgroups/' + id + '/edit');
                },

                commentsDisplay: function (id) {


                    var comments_url = '/comments/' + id;
                    if (this.comment_show.TF == true && this.comment_show.id == id) {
                        this.comment_show.TF = false;
                        this.comment_show.id = 0;
                    }
                    else {

                        if (this.commentsCountData[id] != 0) {
                            this.$http.get(comments_url)
                                    .then(function (response) {
                                        // document.getElementById('response').setAttribute('id','response'+id)

                                        $('#response' + id).html(response.data);
                                    });
                            this.review_show.TF = false;
                            this.review_show.id = 0;

                            this.comment_show.TF = true;
                            this.comment_show.id = id;
                        } else {
                            commonAlertBox("comment");
                        }
                    }

                },
                commentsDisplay_after_commenting: function (id) {


                    var comments_url = '/comments/' + id;


                    if (this.commentsCountData[id] != 0) {
                        this.$http.get(comments_url)
                                .then(function (response) {
                                    // document.getElementById('response').setAttribute('id','response'+id)

                                    $('#response' + id).html(response.data);
                                });
                        this.review_show.TF = false;
                        this.review_show.id = 0;

                        this.comment_show.TF = true;
                        this.comment_show.id = id;
                    } else {
                        commonAlertBox("comment");
                    }


                },
                commentId: function (id) {
                    return "response" + id;
                },
                reviewsDisplay: function (id) {

                    var comments_url = '/reviews/' + id;
                    if (this.review_show.TF == true && this.review_show.id == id) {
                        this.review_show.TF = false;
                        this.review_show.id = 0;
                    }
                    else {

                        if (this.reviewsCountData[id] != 0) {
                            this.$http.get(comments_url)
                                    .then(function (response) {
                                        // document.getElementById('response').setAttribute('id','response'+id)
                                        document.getElementById('review_response' + id).innerHTML = response.data;
                                    });
                            this.review_show.TF = true;
                            this.review_show.id = id;

                            this.comment_show.TF = false;
                            this.comment_show.id = 0;
                        } else {
                            commonAlertBox("review");
                        }
                    }

                },
                reviewsDisplay_after_deleting: function (id) {

                    var comments_url = '/reviews/' + id;
                    /*  if (this.review_show.TF == true && this.review_show.id == id) {
                     this.review_show.TF = false;
                     this.review_show.id = 0;
                     }
                     else {*/

                    if (this.reviewsCountData[id] != 0) {
                        this.$http.get(comments_url)
                                .then(function (response) {
                                    // document.getElementById('response').setAttribute('id','response'+id)
                                    document.getElementById('review_response' + id).innerHTML = response.data;
                                });
                        this.review_show.TF = true;
                        this.review_show.id = id;

                        this.comment_show.TF = false;
                        this.comment_show.id = 0;
                    } else {
                        commonAlertBox("review");
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

                                app4_index.$http.delete("{{ url('novelgroups') }}/" + e, {headers: {'X-CSRF-TOKEN': '{!! csrf_token() !!}'}})
                                        .then(function (response) {
                                            app4_index.reload();
                                            $.niftyNoty({
                                                type: 'warning',
                                                icon: 'fa fa-check',
                                                //message : "Hello " + name + ".<br> You've chosen <strong>" + answer + "</strong>",
                                                message: response.data.message,
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
                secret: function (e) {
                    bootbox.confirm({
                        message: "비밀로 하시겠습니까?",

                        buttons: {
                            confirm: {
                                label: "비밀"
                            },
                            cancel: {
                                label: '취소'
                            }
                        },

                        callback: function (result) {

                            if (result) {
                                Vue.http.headers.common['X-CSRF-TOKEN'] = "{!! csrf_token() !!}";
                                //                    var csrfToken = form.querySelector('input[name="_token"]').value;

                                app4_index.$http.put("{{ url('novelgroup/secret/') }}/" + e, "", {headers: {'X-CSRF-TOKEN': '{!! csrf_token() !!}'}})
                                        .then(function (response) {
                                            app4_index.reload();
                                            $.niftyNoty({
                                                type: 'warning',
                                                icon: 'fa fa-check',
                                                //message : "Hello " + name + ".<br> You've chosen <strong>" + answer + "</strong>",
                                                message: "비밀이 되었습니다.",
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
                non_secret: function (e) {
                    bootbox.confirm({
                        message: "비밀을 해제 하시겠습니까?",

                        buttons: {
                            confirm: {
                                label: "비밀 해제"
                            },
                            cancel: {
                                label: '취소'
                            }
                        },

                        callback: function (result) {

                            if (result) {
                                Vue.http.headers.common['X-CSRF-TOKEN'] = "{!! csrf_token() !!}";
                                //                    var csrfToken = form.querySelector('input[name="_token"]').value;

                                app4_index.$http.put("{{ url('novelgroup/non_secret/') }}/" + e, "", {headers: {'X-CSRF-TOKEN': '{!! csrf_token() !!}'}})
                                        .then(function (response) {
                                            app4_index.reload();
                                            $.niftyNoty({
                                                type: 'warning',
                                                icon: 'fa fa-check',
                                                //message : "Hello " + name + ".<br> You've chosen <strong>" + answer + "</strong>",
                                                message: "비밀이 해제 되었습니다.",
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
                clone_for_publish: function (e) {
                    bootbox.confirm({
                        message: "15세 개정판을 만드시겠습니까?",

                        buttons: {
                            confirm: {
                                label: "생성"
                            },
                            cancel: {
                                label: '취소'
                            }
                        },

                        callback: function (result) {

                            if (result) {
                                Vue.http.headers.common['X-CSRF-TOKEN'] = "{!! csrf_token() !!}";
                                //                    var csrfToken = form.querySelector('input[name="_token"]').value;

                                app4_index.$http.post("{{ url('novelgroup/clone_for_publish/') }}/" + e, "", {headers: {'X-CSRF-TOKEN': '{!! csrf_token() !!}'}})
                                        .then(function (response) {

                                            app4_index.reload();
                                            $.niftyNoty({
                                                type: 'warning',
                                                icon: 'fa fa-check',
                                                //message : "Hello " + name + ".<br> You've chosen <strong>" + answer + "</strong>",
                                                message: "[15세 개정판]이 복제 되었습니다.",
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
                    this.$http.get('{{ route('novelgroups.index') }}')
                            .then(function (response) {
                                this.novel_groups = response.data;
                            });
                },
                reload: function () {
                    this.$http.get('{{ route('novelgroups.index') }}')
                            .then(function (response) {
                                console.log(response.data.novel_groups.data);
                                this.novel_groups = response.data.novel_groups.data;
                                this.commentsCountData = response.data['count_data'];
                                this.reviewsCountData = response.data['review_count_data'];
                                this.latested_at = response.data['latested_at'];

//
                                this.author = response.data['author'];
                                if (this.author.author_agreement == 0) {
                                    //  $('.author_agreement_dialog').show();
                                    agreement();
                                }
                                // this.check_agreemet();

                                //about page
                                if (response.data.novel_groups.current_page > 1) {
                                    this.page.page_first = true;


                                }
                                if (response.data.novel_groups.current_page >= 2) {
                                    this.page.page_pre = true;

                                }
                                if (response.data.novel_groups.last_page - 1 >= response.data.novel_groups.current_page) {
                                    this.page.page_next = true;

                                }
                                if (response.data.novel_groups.last_page != response.data.novel_groups.current_page) {
                                    this.page.page_last = true;

                                }
                                //store current page value
                                this.page.current_page = response.data.novel_groups.current_page;
                                this.page.from = response.data.novel_groups.from;
                                this.page.last_page = response.data.novel_groups.last_page;

                                $("#page-title").click(function () {

                                });

                            });

                },

                reviewDestroy: function (id, group_id) {

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
                                $.ajax({
                                    type: 'DELETE',
                                    url: '/reviews/' + id,
                                    headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken},
                                    success: function (response) {
                                        app4_index.reviewsDisplay_after_deleting(group_id);

                                    }, error: function (data2) {

                                    }
                                })
                            }
                        }
                    });

                }


            }
        });


    </script>


@endsection
