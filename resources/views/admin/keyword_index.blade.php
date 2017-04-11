@extends('layouts.admin_layout')

@section('content')
    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">

        <div id="page-title">
            <h1 class="page-header text-overflow">키워드</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">어드민</a></li>
            <li><a href="#">키워드</a></li>
            <li class="active">키워드</li>
        </ol>


        <div id="page-content">

            <div class="tab-base">

                <!--Nav Tabs-->
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#demo-lft-tab-1">장르
                            <span class="badge badge-purple">
                                {{ $keyword1->count() }}</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#demo-lft-tab-2">배경<span class="badge badge-purple">
                                {{ $keyword2->count() }}</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#demo-lft-tab-3">소재<span class="badge badge-purple">
                                {{ $keyword3->count() }}</span></a>
                    </li>
                    <li >
                        <a data-toggle="tab" href="#demo-lft-tab-4">관계
                            <span class="badge badge-purple">
                                {{ $keyword4->count() }}</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#demo-lft-tab-5">남주인공<span class="badge badge-purple">
                                {{ $keyword5->count() }}</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#demo-lft-tab-6">여주인공<span class="badge badge-purple">
                                {{ $keyword6->count() }}</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#demo-lft-tab-7">분위기/기타<span class="badge badge-purple">
                                {{ $keyword7->count() }}</span></a>
                    </li>
                </ul>

                <!--Tabs Content-->
                <div class="tab-content">
                    <div id="demo-lft-tab-1" class="tab-pane fade active in">
                        <div class="panel-group accordion" id="accordion">

                            @foreach($keyword1 as $keyword)
                                <div class="panel">
                                    <!--Accordion title-->


                                    <div class="panel-heading">


                                        <h4 class="panel-title">
                                            <div style="float:left">
                                                <a data-parent="#accordion" data-toggle="collapse"
                                                   href="#collapse{{$loop->iteration}}">{{$loop->iteration}}
                                                    . {{$keyword->name  }} </a>

                                            </div>
                                            <div style="float:right;">

                                                <button class="btn btn-success" onclick="update({{$keyword }})">수정
                                                </button>

                                                <button class="btn btn-warning"
                                                        onclick="destroy({{$keyword->id}})">삭제
                                                </button>
                                            </div>
                                        </h4>


                                    </div>


                                </div>

                                @endforeach
                                        <!--End Default Accordion-->
                        </div>
                    </div>

                    <div id="demo-lft-tab-2" class="tab-pane fade">
                        <div class="panel-group accordion" id="accordion2">
                            <!--<h4 class="text-thin">Second Tab Content</h4>-->

                            @foreach($keyword2 as $keyword)
                                <div class="panel">
                                    <!--Accordion title-->

                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <div style="float:left">
                                                <a data-parent="#accordion2" data-toggle="collapse"
                                                   href="#collapse_author{{$loop->iteration}}">{{$loop->iteration}}
                                                    . {{$keyword->name  }} </a>
                                            </div>
                                            <div style="float:right;">

                                                <button class="btn btn-success" onclick="update({{$keyword }})">수정
                                                </button>

                                                <button class="btn btn-warning"
                                                        onclick="destroy({{$keyword->id}})">삭제
                                                </button>
                                            </div>
                                        </h4>

                                    </div>


                                </div>

                            @endforeach
                        </div>
                    </div>
                    <div id="demo-lft-tab-3" class="tab-pane fade">
                        <div class="panel-group accordion" id="accordion3">
                            <!-- <h4 class="text-thin">Third Tab Content</h4>-->

                            @foreach($keyword3 as $keyword)
                                <div class="panel">
                                    <!--Accordion title-->

                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <div style="float:left">
                                                <a data-parent="#accordion3" data-toggle="collapse"
                                                   href="#collapse_other{{$loop->iteration}}">{{$loop->iteration}}
                                                    . {{$keyword->name  }} </a>
                                            </div>
                                            <div style="float:right;">

                                                <button class="btn btn-success" onclick="update({{$keyword }})">수정
                                                </button>

                                                <button class="btn btn-warning"
                                                        onclick="destroy({{$keyword->id}})">삭제
                                                </button>
                                            </div>
                                        </h4>
                                    </div>

                                </div>

                            @endforeach
                        </div>
                    </div>
                    <div id="demo-lft-tab-4" class="tab-pane fade">
                        <div class="panel-group accordion" id="accordion4">
                            <!-- <h4 class="text-thin">Third Tab Content</h4>-->

                            @foreach($keyword4 as $keyword)
                                <div class="panel">
                                    <!--Accordion title-->

                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <div style="float:left">
                                                <a data-parent="#accordion4" data-toggle="collapse"
                                                   href="#collapse_other{{$loop->iteration}}">{{$loop->iteration}}
                                                    . {{$keyword->name  }} </a>
                                            </div>
                                            <div style="float:right;">

                                                <button class="btn btn-success" onclick="update({{$keyword }})">수정
                                                </button>

                                                <button class="btn btn-warning"
                                                        onclick="destroy({{$keyword->id}})">삭제
                                                </button>
                                            </div>
                                        </h4>
                                    </div>

                                </div>

                            @endforeach
                        </div>
                    </div>
                    <div id="demo-lft-tab-5" class="tab-pane fade">
                        <div class="panel-group accordion" id="accordion5">
                            <!-- <h4 class="text-thin">Third Tab Content</h4>-->

                            @foreach($keyword5 as $keyword)
                                <div class="panel">
                                    <!--Accordion title-->

                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <div style="float:left">
                                                <a data-parent="#accordion5" data-toggle="collapse"
                                                   href="#collapse_other{{$loop->iteration}}">{{$loop->iteration}}
                                                    . {{$keyword->name  }} </a>
                                            </div>
                                            <div style="float:right;">

                                                <button class="btn btn-success" onclick="update({{$keyword }})">수정
                                                </button>

                                                <button class="btn btn-warning"
                                                        onclick="destroy({{$keyword->id}})">삭제
                                                </button>
                                            </div>
                                        </h4>
                                    </div>

                                </div>

                            @endforeach
                        </div>
                    </div>
                    <div id="demo-lft-tab-6" class="tab-pane fade">
                        <div class="panel-group accordion" id="accordion6">
                            <!-- <h4 class="text-thin">Third Tab Content</h4>-->

                            @foreach($keyword6 as $keyword)
                                <div class="panel">
                                    <!--Accordion title-->

                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <div style="float:left">
                                                <a data-parent="#accordion6" data-toggle="collapse"
                                                   href="#collapse_other{{$loop->iteration}}">{{$loop->iteration}}
                                                    . {{$keyword->name  }} </a>
                                            </div>
                                            <div style="float:right;">

                                                <button class="btn btn-success" onclick="update({{$keyword }})">수정
                                                </button>

                                                <button class="btn btn-warning"
                                                        onclick="destroy({{$keyword->id}})">삭제
                                                </button>
                                            </div>
                                        </h4>
                                    </div>

                                </div>

                            @endforeach
                        </div>
                    </div>
                    <div id="demo-lft-tab-7" class="tab-pane fade">
                        <div class="panel-group accordion" id="accordion7">
                            <!-- <h4 class="text-thin">Third Tab Content</h4>-->

                            @foreach($keyword7 as $keyword)
                                <div class="panel">
                                    <!--Accordion title-->

                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <div style="float:left">
                                                <a data-parent="#accordion7" data-toggle="collapse"
                                                   href="#collapse_other{{$loop->iteration}}">{{$loop->iteration}}
                                                    . {{$keyword->name  }} </a>
                                            </div>
                                            <div style="float:right;">

                                                <button class="btn btn-success" onclick="update({{$keyword }})">수정
                                                </button>

                                                <button class="btn btn-warning"
                                                        onclick="destroy({{$keyword->id}})">삭제
                                                </button>
                                            </div>
                                        </h4>
                                    </div>

                                </div>

                            @endforeach
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>

@endsection

<script type="text/javascript">


    /* var app = new Vue({

     el: '#faq_list',
     data: {

     formErrors: {}
     },
     mounted: function () {

     },

     methods: {*/
    function update(keyword) {

        keywordEdit(keyword);


    }


    function destroy(keyword_id) {
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
                    console.log(keyword_id);
                    $.ajax({
                        type: 'DELETE',
                        url: '{{ url('/keywords') }}/' + keyword_id,
                        headers: {
                            'X-CSRF-TOKEN': window.Laravel.csrfToken
                        },
                        success: function (response) {
                            location.reload();
                            $.niftyNoty({
                                type: 'warning',
                                icon: 'fa fa-check',
                                message: "삭제 되었습니다.",
                                container: 'page',
                                timer: 4000
                            });
                        },
                        error: function (data2) {
                            console.log(data2);
                        }
                    });

                }
            }
        });
    }


</script>
