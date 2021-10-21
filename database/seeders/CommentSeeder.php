<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $posts = \App\Models\Post::all();
        $users = \App\Models\User::all();

        if($posts->count() === 0 || $users->count() === 0)
        {
            $this->command->info('There are no posts or users, so no comments will be added');
        }

        $commentCount = (int)$this->command->ask('How many comments would you like?',150);

        \App\Models\Comment::factory($commentCount)->make()->each(function($comment) use($posts,$users){
            $comment->post_id = $posts->random()->id;
            $comment->user_id = $users->random()->id;
            $comment->save();
        });
    }
}
