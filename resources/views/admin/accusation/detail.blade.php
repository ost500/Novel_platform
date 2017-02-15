@extends('layouts.admin_layout')

@section('content')
    <div id="content-container">

        <div id="page-title">
            <h1 class="page-header text-overflow">신고 관리</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">신고 관리</a></li>
            <li class="active"><a href="#">신고</a></li>
        </ol>


        <div id="page-content">

            <div class="panel">
                <div class="panel-body">


                    <div class="row">
                        <div class="col-sm-7">

                            <!--Sender Information-->
                            <div class="media">
                                <div class="media-body">
                                    <div class="text-bold request-subject">{{ $accu->title }}


                                    </div>

                                    <h4>{{ $accu->user->name }}</h4>

                                </div>
                            </div>
                        </div>

                        <hr class="hr-sm visible-xs">
                        <div class="col-sm-5 clearfix">

                            <!--Details Information-->
                            <div class="pull-right text-right">
                                <p class="mar-no">
                                <div class="text-muted">{{$accu->created_at}}</div>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!--Message-->
                    <!--===================================================-->
                    <div class="pad-all bord-all bg-gray-light">
                        <h4>신고대상 : {{ $accu->accuUser->name }}</h4>
                        <h4>링크 : <a href="{{ $accu->link }}">
                                <button class="btn btn-primary">링크</button>
                            </a></h4>

                        <table class="table table-bordered" id="accusation">
                            <tbody>
                            <tr>
                                <th width="100" class="text-center">아이디</th>
                                <th class="text-center">이메일</th>
                                <th class="text-center">연락처</th>
                                <th class="text-center">가입일</th>
                                <th class="text-center">설정</th>
                            </tr>

                            <tr>
                                <td class="text-center col-md-2"><a
                                            href="user/{{ $user->id }}">{{ $user->name }}</a>
                                </td>
                                <td class="text-center">{{ $user->email }}</td>
                                <td class="text-center">{{ $user->phone_num }}</td>
                                <td class="text-center">{{ $user->created_at }}</td>
                                <td class="text-center">
                                    @if(!$user->block_login)
                                        <button class="btn btn-primary"
                                                id="block_block_login{{ $user->id }}"
                                                v-on:click="blockUnblock('{{ $user->id }}','block_login','1')">
                                            로그인 정지
                                        </button>
                                        <button class="btn btn-primary"
                                                id="unblock_block_login{{ $user->id }}"
                                                style="display:none;"
                                                v-on:click="blockUnblock('{{ $user->id }}','block_login','0')">
                                            로그인 정지 해제
                                        </button>
                                    @else
                                        <button class="btn btn-primary"
                                                id="block_block_login{{ $user->id }}"
                                                style="display:none;"
                                                v-on:click="blockUnblock('{{ $user->id }}','block_login','1')">
                                            로그인 정지
                                        </button>
                                        <button class="btn btn-primary"
                                                id="unblock_block_login{{ $user->id }}"
                                                v-on:click="blockUnblock('{{ $user->id }}','block_login','0')">
                                            로그인 정지 해제
                                        </button>
                                    @endif
                                    @if(!$user->block_send_mail)
                                        <button class="btn btn-info"
                                                id="block_block_send_mail{{ $user->id }}"
                                                v-on:click="blockUnblock('{{ $user->id }}','block_send_mail','1')">
                                            쪽지 발신 금지
                                        </button>
                                        <button class="btn btn-info"
                                                id="unblock_block_send_mail{{ $user->id }}"
                                                style="display:none;"
                                                v-on:click="blockUnblock('{{ $user->id }}','block_send_mail','0')">
                                            쪽지 발신 금지 해제
                                        </button>
                                    @else
                                        <button class="btn btn-info"
                                                id="block_block_send_mail{{ $user->id }}"
                                                style="display:none;"
                                                v-on:click="blockUnblock('{{ $user->id }}','block_send_mail','1')">
                                            쪽지 발신 금지
                                        </button>
                                        <button class="btn btn-info"
                                                id="unblock_block_send_mail{{ $user->id }}"
                                                v-on:click="blockUnblock('{{ $user->id }}','block_send_mail','0')">
                                            쪽지 발신 금지 해제
                                        </button>
                                    @endif

                                    @if(!$user->block_comment)
                                        <button class="btn btn-purple"
                                                id="block_block_comment{{ $user->id }}"
                                                v-on:click="blockUnblock('{{ $user->id }}','block_comment','1')">
                                            댓글정지
                                        </button>
                                        <button class="btn btn-purple"
                                                id="unblock_block_comment{{ $user->id }}"
                                                style="display:none;"
                                                v-on:click="blockUnblock('{{ $user->id }}','block_comment','0')">
                                            댓글정지 해제
                                        </button>
                                    @else
                                        <button class="btn btn-purple"
                                                id="block_block_comment{{ $user->id }}"
                                                style="display:none;"
                                                v-on:click="blockUnblock('{{ $user->id }}','block_comment','1')">
                                            댓글정지
                                        </button>
                                        <button class="btn btn-purple"
                                                id="unblock_block_comment{{ $user->id }}"
                                                v-on:click="blockUnblock('{{ $user->id }}','block_comment','0')">
                                            댓글정지 해제
                                        </button>
                                    @endif

                                    @if(!$user->block_free_board_review)
                                        <button class="btn btn-mint"
                                                id="block_block_free_board_review{{ $user->id }}"
                                                v-on:click="blockUnblock('{{ $user->id }}','block_free_board_review','1')">
                                            게시물 게시 금지
                                        </button>
                                        <button class="btn btn-mint"
                                                id="unblock_block_free_board_review{{ $user->id }}"
                                                style="display:none;"
                                                v-on:click="blockUnblock('{{ $user->id }}','block_free_board_review','0')">
                                            게시물 게시 금지 해제
                                        </button>
                                    @else
                                        <button class="btn btn-mint"
                                                id="block_block_free_board_review{{ $user->id }}"
                                                style="display:none;"
                                                v-on:click="blockUnblock('{{ $user->id }}','block_free_board_review','1')">
                                            게시물 게시 금지
                                        </button>
                                        <button class="btn btn-mint"
                                                id="unblock_block_free_board_review{{ $user->id }}"
                                                v-on:click="blockUnblock('{{ $user->id }}','block_free_board_review','0')">
                                            게시물 게시 금지 해제
                                        </button>
                                    @endif
                                    <button class="btn btn-success"
                                            v-on:click="send_mail('{{$user->id }}')">쪽지보내기
                                    </button>
                                    <button class="btn btn-warning"
                                            v-on:click="removeUser('{{$user->id }}')">탈퇴
                                    </button>
                                </td>
                            </tr>

                            </tbody>
                        </table>

                        {{$accu->contents}}
                    </div>
                    <div style="margin-top:10px" class="pull-left">

                    </div>

                </div>
            </div>

            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-7">

                        </div>
                        <hr class="hr-sm visible-xs">
                        <div class="col-sm-12 clearfix">
                            <div class="pull-left">

                            </div>
                        </div>
                    </div>
                    <hr class="hr-sm">

                    <!--Mail list group-->
                    <ul id="demo-mail-list" class="mail-list">
                    @foreach($accus as $accusation)
                        @if($accu->id == $accusation->id)
                            @continue
                        @endif
                        <!--Mail list item-->
                            <li class="mail-list-unread">
                                <div class="mails-from">


                                    <div class="mail-from">
                                        <a>관리자</a>

                                    </div>


                                    <div class="mail-time">{{$accusation->created_at}}</div>

                                    <div class="mail-subject">
                                        <a href="{{ route('admin.accusations.detail', ['id' => $accusation->id]) }}/?page={{$page}}">{{$accusation->title}} </a>
                                    </div>
                                </div>
                            </li>
                    @endforeach

                    <!--Mail list item-
                    <li class="mails-starred">
                        <div class="mails-from"><button class="btn btn-xs btn-success">완료</button></div>
                        <div class="mails-time">2014-10-06</div>

                        <div class="mails-subject">
                            <a href="novel_request.php">Tracking Your Order - Shoes Store Online</a>
                        </div>
                    </li>

                    <!--Mail list item
                    <li class="mails-list-unread mails-starred">
                        <div class="mails-from"><button class="btn btn-xs btn-success">완료</button></div>
                        <div class="mails-time">2014-10-06</div>

                        <div class="mails-subject">
                            <a href="novel_request_view.php">Reset your account password</a>
                        </div>
                    </li>-->

                    </ul>
                    <div class="fixed-table-pagination" style="display: block;">
                        <div class="pull-left">
                            @include('pagination', ['collection' => $accus, 'url' => route('admin.notifications.detail', ['id'=>$accu->id])])
                        </div>
                    </div>
                </div>

            </div>
            <!--===================================================-->
            <!-- END OF MAIL INBOX -->


        </div>


    </div>

    <script type="text/javascript">
        var app_user = new Vue({
            el: '#accusation',
            data: {
                block_info: {user_id: '', block_type: '', block_unblock: ''},
                confirm_msg: '',
                block_text: ''
            },
            methods: {

                send_mail: function (user_id) {
                    window.location.assign('/admin/specific_mail/' + user_id);
                },

                blockUnblock: function (user_id, block_type, block_unblock) {
                    //set the block text to be shown in the alert box related to block type
                    if (block_type == 'block_login') {
                        app_user.block_text = '로그인';
                    }
                    else if (block_type == 'block_send_mail') {
                        app_user.block_text = '쪽지 보내기 기능';
                    }
                    else if (block_type == 'block_comment') {
                        app_user.block_text = '댓글 기능';
                    }
                    else if (block_type == 'block_free_board_review') {
                        app_user.block_text = '게시물 등록 기능';
                    }

                    //Set the confirm message based on type of action
                    if (block_unblock == 1) {
                        app_user.confirm_msg = '해당 유저의 ' + app_user.block_text + ' 제한 하시겠습니까? ';
                    } else {
                        app_user.confirm_msg = '해당 유저의 ' + app_user.block_text + '의 제한을 해제 하시겠습니까?';
                    }


                    bootbox.confirm({
                        message: app_user.confirm_msg,

                        buttons: {
                            confirm: {
                                label: "확인"
                            },
                            cancel: {
                                label: '취소'
                            }
                        },

                        callback: function (result) {
                            if (result) {

                                app_user.block_info.user_id = user_id;
                                app_user.block_info.block_type = block_type;
                                app_user.block_info.block_unblock = block_unblock;
                                app_user.$http.put('{{ route('users.update_block') }}', app_user.block_info, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                                        .then(function (response) {
                                            //if request is blocked then show unblock button otherwise show block button
                                            if (response.data.block_unblock == 1) {
                                                $('#unblock_' + block_type + user_id).show();
                                                $('#block_' + block_type + user_id).hide();
                                            } else {
                                                $('#unblock_' + block_type + user_id).hide();
                                                $('#block_' + block_type + user_id).show();
                                            }
                                        }).catch(function (errors) {

                                    console.log(errors);
                                });
                            }
                        }
                    });

                },

                removeUser: function (user_id) {

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
                                app.$http.delete('{{ url('users') }}/' + user_id, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
                                        .then(function (response) {
                                            //  console.log(response);
                                            location.reload();
                                        })
                                        .catch(function (errors) {

                                            console.log(errors);
                                        });
                            }
                        }
                    });
                }
            }
        });

    </script>
@endsection