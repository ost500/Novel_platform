@extends('layouts.admin_layout')

@section('content')

    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">

        <div id="page-title">
            <h1 class="page-header text-overflow">회원관리</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">어드민</a></li>
            <li><a href="#">회원관리</a></li>
        </ol>


        <div id="page-content">


            <div class="row">
                <div class="col-lg-12">

                    <div class="panel">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <div class="padding-bottom-5">
                                </div>
                                <div id="user_list">

                                    <table class="table table-bordered" v-for="user in users">
                                        <tbody>
                                        <tr>
                                            <td class="text-center col-md-2"><a
                                                        href="novel_group.blade.php">@{{ user.name }}</a>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
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
            el: '#user_list',
            data: {
                users: [],
            },
            mounted: function () {
                this.$http.get('{{ route('users.index') }}')
                        .then(function (response) {
                            this.users = response.data;
                        });
            },
            methods: {
                go_to_user: function (id) {
                    window.location.assign('{{ url('admin/user_info') }}' + "/" + id);
                },
                go_to_edit: function (id) {
                    window.location.assign('/author/' + id + '/edit');
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
                                            app4.reload_users();
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
                reload_users: function () {
                    this.$http.get('{{ route('novels.index') }}')
                            .then(function (response) {
                                this.users = response.data;
                            });
                }
            }
        });
        var app5 = new Vue({
            el: '#comment_list',
            data: {
                users: [],
                my_comments: [],
            },
            mounted: function () {
                this.$http.get('{{ route('users.index') }}')
                        .then(function (response) {
                            this.users = response.data;
                        });
            }
        })
    </script>

@endsection
