@extends('layouts.admin_layout')

@section('content')

    <div id="content-container" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">

        <div id="page-title">
            <h1 class="page-header text-overflow">회원관리</h1>
        </div>


        <ol class="breadcrumb">
            <li><a href="#">어드민</a></li>
            <li><a href="#">회원관리</a></li>
        </ol>


        <div id="page-content">


            <div class="row">
                <div class="col-lg-12">

                    <div class="panel">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <div class="padding-bottom-5">
                                </div>
                                <div id="user_list">
                                    @if(count($users) > 0)
                                        <table class="table table-bordered">
                                            <tbody>
                                            <tr>
                                                <th width="100" class="text-center">아이디</th>
                                                <th class="text-center">이메일</th>
                                                <th class="text-center">연락처</th>
                                                <th class="text-center">가입일</th>
                                                <th class="text-center">설정</th>
                                            </tr>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td class="text-center col-md-2">{{ $user->name }}
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
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="fixed-table-pagination" style="display: block;">
                                            <div class="pull-left">
                                                <ul class="pagination">

                                                    {{-- $users->render() --}}
                                                    <li class="page-first  @if($users->currentPage() ==1)  disabled @endif">
                                                        <a href=" @if($users->currentPage() ==1)  #  @else {{url('/admin/users'."?page=1")}} @endif">
                                                            &lt;&lt;</a>
                                                    </li>
                                                    @if($users->currentPage() >= 2)
                                                        <li class="page-pre"><a
                                                                    href="{{url('/admin/users'."?page=".($users->currentPage()-1))}}">
                                                                &lt;</a></li>
                                                    @endif
                                                    @if($users->currentPage() >= 5)
                                                        <li class="page-pre"><a
                                                                    href="{{url('/admin/users'."?page=".($users->currentPage()-4))}}">{{$users->currentPage()-4}}</a>
                                                        </li>
                                                    @endif
                                                    @if($users->currentPage() >= 4)
                                                        <li class="page-pre">
                                                            <a href="{{url('/admin/users'."?page=".($users->currentPage()-3))}}">{{$users->currentPage()-3}}</a>
                                                        </li>
                                                    @endif
                                                    @if($users->currentPage() >= 3)
                                                        <li class="page-pre">

                                                            <a href="{{url('/admin/users'."?page=".($users->currentPage()-2))}}">{{$users->currentPage()-2}}</a>
                                                        </li>
                                                    @endif
                                                    @if($users->currentPage() >= 2)
                                                        <li class="page-pre">
                                                            <a href="{{url('/admin/users'."?page=".($users->currentPage()-1))}}">{{$users->currentPage()-1}}</a>
                                                        </li>
                                                    @endif

                                                    <li class="page-number active">
                                                        <a href="#">{{ $users->currentPage()}}</a></li>

                                                    @if($users->lastPage()-1 >= $users->currentPage())
                                                        <li class="page-number">
                                                            <a href="{{url('/admin/users'."?page=".($users->currentPage()+1))}}">{{$users->currentPage()+1}}</a>
                                                        </li>
                                                    @endif
                                                    @if($users->lastPage()-2 >= $users->currentPage())
                                                        <li class="page-number">
                                                            <a href="{{url('/admin/users'."?page=".($users->currentPage()+2))}}">{{$users->currentPage()+2}}</a>
                                                        </li>
                                                    @endif
                                                    @if($users->lastPage()-3 >= $users->currentPage())
                                                        <li class="page-number"><a
                                                                    href="{{url('/admin/users'."?page=".($users->currentPage()+3))}}">{{$users->currentPage()+3}}</a>
                                                        </li>
                                                    @endif
                                                    @if($users->lastPage()-4 >= $users->currentPage())
                                                        <li class="page-number">
                                                            <a href="{{url('/admin/users'."?page=".($users->currentPage()+4))}}">{{$users->currentPage()+4}}</a>
                                                        </li>
                                                    @endif

                                                    @if($users->lastPage()-1 >= $users->currentPage())
                                                        <li class="page-next">
                                                            <a href="{{url('/admin/users'."?page=".($users->currentPage()+1))}}">
                                                                &gt;</a>
                                                        </li>
                                                    @endif

                                                    <li class="page-last  @if($users->currentPage() == $users->lastPage())  disabled @endif">
                                                        <a href=" @if($users->currentPage() ==$users->lastPage())  #  @else{{url('/admin/users'."?page=".($users->lastPage()))}} @endif">
                                                            &gt;&gt;</a>
                                                    </li>
                                                </ul>
                                            </div>


                                            <div class="pull-right">

                                            </div>
                                        </div>
                                    @else
                                        <div style="font-weight: 600;text-align: center;">
                                            No record Found.
                                        </div>
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
        var app_user = new Vue({
            el: '#user_list',
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
                                app_user.$http.delete('{{ url('users') }}/' + user_id, {headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken}})
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
