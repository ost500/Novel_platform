<?php

namespace App\Http\Controllers;

use App\Mailbox;
use App\MailLog;
use App\PublishNovel;
use Illuminate\Http\Request;

class PublishNovelController extends Controller
{
    public function store(Request $request)
    {
        //store publish novel
        PublishNovel::create($request->all());

        //get novels count
        $novels_count = \App\Novel::where('novel_group_id', $request->publish_novel_group_id)->count('id');
        //get publish novels count
        $publish_novels_count = \App\PublishNovel::where(['publish_novel_group_id'=>$request->publish_novel_group_id,'company_id'=>$request->company_id])->count();

        //if count is same means all novels are published and return false to remove group
        if ($publish_novels_count == $novels_count) {

            $group_display= false;
        }else{ $group_display= true; }


        return response()->json(['status'=>'ok','group_display'=>$group_display]);

    }



    public function update(Request $request, $id)
    {
        $publish_novel = PublishNovel::find($id);
        $publish_novel->status = $request->status;
        if ($request->deny_reason) {
            //if deny_reason exists
            $publish_novel->reject_reason = $request->deny_reason;

            //mail
            $mailbox = new Mailbox();
            $mailbox->subject = $publish_novel->publish_novel_groups->novel_groups->title .
                "의 " . $publish_novel->novels->inning . "화 가 연재 거부 됐습니다";
            $mailbox->body = $publish_novel->publish_novel_groups->novel_groups->title .
                "의 " . $publish_novel->novels->inning . "화 " . $publish_novel->novels->title . "가 연재 거부 됐습니다.\n"
                . "거부 사유 \n" . $publish_novel->reject_reason;
            $mailbox->from = 1;
            $mailbox->save();

            $maillog = new MailLog();
            $maillog->user_id = $publish_novel->publish_novel_groups->user_id;
            $maillog->mailbox_id = $mailbox->id;
            $maillog->save();

        }


        $publish_novel->save();
        return response()->json(['data' => $request->status, 'status' => 'ok']);
    }



}
