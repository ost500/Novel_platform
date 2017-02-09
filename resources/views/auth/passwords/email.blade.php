@extends('layouts.auth_layout')

<!-- Main Content -->
@section('content')

    <div id="final" class="register-content">
        <div class="register-form-step">

            <i class="is-active"></i>
        </div>
        <div class="register-form-header">
            <h2 class="title">비밀번호 리셋 메일 발송</h2>
            <p class="title-desc">메일을 확인해 주세요.</p>
        </div>
        <div class="sendmail-result">
            <p>다음의 메일로 비밀번호 리셋 메일이 발송 됩니다.</p>
            <p id="email-addr" class="email-addr"></p>

            <div class="sendmail-btns">


                <form class="join-form" role="form" method="POST" action="{{ url('/password/email') }}">
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

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{--{{ session('status') }}--}}
                            비밀번호 리셋 메일을 성공적으로 전송했습니다
                        </div>
                    @endif


                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn--retry">
                                비밀번호 리셋 링크 전송
                            </button>
                            @if (session('status'))
                                <a href="{{ route('root') }}" class="btn btn--modify">메인으로 가기</a>
                            @endif
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection
