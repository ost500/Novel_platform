<?php

function flash($message,$level='info'){

    Session::flash('flash_message',$message);
    Session::flash('flash_message_level',$level);
}
