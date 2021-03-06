@extends('layouts.admin_layout')

@section('content')
    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">

        <div id="page-title">
            <h1 class="page-header text-overflow">작품회차목록</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">어드민</a></li>
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
                                </div>
                                <table class="table table-bordered" id="novel_group">
                                    <tbody>

                                    <tr v-for="novel in novels">
                                        <td class="text-center col-md-1">@{{ novel.inning }}회</td>
                                        <td class="col-md-8">@{{ novel.title }}
                                            <button v-if="novel.adult != 0" class="btn btn-xs btn-danger btn-circle">19금</button>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-primary">유료화</button>
                                            <button class="btn btn-info">공개</button>
                                            {{--<a href="/author/update_inning/"@{{ novel.id }}>--}}
                                            <a v-on:click="go_to_update(novel.id)">
                                                <button class="btn btn-success">수정</button>
                                            </a>
                                            <button class="btn btn-warning" v-on:click="destroy(novel.id)">삭제</button>
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
                formErrors: {}
            },
            mounted: function () {
                this.reload();
            },
            methods: {

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

                            } else {

                            }


                        }
                    });


                },
                reload: function () {
                    this.$http.get('{{ route('novelgroup.novel', ['id' => $novel_group->id]) }}')
                            .then(function (response) {
                                console.log(response);
                                this.novels = response.data;
                            });
                },

                go_to_update: function (e) {
                    window.location.assign('{{ url('/admin/novel/inning') }}'+"/" + e);
                },
            }

        });


    </script>

@endsection
