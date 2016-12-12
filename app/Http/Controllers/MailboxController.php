<?php

namespace App\Http\Controllers;

use Validator;
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


        Validator::make($request->all(), [
            'novel_group_id' => 'required',
            'subject' => 'required|max:255',
            'body' => 'required',
        ],
            [
                'novel_group_id.required' => '작품선택 필수 입니다.',
                'subject.required' => '제목은 필수 입니다.',
                'subject.max' => '제목은 반드시 255 자리보다 작아야 합니다.',
                'body.required' => '내용은 필수 입니다.',
            ]
        )->validate();


        $new_mail = new Mailbox();
        $new_mail->from = Auth::user()->id;
        $new_mail->novel_group_id = $request->novel_group_id;
        $new_mail->subject = $request->subject;
        $new_mail->body = $request->body;

        $new_mail->save();

        $favorites = Favorite::where('novel_group_id', $request->novel_group_id)->pluck('user_id');

        foreach ($favorites as $favorite) {
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
