<?php

namespace Database\Factories;

use App\Models\Images;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImagesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Images::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'images' => 'https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg',
            'project_id' => Project::factory()->create()
        ];
    }
}
