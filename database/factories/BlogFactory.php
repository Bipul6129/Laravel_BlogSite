<?php

namespace Database\Factories;

use App\Models\blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = blog::class;
    public function definition(): array
    {   
        $userIds = User::pluck('id')->all();
        return [
            'title'=>$this->faker->sentence,
            'description'=>$this->faker->paragraph,
            'image'=>'blog_images/FzsIDtjtInqFTmoE1sPF.jpg ',
            'userId'=>$this->faker->randomElement($userIds)
        ];
    }
}
