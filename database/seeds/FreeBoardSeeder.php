<?php

use Illuminate\Database\Seeder;

class FreeBoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::get();

        foreach ($users as $user) {
            $free_board = $user->free_boards()->save(factory(App\FreeBoard::class)->make());
            $free_board->comments()->save(factory(App\FreeBoardComment::class)->make());
            $free_board->likes()->save(factory(App\FreeBoardLike::class)->make());
        }

    }
}
