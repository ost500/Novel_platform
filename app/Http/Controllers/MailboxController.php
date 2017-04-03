<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use App\Favorite;
use App\Mailbox;
use App\MailLog;
use App\NovelGroup;
use Auth;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
class MailboxController extends Controller
{
    var $agent;
    public function __construct()
    {
        $this->middleware('auth');
        $this->agent = new Agent();
    }


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


        $input = $request->all();
        $new_mail = $request->user()->mailbox()->create($input);
        $new_mail->novel_group_id = $request->novel_group_id;

        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $original_filename = $attachment->getClientOriginalName();
            //dd($mails->id);
            $filename = $new_mail->id . $original_filename;
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
        flash("쪽지가 보내졌습니다");

        if (Auth::user()->name == "Admin") {
            return redirect()->route('admin.memo');
        }

        return redirect()->route('author.mailbox_send_message', ['id' => $new_mail->id]);
    }

    public function store_specific_mail(Request $request)
    {

        //dd($request->all());
        Validator::make($request->all(), [
            'to' => 'required|email',
            'subject' => 'required|max:255',
            'body' => 'required',
            'attachment' => 'mimes:jpeg,png,gif|max:5024',
        ],
            [
                'to.required' => '작품선택 필수 입니다.',
                'to.email' => '이메일 형식이 유효하지 않습니다.',
                'subject.required' => '제목은 필수 입니다.',
                'subject.max' => '제목은 반드시 255 자리보다 작아야 합니다.',
                'body.required' => '내용은 필수 입니다.',
                'attachment.mimes' => '첨부파일은 반드시 다음의 파일 타입이어야 합니다: jpeg, png.',
                'attachment.max' => '표지1 용량은 5M를 넘지 않아야 합니다',
            ]
        )->validate();

        //if mail sending is blocked then redirect back
        if (Auth::user()->isMailBlocked()) {
            $errors= '쪽지 보내기 기능이 관리자에 의해 금지 됐습니다';

            return redirect()->route('mails.create')->withErrors($errors);
        }

        $input = $request->all();
        $check_user_exist = User::where('email', '=', $request->get('to'))->first();
        //if email does not exist return with an error
        if ($check_user_exist == null) {
            $errors = '해당 이메일 주소의 사용자를 찾을 수 없습니다.';
            if ($request->get('redirect')) {

                return redirect()->route('mails.create')->withErrors($errors);
            }

            return redirect()->route('author.specific_mail')->withErrors($errors);
        }

        $new_mail = $request->user()->mailbox()->create($input);

        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $original_filename = $attachment->getClientOriginalName();
            //dd($mails->id);
            $filename = $new_mail->id . $original_filename;
            //set file name for database
            $new_mail->attachment = $filename;
            //upload file to destination path
            $destinationPath = public_path('/img/mail_attachments/');
            $attachment->move($destinationPath, $filename);
        }
        $new_mail->save();

        $user = User::where('email', $request->to)->pluck('id');


        $new_mail_log = new MailLog();
        $new_mail_log->user_id = $user[0];
        $new_mail_log->mailbox_id = $new_mail->id;
        $new_mail_log->novel_group_id = $new_mail->novel_group_id;
        $new_mail_log->save();

        //Response
        flash("쪽지를 성공적으로 보냈습니다.", 'success');

        if (Auth::user()->name == "Admin") {

            if($this->agent->isMobile()){
                return redirect()->route('mails.sent');
            }
            return redirect()->route('admin.memo');
        }

        //
        if ($request->get('redirect')) {

            return redirect()->route('mails.sent');
        }

        return redirect()->route('author.mailbox_send_message', ['id' => $new_mail->id]);
    }

    public function destroy(Request $request)
    {

        $ids = $request->get('ids');
        MailLog::destroy($ids);
        flash("삭제 되었습니다");
        return response()->json("ok");
    }

    public function destroy_sent($id)
    {

        $maillogs = MailLog::where('mailbox_id', $id)->get();
        if (count($maillogs) > 0) {
            return response()->json(['error' => 1, 'message' => '이미 읽거나 보내진 쪽지는 삭제할 수 없습니다.', 'status' => "401"]);
        } else {
            Mailbox::destroy($id);
            flash("삭제 되었습니다");
            return response()->json(['error' => 0, 'message' => 'success', 'status' => "200"]);
        }
    }

    public function destroy_sent_bulk(Request $request)
    {
        $ids = $request->get('ids');
        foreach ($ids as $id) {
            $maillogs = MailLog::where('mailbox_id', $id)->with('mailboxs')->get();

            if (count($maillogs) > 0) {
                flash($maillogs[0]->mailboxs->subject . "이미 읽거나 보내진 쪽지는 삭제할 수 없습니다.", "danger");
                \Session::now('mail_id', $id);
                return response()->json(['error' => 1, 'message' => 'fail', 'status' => "401"]);
            }

            Mailbox::destroy($id);
        }
        flash("삭제 되었습니다");
        return response()->json(['error' => 0, 'message' => 'success', 'status' => "200"]);
    }

}
