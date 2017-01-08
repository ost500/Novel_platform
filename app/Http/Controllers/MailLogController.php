<?php

namespace App\Http\Controllers;

use App\Mailbox;
use App\MailLog;
use Illuminate\Http\Request;

class MailLogController extends Controller
{
    public function destroy($id){

        MailLog::where('mailbox_id',$id)->where('read',null)->delete();

        flash("삭제 되었습니다");
        return response()->json("ok");
    }
}
