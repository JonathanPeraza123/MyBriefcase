<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->paragraphs(1, true),
            'twitter' => '@default',
            'user_id' => User::factory()->create()
        ];
    }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'descrption' => 'default',
                'twitter' => 'default',
                'user_id' => null,
            ];
        });
    }
}
