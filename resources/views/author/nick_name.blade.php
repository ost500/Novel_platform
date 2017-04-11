@extends('layouts.app')

@section('content')
    <div class="boxed" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div id="content-container">

            <div id="page-title">
                <h1 class="page-header text-overflow">필명관리</h1>
            </div>


            <ol class="breadcrumb">
                <li><a href="#">작가홈</a></li>
                <li><a href="#">내정보</a></li>
                <li class="active">필명관리</li>
            </ol>


            <div id="page-content">


                <div class="row">
                    <div class="col-sm-12">

                        <div class="panel">

                            <div id="error_warning"></div>


                            <div class="panel-body">
                                <div class="table-responsive">
                                  {{--  <div class="padding-bottom-5">
                                        <button class="btn btn-primary" id="novels-user-nick-form">필명추가</button>
                                    </div>--}}
                                    <table class="table table-bordered" id="nickname">
                                        <tbody>
                                        <tr v-for="nick in nicks" :key="nick.id">


                                            <td class="col-md-9">@{{ nick.nickname }}
                                                <button v-if="nick.main"
                                                        class="btn btn-xs btn-danger btn-circle">메인
                                                </button>
                                            </td>

                                            <td class="text-center">

                                              {{--  <button v-if="nick.main == false"
                                                        class="btn btn-primary" v-on:click="main(nick.id)">메인전환

                                                </button>--}}


                                                <button class="btn btn-success novels-user-nick-form"
                                                        v-on:click="update(nick.id, nick.nickname)">수정
                                                </button>
                                               {{-- <button class="btn btn-warning" v-on:click="destroy(nick.id)">삭제
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


    </div>



    <script>
        //
        var app_nickname = new Vue({
            el: '#nickname',
            data: {
                nicks: [],
                formErrors: {}
            },
            mounted: function () {
                this.reload();

            },
            methods: {
                main: function (e) {
                    Vue.http.headers.common['X-CSRF-TOKEN'] = "{!! csrf_token() !!}";
//                    var csrfToken = form.querySelector('input[name="_token"]').value;

                    this.$http.put("{{ url("nickname") }}/" + e, e, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {

                                this.reload();
                            })
                            .catch(function (data, status, request) {
                                var errors = data.data;
                                this.formErrors = errors;
                            });
                },
                update: function (id, nickname) {


                    bootbox.dialog({
                        title: "필명관리",
                        message: '<div class="row"> ' + '<div class="col-md-12"> ' +
                        '<form class="form-horizontal"> ' + '<div class="form-group"> ' +
                        '<label class="col-md-4 control-label" for="name">필명</label> ' +
                        '<div class="col-md-4"> ' +
                        '<input value="' + nickname + '" id="name" name="nickname" type="text" placeholder="필명을 입력해주세요." class="form-control input-md"> ' +
                       '<span class="error" id="error_warn">'+ '</span>'+
                        '</div> ' +
                        '</div> ' + '</form> </div> </div>',
                        buttons: {

                            success: {
                                label: "저장",
                                className: "btn-purple",

                                callback: function () {
                                    var name = $('#name').val();

                                   // console.log(name);

                                    Vue.http.headers.common['X-CSRF-TOKEN'] = "{!! csrf_token() !!}";
                                    app_nickname.$http.put("/nickname/" + id, {'nickname': name}, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                                            .then(function (response) {
                                               // console.log(response);
                                                if(response.data.error==1){
                                                    // $("#error_warn").html(response.data.message);
                                                    $.niftyNoty({
                                                        type: 'warning',
                                                        icon: 'fa fa-exclamation-triangle',
                                                        message: response.data.message,
                                                        container: 'page',
                                                        timer: 5000
                                                    });
                                                }else {
                                                    app_nickname.reload();
                                                    $.niftyNoty({
                                                        type: 'purple',
                                                        icon: 'fa fa-check',
                                                        //message : "Hello " + name + ".<br> You've chosen <strong>" + answer + "</strong>",
                                                        message: "필명 " + name + "이 저장 되었습니다.",
                                                        //container : 'floating',
                                                        container: 'page',
                                                        timer: 4000
                                                    });


                                                }
                                            })
                                            .catch(function (data, status, request) {
                                                var errors = data.data;
                                                console.log(errors);

                                                error_show = '<div class="alert alert-danger"><ul><li> ' +
                                                        errors.nickname[0]
                                                        +'</li></ul></div>';

                                                $("#error_warning").html(error_show);

                                            });


                                }
                            }
                        }
                    });

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

                            Vue.http.headers.common['X-CSRF-TOKEN'] = "{!! csrf_token() !!}";
//                    var csrfToken = form.querySelector('input[name="_token"]').value;

                            app_nickname.$http.delete("{{ url("nickname") }}/" + e, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
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
                    })
                },
                reload: function () {
                  //  console.log('reloaded');
                    this.$http.get('{{ route('nickname.index') }}')
                            .then(function (response) {
                                this.nicks = response.data;
                            });
                }
            }

        });


    </script>



    <script>

        //필명 추가
        $('#novels-user-nick-form').on('click', function () {
            function boot() {

                bootbox.dialog({
                    title: "필명관리",
                    message: '<div class="row"> ' + '<div class="col-md-12"> ' +
                    '<form class="form-horizontal"> ' + '<div class="form-group"> ' +
                    '<label class="col-md-4 control-label" for="name">필명</label> ' +
                    '<div class="col-md-4"> ' +
                    '<input id="name" name="nickname" type="text" placeholder="필명을 입력해주세요." class="form-control input-md"> ' +
                    '</div> ' +
                    '</div> ' + '<div class="form-group"> ' +
                    '<label class="col-md-4 control-label" for="awesomeness">메인필명</label> ' +
                    '<div class="col-md-8"> <div class="form-block"> ' +
                    '<label class="form-radio form-icon demo-modal-radio active"><input type="radio" name="main" value="1" checked> 예, 메인 필명입니다.</label>' +
                    '<label class="form-radio form-icon demo-modal-radio"><input type="radio" name="main"  value="0"> 아니오, 메인 필명이 아닙니다. </label> </div>' +
                    '</div> </div>' + '</form> </div> </div>',
                    buttons: {


                        success: {
                            label: "저장",
                            className: "btn-purple",
                            callback: function (event) {
                                var name = $('#name').val();
                                var answer = $("input[name='main']:checked").val();
                             //   console.log(name);

                                var app_nick_create = new Vue({
                                    data: {
                                        nickname: {'nickname': name, 'main': answer},
                                        validation: {}
                                    },
                                    methods: {
                                        create: function (event) {
                                            Vue.http.headers.common['X-CSRF-TOKEN'] = "{!! csrf_token() !!}";

                                            this.$http.post("/nickname", this.nickname)
                                                    .then(function (response) {
                                                    //    console.log(response.data.error);
                                                       // app_nickname.reload();
                                                        if(response.data.error==1){
                                                           // $("#error_warning").html(response.data.message);
                                                            $.niftyNoty({
                                                                type: 'warning',
                                                                icon: 'fa fa-exclamation-triangle',
                                                                message: response.data.message,
                                                                container: 'page',
                                                                timer: 5000
                                                            });
                                                        }else {
                                                            app_nickname.reload();
                                                            $.niftyNoty({
                                                                type: 'purple',
                                                                icon: 'fa fa-check',
                                                                //message : "Hello " + name + ".<br> You've chosen <strong>" + answer + "</strong>",
                                                                message: "필명 " + name + "이 저장 되었습니다.",
                                                                //container : 'floating',
                                                                container: 'page',
                                                                timer: 4000
                                                            });
                                                        }


                                                        //if successed, validation true
                                                    })
                                                    .catch(function (data, status, request) {

                                                        var errors = data.data;
                                                    //    console.log(errors);


                                                        error_show = '<div class="alert alert-danger" data-dismiss="alert"><ul><li> ' +
                                                                errors.nickname[0]
                                                                +'</li></ul></div>';

                                                        $("#error_warning").html(error_show);

                                                    });


                                        }
                                    }

                                });


                                app_nick_create.create(event);


                            }
                        }
                    }
                });
            }

            boot();

            $(".demo-modal-radio").niftyCheck();


        });
        $(".alert").delay(4000).slideUp(200, function () {
            $(this).alert('close');
        });

    </script>


@endsection