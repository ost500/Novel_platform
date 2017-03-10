<?php

namespace App\Http\Controllers\MainController;

use App\MailLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use App\Mailbox;
use App\User;
use Jenssegers\Agent\Agent;
class MailController extends Controller
{

    var $agent;

    public function __construct()
    {
        $this->agent = new Agent();
    }

    public function create($id = null)
    {

        $user = User::where('id', $id)->first();
        //Detect mobile
        if ($this->agent->isMobile()) {
            return view('mobile.mails.create', compact('user'));

        }
        return view('main.mails.create', compact('user'));
    }

    public function received(Request $request)
    {

        $received_mails = Auth::user()->maillogs()->with('mailboxs.users')->where(['spam' => 0, 'mybox' => 0])->latest()->paginate(10);
        //calculate the one week gap from today to check new items within 7 days
        $week_gap = Carbon::today()->subDays(7);

        //Detect mobile
        if ($this->agent->isMobile()) {
            return view('mobile.mails.received', compact('received_mails', 'week_gap'));

        }
        return view('main.mails.received', compact('received_mails', 'week_gap'));
    }

    public function sent(Request $request)
    {

        $sent_mails = Mailbox::where('from', Auth::user()->id)->with('users')->latest()->paginate(10);
        //calculate the one week gap from today to check new items within 7 days
        $week_gap = Carbon::today()->subDays(7);
        //Detect mobile
        if ($this->agent->isMobile()) {
            return view('mobile.mails.sent', compact('sent_mails', 'week_gap'));

        }
        return view('main.mails.sent', compact('sent_mails', 'week_gap'));
    }

    public function spam(Request $request)
    {
        $spam_mails = Auth::user()->maillogs()->with('mailboxs.users')->where('spam', 1)->latest()->paginate(10);
        //calculate the one week gap from today to check new items within 7 days
        $week_gap = Carbon::today()->subDays(7);
        //Detect mobile
        if ($this->agent->isMobile()) {
            return view('mobile.mails.spam', compact('spam_mails', 'week_gap'));

        }
        return view('main.mails.spam', compact('spam_mails', 'week_gap'));
    }

    public function my_box(Request $request)
    {
        $my_box_mails = Auth::user()->maillogs()->with('mailboxs.users')->where('mybox', 1)->latest()->paginate(10);
        //calculate the one week gap from today to check new items within 7 days
        $week_gap = Carbon::today()->subDays(7);

        //Detect mobile
        if ($this->agent->isMobile()) {
            return view('mobile.mails.my_box', compact('my_box_mails', 'week_gap'));

        }
        return view('main.mails.my_box', compact('my_box_mails', 'week_gap'));
    }

    public function detail($id)
    {
        $mail = MailLog::where('id', $id)->with('mailboxs')->with('users')->first();

        if ($mail->user_id != Auth::user()->id) {
            return response()->view('errors.503', [], 503);
        }

        $mail->read = Carbon::today();
        $mail->save();


        $next_mail_id = MailLog::where('id', '>', $mail->id)->where('user_id', Auth::user()->id)->min('id');
        $next_mail = MailLog::with('users')->with('mailboxs')->find($next_mail_id);
        $prev_mail_id = MailLog::where('id', '<', $mail->id)->where('user_id', Auth::user()->id)->max('id');
        $prev_mail = MailLog::with('users')->with('mailboxs')->find($prev_mail_id);


        //Detect mobile
        if ($this->agent->isMobile()) {
            return view('mobile.mails.mail_detail', compact('mail', 'next_mail', 'prev_mail'));

        }

        return view('main.mails.mail_detail', compact('mail', 'next_mail', 'prev_mail'));
    }

    public function sent_detail($id)
    {
        $mail = Mailbox::with('users')->findOrFail($id);

        if ($mail->from != Auth::user()->id) {
            return response()->view('errors.503', [], 503);
        }

        $next_mail_id = Mailbox::where('id', '>', $mail->id)->where('from', Auth::user()->id)->min('id');
        $next_mail = Mailbox::with('users')->find($next_mail_id);
        $prev_mail_id = Mailbox::where('id', '<', $mail->id)->where('from', Auth::user()->id)->max('id');
        $prev_mail = Mailbox::with('users')->find($prev_mail_id);

        //Detect mobile
        if ($this->agent->isMobile()) {
            return view('mobile.mails.mail_sent_detail', compact('mail', 'next_mail', 'prev_mail'));

        }

        return view('main.mails.mail_sent_detail', compact('mail', 'next_mail', 'prev_mail'));
    }

}
