<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\User::factory(10)->create();

        if($this->command->confirm('Do you want to refresh tha database?')){
            $this->command->call('migrate:refresh');
            $this->command->info('Database was refreshed');
        }
        $this->call([
            UsersSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            CategorySeeder::class

            ////composer dump-autoload
        ]);
        $this->command->call('passport:client',['--personal'=>'test']);

    }
}
