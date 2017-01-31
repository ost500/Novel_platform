<?php

namespace App\Events;

use App\Favorite;
use App\NewSpeed;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

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
        $new = new NewSpeed();

        if ($this->type == "novel") {

            $toWhom = Favorite::where('novel_group_id', $this->novel_group_id)->get();

            foreach ($toWhom as $whom) {
                $new->user_id = $whom->user_id;
                $new->title = $this->title;
                $new->link = $this->link;
                $new->image = $this->image;
                $new->read = false;
            }
        } elseif ($this->type == "noti") {

            $users = User::get();

            foreach ($users as $user) {
                $new->user_id = $user->user_id;
                $new->title = $this->title;
                $new->link = $this->link;
                $new->image = $this->image;
                $new->read = false;
            }
        }
        $new->save();


//        return new PrivateChannel('channel-name');
    }
}
