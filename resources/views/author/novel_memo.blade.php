@extends('layouts.app')

@section('content')
 <div id="content-container">

    <div id="page-title">
        <h1 class="page-header text-overflow">쪽지함</h1>
    </div>


    <ol class="breadcrumb">
        <li><a href="#">작가홈</a></li>
        <li class="active"><a href="#">쪽지함</a></li>
    </ol>


    <div id="page-content">



        <div class="panel panel-default panel-left">
            <div id="demo-email-list" class="panel-body">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="btn-group">
                            <div id="demo-checked-all-mail" class="btn btn-default">
                                <label class="form-checkbox form-normal form-primary">
                                    <input class="form-input" type="checkbox" name="mail-list">
                                </label>
                            </div>
                            <button data-toggle="dropdown" class="btn btn-default dropdown-toggle dropdown-toggle-icon"><i class="dropdown-caret fa fa-caret-down"></i></button>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)" id="demo-select-all-list">전체선택</a></li>
                                <li><a href="javascript:void(0)" id="demo-select-none-list">선택해제</a></li>
                            </ul>
                        </div>
                    </div>
                    <hr class="hr-sm visible-xs">
                    <div class="col-sm-5 clearfix">
                        <div class="pull-right">
                            <button class="btn btn-danger">선택삭제</button>
                        </div>
                    </div>
                </div>
                <hr class="hr-sm">

                <!--Mail list group-->
                <ul id="demo-mail-list" class="mail-list">

                    <!--Mail list item-->
                    <li class="mail-list-unread mail-attach">
                        <div class="mail-control">
                            <label class="demo-cb-mail form-checkbox form-normal form-primary">
                                <input type="checkbox">
                            </label>
                        </div>

                        <div class="mail-from"><a href="#">Michael Robert</a></div>
                        <div class="mail-time">05:55 PM</div>

                        <div class="mail-subject">
                            <a href="javasript:void(0);" class="novel-memo-view">This is an example if there is a really really long text. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, </a>
                        </div>
                    </li>

                    <!--Mail list item-->
                    <li class="mail-starred">
                        <div class="mail-control">
                            <label class="demo-cb-mail form-checkbox form-normal form-primary">
                                <input type="checkbox">
                            </label>
                        </div>

                        <div class="mail-from"><a href="#">Shopping Mall</a></div>
                        <div class="mail-time">10:45 AM</div>

                        <div class="mail-subject">
                            <a href="mailbox-message.html">Tracking Your Order - Shoes Store Online</a>
                        </div>
                    </li>

                    <!--Mail list item-->
                    <li class="mail-list-unread mail-starred mail-attach">
                        <div class="mail-control">
                            <label class="demo-cb-mail form-checkbox form-normal form-primary">
                                <input type="checkbox">
                            </label>
                        </div>

                        <div class="mail-from"><a href="#">Dropbox</a></div>
                        <div class="mail-time">07:18 AM</div>

                        <div class="mail-subject">
                            <a href="mailbox-message.html">Reset your account password</a>
                        </div>
                    </li>

                    <!--Mail list item-->
                    <li class="mail-list-unread">
                        <div class="mail-control">
                            <label class="demo-cb-mail form-checkbox form-normal form-primary">
                                <input type="checkbox">
                            </label>
                        </div>

                        <div class="mail-from"><a href="#">Server Host</a></div>
                        <div class="mail-time">01:51 PM</div>

                        <div class="mail-subject">
                            <a href="mailbox-message.html">
											<span class="label label-danger">
											Bussines
											</span>
                                Regarding to your website issues.
                            </a>
                        </div>
                    </li>

                    <!--Mail list item-->
                    <li>
                        <div class="mail-control">
                            <label class="demo-cb-mail form-checkbox form-normal form-primary">
                                <input type="checkbox">
                            </label>
                        </div>

                        <div class="mail-from"><a href="#">Lisa D. Smith</a></div>
                        <div class="mail-time">Yesterday</div>

                        <div class="mail-subject">
                            <a href="mailbox-message.html">Hi John! How are you?</a>
                        </div>
                    </li>
                </ul>


                <div class="fixed-table-pagination" style="display: block;">
                    <div class="pull-left">
                        <button class="btn btn-danger">선택삭제</button>
                    </div>

                    <div class="pull-right">
                        <ul class="pagination"><li class="page-first disabled"><a href="javascript:void(0)">&lt;&lt;</a></li><li class="page-pre disabled"><a href="javascript:void(0)">&lt;</a></li><li class="page-number active disabled"><a href="javascript:void(0)">1</a></li><li class="page-number"><a href="javascript:void(0)">2</a></li><li class="page-number"><a href="javascript:void(0)">3</a></li><li class="page-number"><a href="javascript:void(0)">4</a></li><li class="page-number"><a href="javascript:void(0)">5</a></li><li class="page-next"><a href="javascript:void(0)">&gt;</a></li><li class="page-last"><a href="javascript:void(0)">&gt;&gt;</a></li></ul>
                    </div>
                </div>
            </div>

        </div>
        <!--===================================================-->
        <!-- END OF MAIL INBOX -->


    </div>


 </div>

@endsection