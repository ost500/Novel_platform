<?php

use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::get();

        $users->each(function ($user) {
            for ($i = 0; $i < 12; $i++) {
                $user->payments()->save(factory(App\Payment::class)->make());
                $user->pieces()->save(factory(App\Piece::class)->make());
                $user->presentsFrom()->save(factory(App\Present::class)->make());
                $user->presents()->save(factory(App\Present::class)->make());
                $user->purchasedNovels()->save(factory(App\PurchasedNovel::class)->make());
            }
        });
    }
}
