<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Jenssegers\Agent\Agent;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

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

    public function showLinkRequestForm()
    {
        if ( $this->agent ->isMobile()) {
            return view('auth.passwords.mobile_email');
        }
        return view('auth.passwords.email');
    }
}
