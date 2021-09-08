<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Project;
use App\Models\User;
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
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        $user3 = User::factory()->create();

        Project::factory()->count(3)->create([
            'user_id' => $user->id,
        ]);

        Profile::factory()->create([
            'user_id' => $user->id,
        ]);


        Project::factory()->count(3)->create([
            'user_id' => $user2->id,
        ]);

        $profile2 = Profile::factory()->create([
            'user_id' => $user2->id,
        ]);


        Project::factory()->count(3)->create([
            'user_id' => $user3->id,
        ]);

        Profile::factory()->create([
            'user_id' => $user3->id,
        ]);
    }
}
