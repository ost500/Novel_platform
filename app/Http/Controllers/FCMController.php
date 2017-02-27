<?php

namespace App\Http\Controllers;

use App\FCM;
use Illuminate\Http\Request;

class FCMController extends Controller
{


    public function token(Request $request)
    {
        if (isset($request->Token)) {
            $token = $request->Token;
            $newFCM_Token = new FCM();
            $newFCM_Token->Token = $token;
            $newFCM_Token->save();
        }
    }

    function send_notification($tokens, $message)
    {
        $server_key = "AAAAlmbUELo:APA91bHSSZND_SdAqbGvtbUYvoBU_6b9dy3AfD8dXkrbNalwM24I0N49R4QCDTk0oigy8AFzc5PfOAk_Qyld9EDFEEJfspGuYn3qv_nJEDi7ekiZRpBtgTp-FkggSNr7MJncdMORLSTs";

        $url = 'https://fcm.googleapis.com/fcm/send';

        $notification["body"] = $message["message"];
        $notification["title"] = "여우정원";



        $fields = array(
            'registration_ids' => $tokens,
            'data' => $notification,
//            'notification' => $notification
        );



        $headers = array(
            'Authorization:key =' . $server_key,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }


    public function notification(Request $request)
    {


        $FCMs = FCM::get();

        $tokens = array();

        foreach ($FCMs as $FCM) {
            $tokens[] = $FCM->Token;
        }



        $message = $request->message;
        if ($message == "") {
            $message = "새글이 등록되었습니다.";
        }

        $message = array("message" => $message);
        $message_status = $this->send_notification($tokens, $message);
        echo $message_status;


    }


}
