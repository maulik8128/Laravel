<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::factory(10)->parentCategory()->create();
        $cat_parent = \App\Models\Category::where('parent_id','=',null)->get();

        if($cat_parent->count() === 0 )
        {
            $this->command->info('There are no Parent category , so no category will be added');
        }

        $CategoryCount = max((int)$this->command->ask('How many Category would you like?',50),1);

        \App\Models\Category::factory($CategoryCount)->make()->each(function($category){
            $cat = \App\Models\Category::all();
            $category->parent_id = $cat->random()->id;
            $category->save();
        });
    }
}
