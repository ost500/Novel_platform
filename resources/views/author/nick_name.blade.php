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
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <div class="padding-bottom-5">
                                        <button class="btn btn-primary" id="novels-user-nick-form">필명추가</button>
                                    </div>
                                    <table class="table table-bordered" id="nickname">
                                        <tbody>
                                        <tr v-for="nick in nicks" :key="nick.id">


                                            <td class="col-md-9">@{{ nick.nickname }}
                                                <button v-model="nick.main" v-if="nick.main"
                                                        class="btn btn-xs btn-danger btn-circle">메인
                                                </button>
                                            </td>

                                            <td class="text-center">

                                                <button v-model="nick.main" v-if="nick.main == false"
                                                        class="btn btn-primary" v-on:click="main(nick.id)">메인전환

                                                </button>


                                                <button class="btn btn-success novels-user-nick-form">수정
                                                </button>
                                                <button class="btn btn-warning" v-on:click="destroy(nick.id)">삭제
                                                </button>
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








        var app_nickname = new Vue({
            el: '#nickname',
            data: {
                nicks: [],
                formErrors: {}
            },
            mounted: function () {
                this.$http.get('{{ route('nickname.index') }}')
                        .then(function (response) {
                            this.nicks = response.data;
                        });

            },
            methods: {
                main: function (e) {
                    console.log(e);
                    console.log("http://novel.app/nickname.update" + e);
                    Vue.http.headers.common['X-CSRF-TOKEN'] = "{!! csrf_token() !!}";
//                    var csrfToken = form.querySelector('input[name="_token"]').value;

                    this.$http.put("{{ url("nickname") }}/" + e)
                            .then(function (response) {

                                this.reload();
                            })
                            .catch(function (data, status, request) {
                                var errors = data.data;
                                this.formErrors = errors;
                            });
                },
                destroy: function (e) {


                    Vue.http.headers.common['X-CSRF-TOKEN'] = "{!! csrf_token() !!}";
//                    var csrfToken = form.querySelector('input[name="_token"]').value;

                    this.$http.delete("{{ url("nickname") }}/" + e)
                            .then(function (response) {

                                this.reload();
                            })
                            .catch(function (data, status, request) {
                                var errors = data.data;
                                this.formErrors = errors;
                            });
                },
                reload: function () {
                    this.$http.get('{{ route('nickname.index') }}')
                            .then(function (response) {
                                this.nicks = response.data;
                            });
                },
            }

        });




    </script>
    <script>
        $('#novels-user-nick-form').on('click', function () {
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
                '<label class="form-radio form-icon demo-modal-radio active"><input type="radio" autocomplete="off" name="main" value="1" checked> 예, 메인 필명입니다.</label>' +
                '<label class="form-radio form-icon demo-modal-radio"><input type="radio" autocomplete="off" value="0"> 아니오, 메인 필명이 아닙니다. </label> </div>' +
                '</div> </div>' + '</form> </div> </div>',
                buttons: {


                    success: {
                        label: "저장",
                        className: "btn-purple",
                        callback: function () {
                            var name = $('#name').val();
                            var answer = $("input[name='main']:checked").val();
                            console.log(name);

                            var app_nick_create = new Vue({
                                data: {
                                    nickname: {'nickname': name, 'main': answer},


                                },
                                methods: {
                                    create: function () {
                                        Vue.http.headers.common['X-CSRF-TOKEN'] = "{!! csrf_token() !!}";
                                        this.$http.post("/nickname", this.nickname)
                                                .then(function (response) {
                                                    console.log(response);
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
                                                })
                                                .catch(function (data, status, request) {
                                                    var errors = data.data;
                                                    console.log(errors);
                                                });
                                    }
                                }

                            });

                            app_nick_create.create();

                        }
                    }
                }
            });

            $(".demo-modal-radio").niftyCheck();
        });
    </script>


@endsection