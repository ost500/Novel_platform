<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Paymentcontroller extends Controller
{
    public function payment(Request $request)
    {
//        print_r($request->all());
        include(app_path() . '/Payment/payreq_crossplatform.php');
    }
}
