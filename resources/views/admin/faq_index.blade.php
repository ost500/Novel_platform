@extends('layouts.admin_layout')

@section('content')
    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">

        <div id="page-title">
            <h1 class="page-header text-overflow">FAQ</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">작가홈</a></li>
            <li class="active"><a href="#">FAQ</a></li>
        </ol>


        <div id="page-content">

            <div class="tab-base">

                <!--Nav Tabs-->
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#demo-lft-tab-1">독자
                            <span class="badge badge-purple">
                                {{ $faq_reader->count() }}</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#demo-lft-tab-2">작가<span class="badge badge-purple">
                                {{ $faq_author->count() }}</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#demo-lft-tab-3">기타<span class="badge badge-purple">
                                {{ $faq_etc->count() }}</span></a>
                    </li>
                </ul>

                <!--Tabs Content-->
                <div class="tab-content">
                    <div id="demo-lft-tab-1" class="tab-pane fade active in">
                        <div class="panel-group accordion" id="accordion">

                            @foreach($faq_reader as $faq)
                                <div class="panel">
                                    <!--Accordion title-->


                                    <div class="panel-heading">


                                        <h4 class="panel-title">
                                            <div style="float:left">
                                                <a data-parent="#accordion" data-toggle="collapse"
                                                   href="#collapse{{$loop->iteration}}">{{$loop->iteration}}
                                                    . {{$faq->title  }} </a>

                                            </div>
                                            <div style="float:right;">

                                                <button class="btn btn-success" onclick="update({{$faq }})">수정
                                                </button>

                                                <button class="btn btn-warning"
                                                        onclick="destroy({{$faq->id}})">삭제
                                                </button>
                                            </div>
                                        </h4>


                                    </div>

                                    <!--Accordion content-->
                                    <div class="panel-collapse collapse" id="collapse{{$loop->iteration}}">
                                        <div class="panel-body">
                                            {{$faq->description}}

                                        </div>
                                    </div>

                                </div>

                                @endforeach
                                        <!--End Default Accordion-->
                        </div>
                    </div>

                    <div id="demo-lft-tab-2" class="tab-pane fade">
                        <div class="panel-group accordion" id="accordion2">
                            <!--<h4 class="text-thin">Second Tab Content</h4>-->

                            @foreach($faq_author as $faq)
                                <div class="panel">
                                    <!--Accordion title-->

                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <div style="float:left">
                                                <a data-parent="#accordion2" data-toggle="collapse"
                                                   href="#collapse_author{{$loop->iteration}}">{{$loop->iteration}}
                                                    . {{$faq->title  }} </a>
                                            </div>
                                            <div style="float:right;">

                                                <button class="btn btn-success" onclick="update({{$faq }})">수정
                                                </button>

                                                <button class="btn btn-warning"
                                                        onclick="destroy({{$faq->id}})">삭제
                                                </button>
                                            </div>
                                        </h4>

                                    </div>

                                    <!--Accordion content-->
                                    <div class="panel-collapse collapse" id="collapse_author{{$loop->iteration}}">
                                        <div class="panel-body">
                                            {{$faq->description}}

                                        </div>
                                    </div>

                                </div>

                            @endforeach
                        </div>
                    </div>
                    <div id="demo-lft-tab-3" class="tab-pane fade">
                        <div class="panel-group accordion" id="accordion3">
                            <!-- <h4 class="text-thin">Third Tab Content</h4>-->

                            @foreach($faq_etc as $faq)
                                <div class="panel">
                                    <!--Accordion title-->

                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <div style="float:left">
                                                <a data-parent="#accordion3" data-toggle="collapse"
                                                   href="#collapse_other{{$loop->iteration}}">{{$loop->iteration}}
                                                    . {{$faq->title  }} </a>
                                            </div>
                                            <div style="float:right;">

                                                <button class="btn btn-success" onclick="update({{$faq }})">수정
                                                </button>

                                                <button class="btn btn-warning"
                                                        onclick="destroy({{$faq->id}})">삭제
                                                </button>
                                            </div>
                                        </h4>
                                    </div>

                                    <!--Accordion content-->
                                    <div class="panel-collapse collapse" id="collapse_other{{$loop->iteration}}">
                                        <div class="panel-body">
                                            {{$faq->description}}

                                        </div>
                                    </div>

                                    <input type="hidden" name="faq_other_count" id="faq_other_count"
                                           value="{{$loop->iteration}}"/>

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
    function update(faq) {
        // console.log(faq);

        faqUpdate(faq);


    }


    function destroy(faq_id) {
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
                    console.log(faq_id);
                    $.ajax({
                        type: 'DELETE',
                        url: '{{ url('/faqs') }}/' + faq_id,
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
