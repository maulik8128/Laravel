<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * ///only one SeederTable  php artisan db:seed --class=UserSeeder,
     */
    public function run()
    {
        $userCount = max((int)$this->command->ask('How many users would  you like?',20),1);
        \App\Models\User::factory()->newUser()->create();
        \App\Models\User::factory($userCount)->make()->each(function($user) use($userCount){
            $user->parent_id = random_int(0,$userCount);
            $user->save();
        });

    }
}
