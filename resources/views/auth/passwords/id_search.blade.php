@extends('layouts.auth_layout')

<!-- Main Content -->
@section('content')

    <div id="final" class="register-content">
        <div class="register-form-step">

            <i class="is-active"></i>
        </div>
        <div class="register-form-header">
            <h2 class="title">아이디 찾기</h2>
            <p class="title-desc"></p>
        </div>
        <div class="sendmail-result">
            <p>가입할 당시 입력했던 이메일 주소를 입력해 주세요</p>
            <p id="email-addr" class="email-addr"></p>

            <div class="sendmail-btns">


                <form class="join-form" role="form" method="POST" action="{{ url('id_search') }}">
                    {{ csrf_field() }}

                    <div class="item-list item-list--register">
                        <div class="item-cols">
                            <label class="label" for="join_id">이메일</label>
                            <div class="input">
                                <input required name="email" type="email" class="text2" id="email" placeholder="이메일 입력"
                                       value="{{ old('email') }}">
                                <span class="valid-msg"></span>
                                @if ($errors->has('email'))
                                    <span class="alert-msg is-active"
                                          id="name_alert">본 이메일 주소로 등록된 계정이 없습니다</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            아이디를 성공적으로 찾았습니다 <br><br>
                            찾은 아이디 : {{ session('success') }}
                        </div>
                    @elseif (session('fail'))
                        <div class="alert alert-danger">
                            해당 아이디를 찾을 수 없습니다
                        </div>
                    @endif


                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn--retry">
                                아이디 찾기
                            </button>
                            @if (session('success'))
                                <a href="{{ route('root') ."?loginView=".session('success') }}" class="btn btn--modify">찾은
                                    아이디로 로그인</a>
                            @elseif (session('fail'))
                                <a href="{{ route('root') }}" class="btn btn--modify">메인으로 가기</a>
                            @endif
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection
