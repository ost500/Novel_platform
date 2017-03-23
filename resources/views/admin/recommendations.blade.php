@extends('layouts.admin_layout')

@section('content')
    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">

        <div id="page-title">
            <h1 class="page-header text-overflow">작품 코드번호 입력</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">관리자홈</a></li>
            <li><a href="#">정산관리</a></li>
            <li class="active">작품 코드번호 입력</li>
        </ol>


        <div id="page-content">
            <div class="row">
                <div class="col-lg-12">
                    <div id="novel_list">
                        <div class="panel">
                            <div class="panel-body">
                                <section class="noon" style="text-align: center;">
                                    <div class="wrap">
                                        <ul style="list-style-type: none;display: flex">
                                            @foreach($recommends as $recommend)
                                                <li style="width:19%">
                                                    <a href="{{route('each_novel.novel_group',['id'=>$recommend->id])}}">
                                                        <p class="thumb"><img
                                                                    src="/img/novel_covers/{{$recommend->cover_photo}}"
                                                                    alt=""></p>

                                                        <p class="book-title">{{str_limit($recommend->title, 15)}}</p>

                                                        <p class="author">{{str_limit($recommend->nicknames->nickname,15)}}</p>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </section>
                                <div class="table-responsive" style="min-height:500px">
                                    <div id="manage_apply">
                                        <div class="fixed-table-pagination" style="display: block;">


                                            <div class="pull-right">

                                                <button v-on:click="save_recommend_order()" type="button"
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

                                            <tr v-for="(group,index) in novel_groups"  class="hover">

                                                <td class="col-md-1 text-center">@{{ group.id }}</td>
                                                <td class="col-md-2"><a style="cursor:pointer"
                                                                        v-on:click="go_to_group(group.id)">@{{ group.title }}</a></a>
                                                    <span v-if="group.secret != null"><i class="fa fa-user-secret"></i></span>
                                                </td>
                                                <td class="col-md-1 text-center">@{{ group.max_inning }}</td>
                                                <td class="col-md-2 text-center">@{{ latested(group.id) }}
                                                </td>
                                                <td class="col-md-2 text-center">@{{ group.created_at }}
                                                </td>
                                                <td class="col-md-1 text-center">
                                                    <input v-model="group.recommend_order" id="columnX"
                                                           style="text-align: center" type="text" class="form-control"{{-- :disabled="group.recommend_order == null ? true : false"--}}
                                                           v-bind:value="group.recommend_order" {{--v-on:keyup="make_writable()"--}} >
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
                recommend_order: []


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
              /*  make_writable:function(){

                   if(!$('#columnX').hasOwnProperty('disabled')) $('#columnX').prop('disabled', true);
                },*/

                save_recommend_order: function () {

                    this.recommend_order = [];
                    this.novel_groups.forEach(function (group) {
                        //in case of null set order to higher i.e > 5
                      //  if(group.recommend_order == null) group.recommend_order=999;
                        app4_index.recommend_order.push({"id": group.id, "recommend_order": group.recommend_order});
                    });
                    console.log(app4_index.recommend_order);

                    app4_index.$http.put("{{ route('novelgroup.recommendation_order') }}", this.recommend_order, {headers: {'X-CSRF-TOKEN': '{!! csrf_token() !!}'}})
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
                                location.reload();

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

                }


            }
        });


    </script>


@endsection
