<?php

namespace App\Http\Controllers;

use App\Mailbox;
use App\MailLog;
use Illuminate\Http\Request;

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
}
