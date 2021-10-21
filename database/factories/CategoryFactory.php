<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(1),
            'status' => TRUE,
        ];
    }

    //blow state override
    public function parentCategory()
    {
        return $this->state(function(array $attributes){
            return [
                'title' => $this->faker->sentence(1),
                'parent_id'=>null,
            ];
        });
    }
}
