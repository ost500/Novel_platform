<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        sendFailedLoginResponse as sendFailed;
        attemptLogin as attempt;
        username as id;
        showLoginForm as loginForm;
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
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return redirect('/?loginView=');
    }

    public function mobileLoginForm()
    {
        return view('mobile.login');
    }

    protected function attemptLogin(Request $request)
    {
        //check if user is blocked or not
        $user=User::where('name',$request->only($this->username()))->first();
        //if user exists and login is blocked then return back
        if($user && $user->block_login){  return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => "로그인이 제한 됐습니다",

            ]);}

        return $this->guard()->attempt(
            $this->credentials($request), $request->has('remember')
        );
    }



    public function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => "로그인에 실패했습니다",
                
            ]);
    }

    public function username()
    {
        return 'name';
    }
}
