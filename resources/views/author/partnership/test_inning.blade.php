@extends('layouts.app')
@section('content')


    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml"
         xmlns:v-on.enter="http://www.w3.org/1999/xhtml">

        <div id="page-title">
            <h1 class="page-header text-overflow">회차별 심사</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">작가홈</a></li>
            <li><a href="#">제휴연재신청</a></li>
            <li class="active">회차별 심사</li>
        </ol>


        <div id="page-content">


            <div class="row">
                <div class="col-sm-12">

                    <div class="panel">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <div id="manage_apply">

                                    <div class="col-md-12 pad-no padding-bottom-5">
                                        <button type="button" class="btn btn-purple"
                                                onclick="window.location.href='{{route('author.partner_test_inning') }}'">
                                            기본
                                        </button>
                                        @foreach($companies as $company)
                                            <button class="btn btn-primary"
                                                    onclick="window.location.href='{{route('author.partner_test_inning',['id'=>$company->id]) }}'">{{$company->name}}</button>

                                        @endforeach
                                        <button type="button" class="btn btn-info"
                                                onclick="window.location.href='{{route('author.partner_test_inning',['id'=>'stopped']) }}'">
                                            제휴연재중단
                                        </button>

                                        <div style="float: right;width:30%">
                                            <div class="input-group mar-btm">
                                                <input type="text" name="search"
                                                       id="search" v-model="search"
                                                       placeholder=""

                                                       v-on:keyup.enter="searchByGroupName" class="form-control">
											<span class="input-group-btn">
												<button type="submit" class="btn btn-danger btn-labeled fa fa-search"
                                                        v-on:click="searchByGroupName">검색
                                                </button>
											</span>
                                            </div>


                                        </div>
                                        {{-- <button type="button" class="btn btn-info novel-agree" style="float: right;">Total {{$apply_requests->total() }} Results Found</button>--}}
                                    </div>

                                    @if(count($apply_requests) > 0)
                                        @foreach($apply_requests as $apply_request)
                                            {{--   @if(checkPublishNovelGroup($apply_request->publish_novel_group_id,$apply_request->company_id))--}}
                                            <table class="table" id="tab{{$apply_request->id}}">
                                                <tbody>

                                                <tr class="table-bordered">
                                                    <td class="text-center col-md-2">
                                                        <a style="cursor:pointer"
                                                           v-on:click="displayNovels('{{$apply_request->publish_novel_group_id}}')">
                                                            @if($apply_request->publish_novel_groups->novel_groups->cover_photo != null)
                                                                <img class="index_img"
                                                                     src="/img/novel_covers/{{$apply_request->publish_novel_groups->novel_groups->cover_photo}}">
                                                            @else
                                                                <img class="index_img"
                                                                     src="/img/novel_covers/default_.jpg">
                                                            @endif
                                                        </a>
                                                    </td>

                                                    <td class="text-center col-md-6">
                                                        <table class="table-no-border" style="width:100%;">

                                                            <tr>
                                                                <td><h4>
                                                                        <a style="cursor:pointer"
                                                                           v-on:click="displayNovels('{{$apply_request->id }}','{{$apply_request->publish_novel_groups->novel_groups->id}}','{{$apply_request->company_id }}','{{$apply_request->publish_novel_groups->id}}')">{{$apply_request->publish_novel_groups->novel_groups->title }}</a>
                                                                    </h4>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>

                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    @if($apply_request->stop == 0)
                                                                        <button type="button"
                                                                                class="btn btn-primary "
                                                                                v-on:click="stop('{{$apply_request->id }}')">
                                                                            제휴 연재 중단
                                                                        </button>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table class="table-no-border" style="width:100%;">

                                                            <tr>
                                                                <td>
                                                                    작가명:{{$apply_request->publish_novel_groups->novel_groups->users->name}}</td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    연재요청업체명: {{$apply_request->companies->name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>상태:{{$apply_request->status}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>신청일:{{$apply_request->created_at}}</td>
                                                            </tr>
                                                            <tr>
                                                                @if($apply_request->stop == 0)
                                                                    <td> 제휴연재 : 진행중 </td>
                                                                @else
                                                                    <td> 제휴연재 : 중단</td>
                                                                @endif
                                                            </tr>
                                                        </table>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td v-if="{{$apply_request->id }} == novel_show.id && novel_show.TF"> {{$apply_request->days.' 일 마다 - '.$apply_request->novels_per_days.' 편씩 연재합니다.'  }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"
                                                        id="response{{$apply_request->id}}"
                                                        v-if="{{$apply_request->id }} == novel_show.id && novel_show.TF"></td>
                                                    <td colspan="3"
                                                        id="response{{$apply_request->id}}" v-else hidden></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"></td>
                                                </tr>

                                                </tbody>
                                            </table>
                                            {{--  @endif--}}
                                        @endforeach
                                    @else
                                        <table class="table">
                                            <tr>
                                                <td>
                                                    <div style="font-weight: 600;text-align: center;">
                                                        문의가 없습니다.
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    @endif
                                </div>

                            </div>
                            {{-- <div id="response"></div>--}}
                            <div class="fixed-table-pagination" style="display: block;">
                                <div class="pull-left">
                                    {{-- <button class="btn btn-danger">선택삭제</button>--}}
                                </div>

                                <div class="pull-right">
                                    @if(!$id)
                                        {{-- {{ $apply_requests->links()}}--}}
                                        @include('pagination', ['collection' => $apply_requests, 'url' => route('author.partner_test_inning')])
                                    @else
                                        @include('pagination', ['collection' => $apply_requests, 'url' => route('author.partner_test_inning',['id'=>$id])])

                                    @endif
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>
    <script type="text/javascript">
        var app = new Vue({
            el: '#manage_apply',
            data: {
                novel_info: {publish_novel_id: '', status: '재심사'},
                novel_show: {'id': 0, 'TF': false},
                stop_info: {'publish_company_id': ''},
                search: ''

            },
            mounted: function () {

            },
            methods: {

                /*
                 publish_company_id is id from novel_group_publish_companies table
                 publish_novel_group_id is id from publish_novel_groups table
                 company_id is from novel_group_publish_companies table
                 */

                displayNovels: function (publish_company_id, novel_group_id, company_id, publish_novel_group_id) {


                    //hide novels box if novel group name clicked again otherwise get novels
                    if (this.novel_show.TF == true && this.novel_show.id == publish_company_id) {
                        this.novel_show.TF = false;
                        this.novel_show.id = 0;
                    } else {

                        this.$http.get('{{url('publishnovelgroups')}}?novel_group_id=' + novel_group_id + '&company_id=' + company_id + '&publish_company_id=' + publish_company_id + '&publish_novel_group_id=' + publish_novel_group_id)
                                .then(function (response) {
                                    this.novel_show.id = publish_company_id;
                                    this.novel_show.TF = true;

                                    $('#response' + publish_company_id).html(response.data);


                                });
                    }
                },

                /* Update publish Novel on request again
                 novel_id is id from novels table
                 publish_novel_group_id is id from publish_novel_groups table
                 company_id is from novel_group_publish_companies table
                 publish_company_id is id from novel_group_publish_companies table

                 */
                updatePublishNovel: function (publish_novel_id, publish_novel_group_id, company_id, publish_company_id, novel_group_id) {
                    app.novel_info.publish_novel_id = publish_novel_id;
                    app.$http.post('{{ route('publish_novel.update_status') }}', app.novel_info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {
                                //show new unpublished novel list
                                this.novel_show.TF = false;
                                this.novel_show.id = 0;
                                app.displayNovels(publish_company_id, novel_group_id, company_id, publish_novel_group_id);
                                /*    console.log(response.data.group_display);
                                 if (!response.data.group_display) {
                                 //$('#tab' + publish_company_id).hide();
                                 location.reload();
                                 }*/

                            })
                            .catch(function (data, status, request) {
                                var errors = data.data;
                            });

                },
                //Stop Publishing
                stop: function (publish_company_id) {
                    app.stop_info.publish_company_id = publish_company_id;
                    app.$http.post('{{ route('publishnovelgroups.stop') }}', app.stop_info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                            .then(function (response) {
                                //  document.getElementById('tab' + publish_company_id).style.display = 'none';
                                location.reload();
                            })
                            .catch(function (data, status, request) {
                                var errors = data.data;
                            });
                },

                downloadNovel_ePub: function (novel_id) {
                    window.location.href = '{{url('publish_novel/e_pub') }}/' + novel_id;
                    /* this.$http.get('{{url('publish_novel/e_pub')}}/'+novel_id )
                     .then(function (response) {

                     // $('#response' + publish_company_id).html(response.data);
                     console.log(response);

                     });*/
                },

                searchByGroupName: function (e) {

                    // var search=document.getElementById('search').value;
                    window.location.href = '{{url('author/partnership/test_inning') }}?search=' + app.search;

                    /* app.$http.post('
                    {{--{{ route('publishnovelgroups.search_by_group') }}--}}', app.search, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                     .then(function (response) {
                     console.log(response);
                     //  document.getElementById('tab' + publish_company_id).style.display = 'none';
                     // location.reload();
                     })
                     .catch(function (data, status, request) {
                     var errors = data.data;
                     });
                     */

                }


            }

        });

    </script>

@endsection