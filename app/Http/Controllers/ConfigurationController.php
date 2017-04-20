<?php

namespace App\Http\Controllers;

use App\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function commissions_default(Request $request)
    {
        $commission_default = Configuration::where('config_name', 'commission');
        $commission_default->update(['config_value' => $request->commission_default]);
        return redirect()->back();
    }
}
