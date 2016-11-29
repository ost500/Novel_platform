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
                                {{-- count(array_filter($faqs, function($v, $k) {
                                     return $k == 'faq_category' || $v == 1;}, ARRAY_FILTER_USE_BOTH)) --}}9</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#demo-lft-tab-2">작가</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#demo-lft-tab-3">기타</a>
                    </li>
                </ul>

                <!--Tabs Content-->
                <div class="tab-content">
                    <div id="demo-lft-tab-1" class="tab-pane fade active in">
                        <div class="panel-group accordion" id="accordion">
                            @php
                            $i=1
                            @endphp
                            @foreach($faqs as $faq)
                                <div class="panel">
                                    <!--Accordion title-->

                                    @if($faq->faq_category == 1)
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-parent="#accordion" data-toggle="collapse" href="#collapse{{$i}}">{{$i}}. {{$faq->title  }} </a>
                                            </h4>
                                        </div>

                                        <!--Accordion content-->
                                        <div class="panel-collapse collapse" id="collapse{{$i}}">
                                            <div class="panel-body">
                                                {{$faq->description}}

                                            </div>
                                        </div>
                                        @php
                                        $i=$i+1
                                        @endphp
                                    @endif
                                </div>

                             @endforeach
                              <!--End Default Accordion-->
                         </div>
                    </div>

                    <div id="demo-lft-tab-2" class="tab-pane fade">
                        <div class="panel-group accordion" id="accordion">
                            <!--<h4 class="text-thin">Second Tab Content</h4>-->
                            @php
                            $j=1
                            @endphp
                            @foreach($faqs as $faq)
                                <div class="panel">
                                    <!--Accordion title-->
                                    @if($faq->faq_category == 2)
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-parent="#accordion" data-toggle="collapse" href="#collapse_author{{$j}}">{{$j}}. {{$faq->title  }} </a>
                                            </h4>
                                        </div>

                                        <!--Accordion content-->
                                        <div class="panel-collapse collapse" id="collapse_author{{$j}}">
                                            <div class="panel-body">
                                                {{$faq->description}}

                                            </div>
                                        </div>
                                        @php
                                        $j=$j+1
                                        @endphp
                                    @endif
                                </div>

                            @endforeach
                        </div>
                    </div>
                    <div id="demo-lft-tab-3" class="tab-pane fade">
                        <div class="panel-group accordion" id="accordion">
                           <!-- <h4 class="text-thin">Third Tab Content</h4>-->
                            @php
                            $k=1
                            @endphp
                            @foreach($faqs as $faq)
                                <div class="panel">
                                    <!--Accordion title-->
                                    @if($faq->faq_category == 3)
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-parent="#accordion" data-toggle="collapse" href="#collapse_other{{$k}}">{{$k}}. {{$faq->title  }} </a>
                                            </h4>
                                        </div>

                                        <!--Accordion content-->
                                        <div class="panel-collapse collapse" id="collapse_other{{$k}}">
                                            <div class="panel-body">
                                                {{$faq->description}}

                                            </div>
                                        </div>
                                        @php
                                        $k=$k+1
                                        @endphp
                                        <input type="hidden" name="faq_other_count" id="faq_other_count" value="{{$k}}" />
                                    @endif
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection
