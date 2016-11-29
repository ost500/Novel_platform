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
                        <a data-toggle="tab" href="#demo-lft-tab-1">독자 <span class="badge badge-purple">{{count($faqs)}}</span></a>
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
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-parent="#accordion" data-toggle="collapse" href="#collapse{{$i}}">{{$i}}. {{$faq->title  }} </a>
                                        </h4>
                                    </div>

                                        <!--Accordion content-->
                                        <div class="panel-collapse collapse" id="collapse{{$i}}">
                                            <div class="panel-body">
                                                {{$faq->description}}
                                                -모바일 APP의 경우: 메인 화면 좌측 상단의 三 버튼 -> [내정보] -> [내정보수정]에서 수정 가능합니다.	<br><br>

                                                -PC의 경우: 메인 페이지 우측 [마이페이지]에서 수정 가능합니다. <br><br>

                                                -[내정보 – 내정보수정]에서 수정이 불가능한 경우, 1:1문의를 통해 요청해주시면 변경해드리겠습니다.
                                            </div>
                                        </div>
                                </div>
                                @php
                                $i=$i+1
                                @endphp
                             @endforeach
                              <!--End Default Accordion-->
                         </div>
                        </div>

                        <div id="demo-lft-tab-2" class="tab-pane fade">
                            <h4 class="text-thin">Second Tab Content</h4>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                        </div>
                        <div id="demo-lft-tab-3" class="tab-pane fade">
                            <h4 class="text-thin">Third Tab Content</h4>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                        </div>
                </div>
            </div>


        </div>
    </div>

@endsection