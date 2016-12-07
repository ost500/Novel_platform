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


                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>
@endsection
