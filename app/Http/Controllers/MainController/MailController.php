<?php

namespace App\Http\Controllers\MainController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use App\Mailbox;

class MailController extends Controller
{
    public function received(Request $request)
    {

        $received_mails = Auth::user()->maillogs()->with('mailboxs.users')->where(['spam'=>0,'mybox'=>0])->latest()->paginate(10);
        //calculate the one week gap from today to check new items within 7 days
        $week_gap = Carbon::today()->subDays(7);

        return view('main.mails.received',compact('received_mails','week_gap'));
    }
    public function sent(Request $request)
    {

        $sent_mails =  Mailbox::where('from', Auth::user()->id)->with('users')->latest()->paginate(10);
        //calculate the one week gap from today to check new items within 7 days
        $week_gap = Carbon::today()->subDays(7);
        return view('main.mails.sent',compact('sent_mails','week_gap'));
    }
    public function spam(Request $request)
    {
        $spam_mails = Auth::user()->maillogs()->with('mailboxs.users')->where('spam',1)->latest()->paginate(10);
        //calculate the one week gap from today to check new items within 7 days
        $week_gap = Carbon::today()->subDays(7);
        return view('main.mails.spam',compact('spam_mails','week_gap'));
    }

    public function my_box(Request $request)
    {
        $my_box_mails = Auth::user()->maillogs()->with('mailboxs.users')->where('mybox',1)->latest()->paginate(10);
        //calculate the one week gap from today to check new items within 7 days
        $week_gap = Carbon::today()->subDays(7);
        return view('main.mails.my_box',compact('my_box_mails','week_gap'));
    }

}
