<?php

namespace Tests\Feature\Projects;

use App\Models\Profile;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListProjectsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fetch_all_projects()
    {
        $user = User::factory()->create();
        Profile::factory()->create([
            'user_id' => $user->id,
        ]);

        $project1 = Project::factory()->create([
            'created_at' => now()->subDays(4),
            'user_id' => $user->id
        ]);
        $project2 = Project::factory()->create([
            'created_at' => now()->subDays(3),
            'user_id' => $user->id
        ]);
        $project3 = Project::factory()->create([
            'created_at' => now()->subDays(2),
            'user_id' => $user->id
        ]);
        $project4 = Project::factory()->create([
            'created_at' => now()->subDays(1),
            'user_id' => $user->id
        ]);

        $url = route('projects.index');

        $response = $this->getJson($url)->assertSuccessful();

        // $response->assertJsonCount(4);

        $response->assertSeeInOrder([
            $project4->name,
            $project3->name,
            $project2->name,
            $project1->name,
        ]);
    }

    /** @test */
    public function can_fetch_the_projects_in_the_user_auth()
    {
        $user = User::factory()->create();

        Profile::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user);

        $project1 = Project::factory()->create(['user_id' => $user->id]);
        $project2 = Project::factory()->create(['user_id' => $user->id]);
        $project3 = Project::factory()->create(['user_id' => $user->id]);
        $project4 = Project::factory()->create(['user_id' => $user->id]);
        $project5 = Project::factory()->create();



        $url = route('projects.profile');


        $response = $this->getJson($url)->assertSuccessful();

        $response->assertSee($project1->name)
            ->assertSee($project2->name)
            ->assertSee($project3->name)
            ->assertSee($project4->name)
            ->assertDontSee($project5->name);
    }
}
