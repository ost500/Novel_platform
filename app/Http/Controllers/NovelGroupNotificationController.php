<?php

namespace App\Http\Controllers;

use App\NovelGroupNotification;
use Illuminate\Http\Request;
use Auth;

class NovelGroupNotificationController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Get all notifications ids to be deleted of a author
        $author_notifications = NovelGroupNotification::join('novel_groups', 'novel_groups.id', '=', 'novel_group_notifications.novel_group_id')
            ->where(['novel_group_notifications.user_id' => Auth::User()->id, 'novel_groups.user_id' => $id])->pluck('novel_group_notifications.id');

        foreach($author_notifications as $author_notification){
           NovelGroupNotification::where('id',$author_notification)->delete();
        }

        return response()->json(['error' => 0, 'message' => '삭제 되었습니다.']);
    }
}
