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
                                            </tr>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td class="text-center col-md-2"><a
                                                                href="user/{{ $user->id }}">{{ $user->name }}</a>
                                                    </td>
                                                    <td class="text-center">{{ $user->email }}</td>
                                                    <td class="text-center">{{ $user->phone_num }}</td>
                                                    <td class="text-center">{{ $user->created_at }}</td>
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
@endsection
