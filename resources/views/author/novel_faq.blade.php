@extends('layouts.app')

@section('content')
    <div id="content-container">

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
                                            <a data-parent="#accordion" data-toggle="collapse"
                                               href="#collapse{{$loop->iteration}}">{{$loop->iteration}}
                                                . {{$faq->title  }} </a>
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
                                            <a data-parent="#accordion2" data-toggle="collapse"
                                               href="#collapse_author{{$loop->iteration}}">{{$loop->iteration}}
                                                . {{$faq->title  }} </a>
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
                                            <a data-parent="#accordion3" data-toggle="collapse"
                                               href="#collapse_other{{$loop->iteration}}">{{$loop->iteration}}
                                                . {{$faq->title  }} </a>
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
