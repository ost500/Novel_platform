<?php

namespace App\Events;

use App\Favorite;
use App\NewSpeed;
use App\User;
use Auth;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Log;
use PhpParser\Node\Expr\Variable;

class NewSpeedEvent
{
    use InteractsWithSockets, SerializesModels;

    protected $type, $title, $link, $image, $novel_group_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($type, $title, $link, $image, $novel_group_id = null)
    {
        // sample code to use this event
        // event(new NewSpeedEvent("novel", "소설 '" . $new_novel->novel_groups->title . "'의 " . $new_novel->inning . "회 신규 회차가 등록 되었습니다.", "link", $new_novel->novel_groups->cover_photo, $new_novel->novel_groups->id));
        $this->type = $type;
        $this->title = $title;
        $this->link = $link;
        $this->image = $image;
        $this->novel_group_id = $novel_group_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {


        // Guess who will receive this new_speed
        $toWhom = "";

        if ($this->type == "novel") {

            $toWhom = Favorite::where('novel_group_id', $this->novel_group_id)->get();

        } elseif ($this->type == "noti") {

            $toWhom = User::get();


        } elseif ($this->type == "new_novel_group") {

            $toWhom = Auth::user()->novel_groups()
                ->join('favorites', 'favorites.novel_group_id', '=', 'novel_groups.id')
                ->select('favorites.user_id')->get();

        }


        foreach ($toWhom as $whom) {
            $new = new NewSpeed();
            $new->user_id = $whom->user_id;
            $new->title = $this->title;
            $new->link = $this->link;
            $new->image = $this->image;
            $new->read = false;
            $new->save();
        }


//        return new PrivateChannel('channel-name');
    }
}
