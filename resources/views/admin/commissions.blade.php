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


            <div class="row" id="commission_list">
                <div class="col-lg-12">

                    <div class="panel">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <div class="padding-bottom-5">

                                    <form method="post" action="{{ route('admin.commissions_default') }}">
                                        {!! csrf_field() !!}
                                        <h4>기본 수수료</h4>
                                        <div class="pull-left" style="padding:10px">

                                            <input id="columnY" style="text-align: center" type="text"
                                                   placeholder="기본 수수료" class="form-control"
                                                   name="commission_default"
                                                   value="{{ $commission_default }}">

                                        </div>
                                        <div style="padding:10px">
                                            <button class="btn btn-warning">수정</button>
                                        </div>
                                    </form>
                                    <div style="float:right">
                                        <button v-on:click="each_commissions()" class="btn btn-primary">수수료 수정</button>
                                    </div>

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
                                                <th class="text-center">수수료</th>
                                            </tr>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td class="text-center col-md-2">{{ $user->name }}
                                                    </td>
                                                    <td class="text-center">{{ $user->email }}</td>
                                                    <td class="text-center">{{ $user->phone_num }}</td>
                                                    <td class="text-center">{{ $user->created_at }}</td>
                                                    <td class="text-center col-md-1">
                                                        @if($user->commission)
                                                            <input name="each_commissions[]" style="text-align: center"
                                                                   type="text" id="{{$user->id}}"
                                                                   placeholder="기본 수수료" class="form-control"
                                                                   value="{{ $user->commission }}">
                                                        @else
                                                            <input name="each_commissions[]" style="text-align: center"
                                                                   type="text" id="{{$user->id}}"
                                                                   placeholder="기본 수수료" class="form-control"
                                                                   value="">
                                                        @endif
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
                    el: '#commission_list',
                    data: {},
                    methods: {


                        each_commissions: function () {

                            bootbox.confirm({
                                message: "수정 하시겠습니까?",

                                buttons: {
                                    confirm: {
                                        label: "수정"
                                    },
                                    cancel: {
                                        label: '취소'
                                    }
                                },

                                callback: function (result) {

                                    if (result) {
                                        var checked_data = $('input[name^=each_commissions]').map(function () {
                                            var val = this.value;
                                            var id = this.id;
                                            return {val, id};
                                        }).get();

                                        console.log(checked_data);
                                        app_user.$http.post('{{ route('admin.commissions_each') }}', checked_data, {
                                            headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken},

                                        })
                                                .then(function (response) {
//                                                    console.log(response);
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
                })
                ;

    </script>
@endsection
