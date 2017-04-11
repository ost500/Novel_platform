<?php

use Illuminate\Database\Seeder;

class ServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'name' => 'Admin',
            'email' => 'ost5253@gmail.com',
        ]);
        $new_config = new \App\Configuration();
        $new_config->config_name = "commission";
        $new_config->config_value = "20";
        $new_config->save();
    }
}
