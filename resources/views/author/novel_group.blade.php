@extends(Auth::user()->name == "Admin" ? 'layouts.admin_layout' : 'layouts.app')

@section('content')
    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">

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
                                    <a href="{{route('author.inning',['id'=> $novel_group->id])}}">
                                        <button class="btn btn-primary">회차추가</button>
                                    </a>
                                    {{--  <button type="button" class="btn btn-primary ">유료연재약관</button>--}}

                                </div>
                                <table class="table table-bordered" id="novel_group">
                                    <tbody>

                                    <tr v-for="(novel,index) in novels">
                                        <td class="text-center col-md-1">@{{ novel.inning }}화</td>
                                        <td class="col-md-8"><a href="#"
                                                                v-on:click="go_to_update(novel.id)">@{{ novel.title }}</a>
                                            <button v-if="novel.adult != 0" class="btn btn-xs btn-danger btn-circle">
                                                19금
                                            </button>

                                        </td>
                                        <td class="text-center col-md-1">@{{ novel.total_count }}</td>
                                        <td class="text-center col-md-3">

                                            <button type="button" id="non_free" class="btn btn-default"
                                                    v-if="novel.non_free_agreement==0 && index < novels.length-2"
                                                    v-on:click="show_nonFreeAgreement(novel.id)">유료화
                                            </button>
                                            <button type="button" id="non_free" class="btn btn-mint"
                                                    v-else-if="novel.non_free_agreement!=0 && index < novels.length-2"
                                                    >유료화
                                            </button>

                                            </button>
                                            <button class="btn btn-mint" v-if="novel.open ==1">공개
                                            </button>
                                            <button class="btn btn-default" v-if="novel.open ==0"
                                                    v-on:click="make_open(novel.id)">공개
                                            </button>

                                            <button class="btn btn-default" v-if="novel.novel_secret ==0  "
                                                    v-on:click="make_secret(novel.id,novel.non_free_agreement)">비밀
                                            </button>
                                            <button class="btn btn-info" v-if="novel.novel_secret ==1"
                                                    v-on:click="non_secret(novel.id)">비밀
                                            </button>


                                            <button class="btn btn-default" v-on:click="destroy(novel.id)">삭제</button>
                                            {{--<button v-if="novel.adult==0" class="btn btn-danger"
                                                    v-on:click="make_adult(novel.id)">19금
                                            </button>
                                            <button v-else class="btn btn-danger" v-on:click="cancel_adult(novel.id)">
                                                19금 취소
                                            </button>--}}
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


    <script>
        var app_novel = new Vue({
            el: '#novel_group',
            data: {
                novels: [],
                formErrors: {},
                makeClosed: false,
                cancelClosed: false,
                novel_group_secret: ""
            },
            computed: {
                classObjectMake: {
                    'btn-info': this.makeClosed
                }, classObjectCancel: {
                    'btn-mint': this.cancelClosed
                }
            },
            mounted: function () {
                this.reload();
            },
            methods: {

                show_nonFreeAgreement: function (id) {
                    nonFreeAgreement(id);
                },

                destroy: function (e) {
                    var destroy_confirm;

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

                                app_novel.$http.delete("{{ url('novels') }}/" + e, {headers: {'X-CSRF-TOKEN': '{!! csrf_token() !!}'}})
                                        .then(function (response) {
                                            this.reload();
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
                make_adult: function (e) {


                    bootbox.confirm({
                        message: "19금 회차로 변경 하시겠습니까?",

                        buttons: {
                            confirm: {
                                label: "변경"
                            },
                            cancel: {
                                label: '취소'
                            }
                        },

                        callback: function (result) {


                            if (result) {


                                app_novel.$http.put("{{ url('/novels/make_adult') }}/" + e, "", {headers: {'X-CSRF-TOKEN': '{!! csrf_token() !!}'}})
                                        .then(function (response) {
                                            this.reload();
                                            $.niftyNoty({
                                                type: 'warning',
                                                icon: 'fa fa-check',
                                                //message : "Hello " + name + ".<br> You've chosen <strong>" + answer + "</strong>",
                                                message: "변경 되었습니다.",
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
                cancel_adult: function (e) {


                    bootbox.confirm({
                        message: "19금 취소 하시겠습니까?",

                        buttons: {
                            confirm: {
                                label: "변경"
                            },
                            cancel: {
                                label: '취소'
                            }
                        },

                        callback: function (result) {


                            if (result) {


                                app_novel.$http.put("{{ url('/novels/cancel_adult') }}/" + e, "", {headers: {'X-CSRF-TOKEN': '{!! csrf_token() !!}'}})
                                        .then(function (response) {
                                            this.reload();
                                            $.niftyNoty({
                                                type: 'warning',
                                                icon: 'fa fa-check',
                                                //message : "Hello " + name + ".<br> You've chosen <strong>" + answer + "</strong>",
                                                message: "변경 되었습니다.",
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
                reload: function () {
                    this.$http.get('{{ route('novelgroup.novel', ['id' => $novel_group->id]) }}')
                            .then(function (response) {

                                this.novels = response.data;
                                // this.novel_group_secret = response.data[1];
                                // console.log(this.novels);
                            });
                },

                go_to_update: function (e) {
                    window.location.assign('{{ url('/author/management/update_novel/') }}' + "/" + e);
                },
                go_to_novel: function (e) {
                    window.location.assign('{{ url('/author/management/show_novel/') }}' + "/" + e);
                },
                make_open: function (e) {
                    bootbox.confirm({
                        message: "공개로 전환 하시겠습니까?",

                        buttons: {
                            confirm: {
                                label: "확인"
                            },
                            cancel: {
                                label: '취소'
                            }
                        },

                        callback: function (result) {

                            if (result) {
                                Vue.http.headers.common['X-CSRF-TOKEN'] = "{!! csrf_token() !!}";
                                app_novel.$http.put("{{ url('novels/make_open/') }}/" + e, "", {headers: {'X-CSRF-TOKEN': '{!! csrf_token() !!}'}})
                                        .then(function (response) {
                                            app_novel.reload();
                                            $.niftyNoty({
                                                type: 'warning',
                                                icon: 'fa fa-check',
                                                message: "공개 되었습니다.",
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
                cancel_open: function (e) {
                    bootbox.confirm({
                        message: "공개로 전환 하시겠습니까?",

                        buttons: {
                            confirm: {
                                label: "확인"
                            },
                            cancel: {
                                label: '취소'
                            }
                        },

                        callback: function (result) {

                            if (result) {
                                Vue.http.headers.common['X-CSRF-TOKEN'] = "{!! csrf_token() !!}";
                                app_novel.$http.put("{{ url('novels/cancel_open/') }}/" + e, "", {headers: {'X-CSRF-TOKEN': '{!! csrf_token() !!}'}})
                                        .then(function (response) {
                                            app_novel.reload();

                                            $.niftyNoty({
                                                type: 'warning',
                                                icon: 'fa fa-check',
                                                message: "비밀이 해제 되었습니다.",
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

                make_secret: function (e, non_free_agreement) {

                    if (non_free_agreement) {

                        bootbox.alert({
                            message: "유료 소설은 비밀로 변경할 수 없습니다."

                        });
                        return;
                    }


                    bootbox.confirm({
                        message: "비밀로 전환 하시겠습니까?",

                        buttons: {
                            confirm: {
                                label: "확인"
                            },
                            cancel: {
                                label: '취소'
                            }
                        },

                        callback: function (result) {

                            if (result) {
                                Vue.http.headers.common['X-CSRF-TOKEN'] = "{!! csrf_token() !!}";
                                app_novel.$http.put("{{ url('novels/secret/') }}/" + e, "", {headers: {'X-CSRF-TOKEN': '{!! csrf_token() !!}'}})
                                        .then(function (response) {
                                            app_novel.reload();
                                            $.niftyNoty({
                                                type: 'warning',
                                                icon: 'fa fa-check',
                                                message: "비밀이 되었습니다.",
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
                        message: "비밀 상태를 해제 하시겠습니까?",

                        buttons: {
                            confirm: {
                                label: "확인"
                            },
                            cancel: {
                                label: '취소'
                            }
                        },

                        callback: function (result) {

                            if (result) {
                                Vue.http.headers.common['X-CSRF-TOKEN'] = "{!! csrf_token() !!}";
                                app_novel.$http.put("{{ url('novels/non_secret/') }}/" + e, "", {headers: {'X-CSRF-TOKEN': '{!! csrf_token() !!}'}})
                                        .then(function (response) {
                                            app_novel.reload();

                                            $.niftyNoty({
                                                type: 'warning',
                                                icon: 'fa fa-check',
                                                message: "비밀이 해제 되었습니다.",
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
                }
            }

        });


    </script>

@endsection
