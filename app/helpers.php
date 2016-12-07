<?php

function flash($message, $level = 'info')
{

    Session::flash('flash_message', $message);
    Session::flash('flash_message_level', $level);
}


function get_groupComment_count($novel_group_id)
{

    $novels = \App\Novel::where('novel_group_id', $novel_group_id)->with('comments')->get();
    $comment_count = 0;
    foreach ($novels->comments as $comment) {
        $comment_count++;
    }
   return $comment_count;
}