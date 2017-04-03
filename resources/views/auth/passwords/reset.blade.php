@extends('layouts.auth_layout')

@section('content')

    <div id="final" class="register-content">
        <div class="register-form-step">

            <i class="is-active"></i>
        </div>
        <div class="register-form-header">
            <h2 class="title">비밀번호 리셋</h2>

        </div>
        <div class="sendmail-result">
            <p>다음의 정보로 비밀번호가 리셋 됩니다.</p>
            <p id="email-addr" class="email-addr"></p>

            <div class="sendmail-btns">


                <form class="join-form" role="form" method="POST" action="{{ url('/password/reset') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="item-list item-list--register">
                        <div class="item-cols">
                            <label class="label" for="join_id">이메일</label>
                            <div class="input">
                                <input required name="email" type="email" class="text2" id="email" placeholder="이메일 입력"
                                       value="{{ $email or old('email') }}" >
                                <span class="valid-msg"></span>
                                @if ($errors->has('email'))
                                    <span class="alert-msg is-active"
                                          id="name_alert">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="item-cols">
                            <label class="label" for="join_id">비밀번호</label>
                            <div class="input">
                                <input required name="password" type="password" class="text2" id="password" placeholder="비밀번호 입력"
                                      >
                                <span class="valid-msg"></span>
                                @if ($errors->has('password'))
                                    <span class="alert-msg is-active"
                                          id="name_alert">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="item-cols">
                            <label class="label" for="join_id">비밀번호 확인</label>
                            <div class="input">
                                <input required name="password_confirmation" type="password" class="text2" id="password-confirm" placeholder="비밀번호 확인 입력"
                                       >
                                <span class="valid-msg"></span>
                                @if ($errors->has('password_confirmation'))
                                    <span class="alert-msg is-active"
                                          id="name_alert">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn--retry">
                                비밀번호 리셋
                            </button>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>

@endsection
