@extends('layouts.app')
@section('content')

    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml">

        <div id="page-title">
            <h1 class="page-header text-overflow">1:1문의</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">작가홈</a></li>
            <li><a href="#">1:1문의</a></li>
            <li class="active"><a href="#">1:1문의</a></li>
        </ol>


        <div id="page-content">

            <div id="create_request" class="panel panel-default panel-left">
                <div class="alert alert-danger" v-if="formErrors">
                    <ul>
                        <li v-if="errors['title']">@{{ errors.title.toString() }}</li>
                        <li v-if="errors['question']">@{{ errors.question.toString() }}</li>
                    </ul>
                </div>
                <div class="panel-body">

                    <form role="form" class="form-horizontal" action="{{ route('mentomen.store')}}" method="post"
                          v-on:submit.prevent="onSubmit">
                        <meta id="token" name="token" content="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="col-lg-1 control-label text-left" for="inputSubject">제목</label>

                            <div class="col-lg-11">
                                <input type="text" name="title" id="inputSubject" class="form-control"
                                       placeholder="제목" v-model="new_men_to_menRequest.title">

                                {{-- <span v-if="formErrors['title']" class="error text-danger"> @{{ formErrors['title'] }}</span>--}}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-1 control-label text-left" for="inputSubject">내용</label>

                            <div class="col-lg-11">
                                    <textarea name="question" id="demo-textarea-input" rows="15" class="form-control"
                                              placeholder="문의내용" v-model="new_men_to_menRequest.question"></textarea>
                                {{--<span v-if="formErrors['question']" class="error text-danger">@{{ formErrors['question'] }}</span>--}}
                            </div>
                        </div>

                        <div id="demo-mail-compose"></div>

                        <div class="text-center">
                            <button id="mail-send-btn" class="btn btn-primary btn-labeled">
                                <span class="btn-label"><i class="fa fa-paper-plane"></i></span> 문의하기
                            </button>


                            <a href="{{route('author.novel_request_list')}}">
                                <button type="button" class="btn btn-danger">취소</button>
                            </a>


                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>


    <script>
        //

        var app = new Vue({
            el: '#create_request',
            data: {

                new_men_to_menRequest: {'title': '', 'question': ''},
                errors: {},
                formErrors:false
            },
            methods: {
                onSubmit: function (e) {
                    e.preventDefault();
                    var action ='{{ route('mentomen.store')}}';
                    //  Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');
                    var $redirect_url = '/author/men_to_men/requests';
                    this.$http.post(action, this.new_men_to_menRequest, {
                        headers: {
                            'X-CSRF-TOKEN': window.Laravel.csrfToken
                        }
                    }).then(function (response) {

                        window.location.href = $redirect_url + '/' + response.data['id'];

                    }).catch(function (errors) {

                        this.errors = errors.data;
                        this.formErrors=true;
                         console.log(this.errors);
                    });
                }
            }
        });


    </script>


@endsection