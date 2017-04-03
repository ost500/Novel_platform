<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords {
        validationErrorMessages as vali;
        sendResetFailedResponse as resetFailed;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    var $agent;
    public function __construct()
    {
        $this->middleware('guest');
        $this->agent = new Agent();
    }

    public function showResetForm(Request $request, $token = null)
    {
        if ( $this->agent ->isMobile()) {
            return view('auth.passwords.mobile_reset')->with(
                ['token' => $token, 'email' => $request->email]
            );
        }

        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    protected function validationErrorMessages()
    {
        return ['token' => '접근 경로가 올바르지 않습니다'
            , 'email.required' => "이메일을 입력해 주세요"
            , 'email.email' => '이메일 형식이 옳지 않습니다'
            , 'password.required' => '비밀번호를 입력해 주세요'
            , 'password.confirmed' => "비밀번호를 다시 확인해 주세요"
            , 'password.min' => '비밀번호는 반드시 6자리 이상이어야 합니다'];
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => "이메일 주소가 정확하지 않습니다"]);
    }

}
