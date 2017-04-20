<?php

namespace App\Http\Controllers\Auth;

use App\Mail\VerifyEmail;
use App\User;
use Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Mail;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Jenssegers\Agent\Agent;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers {
        register as regi;
        showRegistrationForm as registerForm;
    }


    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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

    public function showRegistrationForm()
    {
        if ( $this->agent ->isMobile()) {
            return view('auth.mobile_register');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        //Mail send
        Mail::to(Auth::user())->send(new VerifyEmail(Auth::user()));
        
        Auth::logout();
        return "OK";


    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:15|min:2|unique:users',
            'user_name' => 'required|max:255|min:2',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'nickname' => 'required|max:15|regex:/^\S*$/u|unique:users',
            'birth' => 'required|digits:4',
            'gender' => 'required'
        ], [
            'name.unique' => '해당 아이디가 이미 존재합니다',
            'name.required' => '이름을 입력하세요',
            'name.max' => '이름은 15자 이하만 가능합니다',
            'name.min' => '이름은 6자 이상만 가능 합니다',
            'user_name.required' => '이름을 입력하세요',
            'user_name.max' => '이름은 255자 이하만 가능합니다',
            'user_name.min' => '이름은 2자 이상만 가능 합니다',
            'email.required' => '이메일을 입력하세요',
            'email.email' => '이메일 형식이 아닙니다',
            'email.max' => '이메일이 너무 깁니다',
            'email.unique' => '해당 이메일이 이미 존재합니다',
            'password.required' => '비밀번호를 입력하세요',
            'password.min' => '비밀번호가 너무 짧습니다',
            'password.confirmed' => '비밀번호가 일치하지 않습니다',
            'nickname.required' => '닉네임을 입력하세요',
            'nickname.max' => '닉네임 길이가 너무 깁니다',
            'nickname.regex' => '닉네임에 공백이 들어갈 수 없습니다',
            'nickname.unique' => '해당 닉네임이 이미 존재합니다'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'nickname' => $data['nickname'],
            'event_mail_available' => $data['event_mail_available'],
            'birth_of_year' => $data['birth'],
            'gender' => $data['gender'],
            'auth_mail_code' => str_random(10),
        ]);
    }
}
