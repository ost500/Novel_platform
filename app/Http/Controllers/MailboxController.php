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
            'attachment' => 'mimes:jpeg,png|max:1024',
        ],
            [
                'novel_group_id.required' => '작품선택 필수 입니다.',
                'subject.required' => '제목은 필수 입니다.',
                'subject.max' => '제목은 반드시 255 자리보다 작아야 합니다.',
                'body.required' => '내용은 필수 입니다.',
                'attachment.mimes' => '첨부파일은 반드시 다음의 파일 타입이어야 합니다: jpeg, png.',
                'attachment.max' => '표지1 용량은 1M를 넘지 않아야 합니다',

            ]
        )->validate();


        $input=$request->all();
        $new_mail=  $new_novel_group = $request->user()->mailbox()->create($input);

        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $original_filename = $attachment->getClientOriginalName();
            //dd($mail->id);
            $filename =$new_mail->id.$original_filename;
            //set file name for database
            $new_mail->attachment = $filename;
            //upload file to destination path
            $destinationPath = public_path('/img/mail_attachments/');
            $attachment->move($destinationPath, $filename);
        }
        $new_mail->save();

        $favorites = Favorite::where('novel_group_id', $request->novel_group_id)->pluck('user_id');

        foreach ($favorites as $favorite) {
            $new_mail_log = new MailLog();
            $new_mail_log->user_id = $favorite;
            $new_mail_log->mailbox_id = $new_mail->id;
            $new_mail_log->novel_group_id = $new_mail->novel_group_id;
            $new_mail_log->save();
        }


//        $new_mail_log->
        flash("Mail created.");

        if (Auth::user()->name == "Admin") {
            return redirect()->route('admin.memo');
        }

        return redirect()->route('author.mailbox_send_message', ['id' => $new_mail->id]);
    }
}
