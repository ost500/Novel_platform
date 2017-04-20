<?php

namespace App\Events;

use App\Favorite;
use App\NewSpeed;
use App\NewSpeedLog;
use App\User;
use Auth;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Collection;
use Log;
use PhpParser\Node\Expr\Variable;

class NewSpeedEvent
{
    use InteractsWithSockets, SerializesModels;

    protected $type, $title, $link, $image, $novel_group_id, $toWhom;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($type, $title, $link, $image, $novel_group_id = null, $toWhom = null)
    {
        // sample code to use this event
        // event(new NewSpeedEvent("novel", "소설 '" . $new_novel->novel_groups->title . "'의 " . $new_novel->inning . "회 신규 회차가 등록 되었습니다.", "link", $new_novel->novel_groups->cover_photo, $new_novel->novel_groups->id));
        $this->type = $type;
        $this->title = $title;
        $this->link = $link;
        $this->image = $image;
        $this->novel_group_id = $novel_group_id;
        $this->toWhom = $toWhom;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {

        // Guess who will receive this new_speed


        if ($this->type == "novel") {

            $this->toWhom = Favorite::select(['favorites.user_id'])
                ->join('novel_groups', 'novel_groups.id', '=', 'favorites.novel_group_id')
                ->where(['novel_groups.user_id' => Auth::User()->id])
                ->distinct('user_id')->get();


        } elseif ($this->type == "noti") {

            $this->toWhom = User::select('id as user_id')->get();

        } elseif ($this->type == "new_novel_group") {

            $this->toWhom = Auth::user()->novel_groups()
                ->join('favorites', 'favorites.novel_group_id', '=', 'novel_groups.id')
                ->select('favorites.user_id')->get();

        } elseif ($this->type == "gift") {
            $this->toWhom = User::where('id', $this->toWhom)->select('id as user_id')->get();
        }


        $newSpeed = new NewSpeed();
        $newSpeed->user_id = Auth::user()->id;
        $newSpeed->title = $this->title;
        $newSpeed->link = $this->link;
        $newSpeed->image = $this->image;
        $newSpeed->save();


        foreach ($this->toWhom as $whom) {
            $new = new NewSpeedLog();
            $new->user_id = $whom->user_id;
            $new->new_speed_id = $newSpeed->id;
            $new->read = false;
            $new->save();
        }

        return response()->json($this->toWhom);


//        return new PrivateChannel('channel-name');
    }
}
