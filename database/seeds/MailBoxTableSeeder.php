<?php

use Illuminate\Database\Seeder;

class MailBoxTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::get();

        //Mailbox table
        
        $users->each(function ($user) {
            $user->mailbox()->save(factory(App\Mailbox::class)->make());
        });

        $this->command->info('Mails table seeded');

        //Mailbox table

        $users->each(function ($user) {
            $user->mailbox()->save(factory(App\Mailbox::class)->make());
        });

        $this->command->info('Mails table seeded');

    }
}
