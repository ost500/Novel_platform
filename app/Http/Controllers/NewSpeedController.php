<?php

namespace App\Http\Controllers;

use App\NewSpeed;
use App\NewSpeedLog;
use Auth;
use Illuminate\Http\Request;

class NewSpeedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
//        $new_speeds = NewSpeedLog::where('user_id', Auth::user()->id)->latest()->take(5)->get();

        $new_speeds = NewSpeedLog::join('new_speeds', 'new_speeds.id', '=', 'new_speed_logs.new_speed_id')
            ->where('new_speed_logs.user_id', Auth::user()->id)
            ->groupBy('id')
            ->select('new_speed_logs.user_id', 'new_speed_logs.user_id', 'new_speed_logs.created_at', 'new_speeds.title', 'new_speeds.link', 'new_speeds.image', 'new_speed_logs.id', 'new_speed_logs.read')
            ->take(5)
            ->latest()
            ->get();




        foreach ($new_speeds as $new_speed) {
            $new_speed->time_ago = time_elapsed_string($new_speed->created_at);
        }

        $new_speed_read_count = NewSpeedLog::where('user_id', Auth::user()->id)->where('read', 0)->get()->count();

        $new_speeds->put('news_count', $new_speed_read_count);

        return response()->json($new_speeds);
    }
}
