<?php

namespace App\Http\Controllers;

use App\Mailbox;
use Auth;
use Illuminate\Http\Request;

class MailboxController extends Controller
{
    public function store(Request $request)
    {
        $new_mail = new Mailbox();
        $new_mail->from = Auth::user()->id;
        $new_mail->nove_id = $request->novel_id;
        $new_mail->subject = $request->subject;
        $new_mail->body = $request->body;

        $new_mail->save();

        return redirect()->route('author.mailbox_message', ['id' => $new_mail->id]);
    }
}
