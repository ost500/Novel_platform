<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Mailbox;
use App\MailLog;
use App\NovelGroup;
use Auth;
use Illuminate\Http\Request;

class MailboxController extends Controller
{
    public function store(Request $request)
    {
        $new_mail = new Mailbox();
        $new_mail->from = Auth::user()->id;
        $new_mail->novel_group_id = $request->novel_group_id;
        $new_mail->subject = $request->subject;
        $new_mail->body = $request->body;

        $new_mail->save();

        $favorites = Favorite::where('novel_group_id', $request->novel_group_id)->pluck('user_id');

        foreach($favorites as $favorite)
        {
            $new_mail_log = new MailLog();
            $new_mail_log->user_id = $favorite;
            $new_mail_log->mailbox_id = $new_mail->id;
            $new_mail_log->novel_group_id = $new_mail->novel_group_id;
            $new_mail_log->save();
        }


//        $new_mail_log->n


        return redirect()->route('author.mailbox_send_message', ['id' => $new_mail->id]);
    }
}
