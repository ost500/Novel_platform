@extends('layouts.app')

@section('content')
    <div class="boxed" xmlns:v-bind="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml"
         xmlns:v-el="http://www.w3.org/1999/xhtml">
        <div id="content-container">

            <div id="page-title">
                <h1 class="page-header text-overflow">작가정보관리</h1>
            </div>


            <ol class="breadcrumb">
                <li><a href="#">작가홈</a></li>
                <li><a href="#">내정보</a></li>
                <li class="active">작가정보관리</li>
            </ol>


            <div id="page-content">


                <div class="row" id="profile_edit">
                    <div class="col-sm-12">

                        <div class="panel">
                            <form class="panel-body form-horizontal form-padding" method="put" action="{{route('users.update')}}" v-el:custom @submit.prevent="submit">

                                <meta id="token" name="token" content="{{ csrf_token() }}">

                                <div class="form-group">
                                    <label class="col-md-2 control-label"></label>
                                    <div class="col-md-9">
                                        <div class="alert alert-warning media fade in">
                                            <div class="media-left">
													<span class="icon-wrap icon-wrap-xs icon-circle alert-icon">
														<i class="fa fa-bolt fa-lg"></i>
													</span>
                                            </div>
                                            <div class="media-body va-middle">
                                                <p class="alert-title ">정확한 정산을 위해 은행, 예금주, 계좌번호를 정확히 입력해주세요.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="demo-email-input">이름</label>
                                    <div class="col-md-9">
                                        <input type="text" name="name" id="demo-email-input" class="form-control"

                                               placeholder="작가 이름을 입력해 주세요." v-model="profile.name">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="demo-email-input">연락처</label>
                                    <div class="col-md-9">
                                        <input type="text" name="phone_num" id="demo-email-input" class="form-control"
                                               placeholder="연락처를 입력해 주세요." v-model="profile.phone_num">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="demo-email-input">이메일</label>
                                    <div class="col-md-9">
                                        <input type="email" name="email" id="demo-email-input" class="form-control"
                                               placeholder="이메일 주소를 입력해 주세요." v-model="profile.email">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="demo-email-input">은행</label>
                                    <div class="col-md-9">
                                        <input type="text" name="bank" id="demo-email-input" class="form-control"
                                               placeholder="은행명을 입력해 주세요." v-model="profile.bank">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="demo-email-input">예금주</label>
                                    <div class="col-md-9">
                                        <input type="text" name="account_holder" id="demo-email-input"
                                               class="form-control"
                                               placeholder="예금주를 입력해 주세요." v-model="profile.account_holder">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="demo-email-input">계좌번호</label>
                                    <div class="col-md-9">
                                        <input type="text" name="account_number" id="demo-email-input"
                                               class="form-control"
                                               placeholder="계좌번호를 입력해 주세요." v-model="profile.account_number">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" value="submit" class="btn btn-lg btn-primary">저장</button>
                                        <button class="btn btn-lg btn-danger">취소</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>

    <script>
        var app = new Vue({
            el: '#profile_edit',
            data: {
                profile: [],
                formErrors: {}
            },
            mounted: function () {
                this.$http.get('{{ route('users.index') }}')
                        .then(function (response) {
                            this.profile = response.data;
                        });

            },
            methods: {
                submit: function (e) {
                    e.preventDefault();
                    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');
                    var form = e.srcElement;
                    var action = form.action;
//                    var csrfToken = form.querySelector('input[name="_token"]').value;

                    this.$http.put(action, this.profile)
                            .then(function (response) {
                                $.niftyNoty({
                                    type: 'purple',
                                    icon : 'fa fa-check',
                                    //message : "Hello " + name + ".<br> You've chosen <strong>" + answer + "</strong>",
                                    message : "저장 되었습니다.",
                                    //container : 'floating',
                                    container : 'page',
                                    timer : 4000
                                });

                            })
                            .catch(function (data, status, request) {
                                var errors = data.data;
                                this.formErrors = errors;
                            });
                }
            }
        });




    </script>

@endsection