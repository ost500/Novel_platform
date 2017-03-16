<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
class IdSearchController extends Controller
{
    var $agent;
    public function __construct()
    {
        $this->middleware('guest');
        $this->agent = new Agent();
    }

    public function id_search(Request $request)
    {
        if ( $this->agent->isMobile()) {
            return view('auth.passwords.mobile_id_search');
        }
        return view('auth.passwords.id_search');
    }

    public function id_search_post(Request $request)
    {
        $email = $request->email;

        $userName = User::where('email', $email)->first();

        if ($userName == null) {
            session()->flash('fail', "fail");
        } else {
            session()->flash('success', $userName->name);
        }


        return redirect()->back();
    }
}
