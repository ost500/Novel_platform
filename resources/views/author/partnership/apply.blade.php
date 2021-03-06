@extends('layouts.app')
@section('content')
    <div id="apply" xmlns:v-on="http://symfony.com/schema/routing" xmlns:v-bind="http://www.w3.org/1999/xhtml">

        <div id="content-container">

            <div id="page-title">
                <h1 class="page-header text-overflow">연재신청</h1>
            </div>


            <ol class="breadcrumb">
                <li><a href="#">작가홈</a></li>
                <li><a href="#">제휴연재신청</a></li>
                <li class="active">연재신청</li>
            </ol>


            <div id="page-content">


                <div class="panel panel-default panel-left">
                    <div class="panel-body">
                        <div hidden id="errors">
                            <div class="alert alert-danger" v-if="formErrors">
                                <ul>
                                    <li v-if="errors['days']">@{{ errors.days.toString() }}</li>
                                    <li v-if="errors['novel_group']">@{{ errors.novel_group.toString() }}</li>
                                    <li v-if="errors['novels_per_days']">@{{ errors.novels_per_days.toString() }}</li>
                                    <li v-if="errors['adult']">@{{ errors.adult.toString() }}</li>
                                    <li v-if="errors['initial_inning']">@{{ errors.initial_inning.toString() }}</li>
                                    <li v-if="errors['initial_publish']">@{{ errors.initial_publish.toString() }}</li>


                                </ul>
                            </div>
                        </div>

                        <form id="form_data" class="form-horizontal">
                            {{ csrf_field() }}

                            <div class="form-group pad-ver">
                                <label class="col-lg-1 control-label text-left" for="inputSubject">작품선택</label>

                                <div class="col-lg-11">
                                    <select v-model="clicked_novel_group" name="novel_group" class="form-control"
                                            v-on:change="novel_group_checked">

                                        <option v-for="novel_group in novel_groups"
                                                v-bind:value="novel_group.id"
                                                >@{{ novel_group.title }}</option>
                                    </select>
                                </div>
                            </div>


                            <hr>


                            <div class="form-group pad-ver">
                                <label class="col-lg-1 control-label text-left" for="inputSubject">초기연재편수</label>

                                <div class="col-lg-11">
                                    <select name="initial_publish" class="form-control">
                                        <option value="">선택</option>
                                        @for($i=1; $i<=50; $i++)
                                            <option value="{{$i}}"
                                                    @if($i == old('days')) selected @endif>{{$i}}편
                                            </option>

                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="form-group pad-ver">
                                <label class="col-lg-1 control-label text-left" for="inputSubject">일(날짜)</label>

                                <div class="col-lg-11">
                                    <select name="days" class="form-control">
                                        <option value="">선택</option>
                                        @for($i=1; $i<=10; $i++)
                                            <option value="{{$i}}"
                                                    @if($i == old('days')) selected @endif>{{$i}}일
                                            </option>

                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="form-group pad-ver">
                                <label class="col-lg-1 control-label text-left" for="inputSubject">편수</label>

                                <div class="col-lg-11">
                                    <select name="novels_per_days" class="form-control">
                                        <option value="">선택</option>
                                        @for($i=1; $i<=10; $i++)
                                            <option value="{{$i}}"
                                                    @if($i == old('novels_per_days')) selected @endif>{{$i}}편
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>


                            <hr>

                            <div class="form-group pad-ver">
                                <label class="col-lg-1 control-label text-left" for="inputSubject">제휴업체</label>

                                <div class="col-lg-11 text-center">


                                    <div class="col-sm-2" style="height:450px" v-for="company in companies">
                                        <div>
                                            <img src="/img/novel_covers/default_.jpg"
                                                 class="index_img" width="150" v-if="company.company_picture == ''">
                                            <img :src="'/img/company_pictures/'+company.company_picture"
                                                 class="index_img" width="150" v-else>
                                        </div>

                                        <div class="padding-top-10" >
                                            <label class="form-checkbox form-icon form-text">
                                                <input type="checkbox" :name="'company'+company.id"
                                                       value="true" v-on:change="company_check(company)"
                                                        > @{{ company.name }}</label>
                                        </div>
                                        <div class="padding-top-10">초기연재 @{{company.initial_inning}}편</div>
                                        <div class="padding-top-10" v-if="company.adult==1">19금 불가</div>
                                        <div class="padding-top-10"  v-if="company.adult==0" style="margin-bottom:7%"></div>
                                        <div class="padding-top-10 description_for_apply" style="word-break:break-word;" >@{{company.description}}</div>
                                    </div>


                                </div>
                            </div>
                            <div id="adult_confirm">
                                <hr>

                                <div class="form-group pad-ver" {{--v-if="adult_publish===true"--}}>
                                    <label class="col-lg-1 control-label text-left" for="inputSubject">19금 연재</label>

                                    <div class="col-lg-11">
                                        <div class="padding-top-10">
                                            청소년 이용 불가 작품입니까?

                                            <label style="margin-left:20px"
                                                   class="form-radio form-icon active form-text">
                                                <input type="radio" name="publish_adult" value="1" checked>
                                                예</label>

                                            <label class="form-radio form-icon form-text">
                                                <input id="adult_checkbox" type="radio" name="publish_adult" value="0"> 아니오</label>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                        <div id="demo-mail-compose"></div>

                        <div class="text-center">
                            <button id="mail-send-btn" v-on:click="post()"
                                    class="btn btn-primary btn-labeled">
                                <span class="btn-label"><i class="fa fa-paper-plane"></i></span> 신청하기
                            </button>
                            {{--<a href="with_company.html">--}}
                            {{--<button type="button" class="btn btn-danger">취소</button>--}}
                            {{--</a>--}}
                        </div>

                    </div>


                </div>


            </div>


        </div>

    </div>
    <script type="text/javascript">
        var apply = new Vue({
            name: "hello",
            el: '#apply',
            data: {
                formErrors: false,
                errors: {},
                novel_groups: [
                    {title: "작품선택", id: ""},
                        @foreach($my_novel_groups as $my_novel_group)
                    {
                        title: "{{$my_novel_group->title}}",
                        id: "{{$my_novel_group->id}}"
                    },
                    @endforeach
                ],
                companies: [
                        @foreach($companies as $company)
                    {
                        id: "{{ $company->id }}",
                        form_name: "company{{ $company->id }}",
                        name: "{{ $company->name }}",
                        description: '<?php echo preg_replace('/\s\s+/', ' ', $company->description); ?>',
                        initial_inning: "{{ $company->initial_inning }}",
                        adult: "{{ $company->adult }}",
                        company_picture: "{{ $company->company_picture }}"

                    },
                    @endforeach
                ],

                clicked_novel_group: "",
                adult_publish: false,


            },

            mounted: function () {

            },
            methods: {
                company_check: function (company) {
                    company.selected = !company.selected;


                    this.companies.some(function (element) {

                         if (element.selected == true && element.adult == 1) {

                            apply.adult_publish = true;

                            return (element.selected == true);
                        }
                        apply.adult_publish = false;
                    });

                },

                novel_group_checked: function () {

                 //   console.log(this.clicked_novel_group);
                    this.$http.get('{{ route('author.partner_apply.proper_company')."?novel_group="}}' + this.clicked_novel_group)
                            .then(function (response) {
                                console.log(response);
                                apply.companies = [];
                                response.data.forEach(function (element) {
                                    element.selected = false;
                                    apply.companies.push(element);

                                    console.log(element);
                                });
                                console.log(this.companies);
                            })
                },

                post: function () {
//                    if (this.adult_publish) {
//                        console.log($("#adult_checkbox").is(':checked'));
//                        if ($("#adult_checkbox").is(':checked') == false) {
//                            bootbox.alert("19금 연재 불가 업체가 선택되었습니다. <br> 추후 성인 회차를 추가하실 예정이시면, '15세 개정판'을 생성하신 후에,<br>  '15세 개정판'으로 제휴 연재 신청해주시기 바랍니다.", function () {
//
//                            });
//                            return;
//                        }
//                    }


                    bootbox.dialog({
                        message: "만약 각 제휴사의 할인 및 무료 대여 이벤트 등이 제공된다면 참여하시겠습니까?<br> (최대 할인율 50%) 이벤트는 반드시 진행되는 것은 아니며 해당 제휴사의 심사에 의해 결정 됩니다.",
                        title: "",
                        buttons: {
                            success: {
                                label: "이벤트 수락",
                                className: "btn-success",
                                callback: function () {

                                    var form = $("#form_data");
                                  // console.log(form.serialize());
                                    $.ajax({
                                        type: 'POST',
                                        url: '{{ route('publishnovelgroups.store') }}/?event=1',
                                        headers: {
                                            'X-CSRF-TOKEN': window.Laravel.csrfToken
                                        },
                                        data: form.serialize(),
                                        success: function (response) {
                                            window.location.assign('{{route('author.partner_apply_list')}}');
                                        },
                                        error: function (data2) {
                                            $("#errors").show();
                                            apply.errors = data2.responseJSON;
                                            apply.formErrors = true;
                                            $("#errors").focus();
                                        }
                                    });


                                }
                            },

                            danger: {
                                label: "이벤트 거절",
                                className: "btn-danger",
                                callback: function () {
                                    var form = $("#form_data");
                                    console.log(form);
                                    $.ajax({
                                        type: 'POST',
                                        url: '{{ route('publishnovelgroups.store') }}/?event=0',
                                        headers: {
                                            'X-CSRF-TOKEN': window.Laravel.csrfToken
                                        },
                                        data: form.serialize(),
                                        success: function (response) {


                                            window.location.assign('{{route('author.partner_apply_list')}}');
                                        },
                                        error: function (data2) {
                                            $("#errors").show();

                                            apply.errors = data2.responseJSON;
                                            console.log(apply.errors);
                                            apply.formErrors = true;
                                            $("#errors").focus();
                                        }
                                    });
                                }
                            },

                            main: {
                                label: "취소",
                                className: "btn-primary",
                                callback: function () {

                                }
                            }
                        }
                    });


                }

            }
        });


    </script>

@endsection