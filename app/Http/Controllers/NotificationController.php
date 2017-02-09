<?php

namespace App\Http\Controllers;

use App\Events\NewSpeedEvent;
use App\Notification;
use Illuminate\Http\Request;
use Validator;

class NotificationController extends Controller
{
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'category' => 'required|max:255',
            'title' => 'required|max:255',
            'content' => 'required',
        ], [
            'category.required' => '분류는 필수 입니다.',
            'category.max' => '분류는 반드시 255 자리보다 작아야 합니다.',
            'title.required' => '제목은 필수 입니다.',
            'title.max' => '제목은 반드시 255 자리보다 작아야 합니다.',
            'content.required' => '내용은 필수 입니다.',

        ])->validate();

        $input = $request->all();

        if ($request->popup == "on") {
            $input['popup'] = true;
        }

        $noti = Notification::create($input);

        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');

            $original_filename = $picture->getClientOriginalName();
            //dd($mails->id);
            $filename = $noti->id . $original_filename;
            //set file name for database
            $noti->picture = $filename;
            //upload file to destination path
            $destinationPath = public_path('/img/notification_pictures/');
            $picture->move($destinationPath, $filename);
        }

       $noti->save();
        event(new NewSpeedEvent("noti", "[공지사항] " . $noti->title, route('ask.notification_detail', ['id' => $noti->id]), "/front/imgs/thumb/memo3.png"));

        return redirect()->route('admin.notifications.detail', ['id' => $noti->id]);
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'category' => 'required|max:255',
            'title' => 'required|max:255',
            'content' => 'required',
        ], [
            'category.required' => '분류는 필수 입니다.',
            'category.max' => '분류는 반드시 255 자리보다 작아야 합니다.',
            'title.required' => '제목은 필수 입니다.',
            'title.max' => '제목은 반드시 255 자리보다 작아야 합니다.',
            'content.required' => '내용은 필수 입니다.',

        ])->validate();

        $noti = Notification::find($id);
        $noti->title = $request->title;
        $noti->category = $request->category;
        $noti->posting = $request->posting;
        $noti->content = $request->input('content');

        $noti->save();

        return redirect()->route('admin.notifications.detail', ['id' => $noti->id]);
    }
}
