<?php

namespace App\Http\Controllers;

use App\Mailbox;
use App\MailLog;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class MailLogController extends Controller
{
    public function destroy($id)
    {

        MailLog::where('mailbox_id', $id)->where('read', null)->delete();

        flash("삭제 되었습니다");
        return response()->json("ok");
    }


    public function update(Request $request)
    {
        $ids = $request->get('ids');
        if ($request->get('type') == 'mybox') {
            $other_type = 'spam';
        } else {
            $other_type = 'mybox';
        }

        foreach ($ids as $id) {
            MailLog::where('id', $id)->update([
                $request->get('type') => 1,
                $other_type => 0
            ]);
        }

        flash("스팸쪽지함 되었습니다");

        if ($request->get('type') == 'mybox') {
            flash("보관쪽지함 되었습니다");
        }

        return response()->json("ok");
    }

    public function show()
    {
        $mails = Auth::user()->maillogs()
            ->with('mailboxs.users')
            ->where(['spam' => 0, 'mybox' => 0]);
        $received_mails = $mails
            ->latest()->take(5)->get();


        // unread count
        $mail_unread_count = $mails->where('read', null)->get()->count();


        return response()->json(['data' => $received_mails, 'count' => $mail_unread_count]);
    }
}
