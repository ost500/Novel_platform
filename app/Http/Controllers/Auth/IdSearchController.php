<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class IdSearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function id_search(Request $request)
    {

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
