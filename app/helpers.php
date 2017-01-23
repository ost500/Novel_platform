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

//Check whether novel for a particular company exists in the publish_novels table
function checkPublishNovel($novel_id, $publish_novel_group_id, $company_id)
{

    $novels = \App\PublishNovel::where(['novel_id' => $novel_id, 'publish_novel_group_id' => $publish_novel_group_id, 'company_id' => $company_id])->first();
    //if novel exists the return true to remove that novel from list
    if (!$novels) {
        return false;
    }
    return true;
}

//Check whether all novels of a particular group have published or not
function checkPublishNovelGroup($publish_novel_group_id, $company_id)
{

    //get novels count
    $novels_count = \App\Novel::where('novel_group_id', $publish_novel_group_id)->count('id');
    //get publish novels count
    $publish_novels_count = \App\PublishNovel::where(['publish_novel_group_id' => $publish_novel_group_id, 'company_id' => $company_id])->count();

    //if count is same means all novels are published and return false to remove group
    if ($publish_novels_count == $novels_count) {
        //echo $publish_novel_group_id.'-'.$company_id.',';
        return false;
    }
    return true;
}

function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => '년',
        'm' => '월',
        'w' => '주',
        'd' => '일',
        'h' => '시간',
        'i' => '분',
        's' => '초',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' 전' : '방금 전';
}