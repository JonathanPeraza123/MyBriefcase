<?php

namespace Tests\Feature\Projects;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_users_can_not_update_project()
    {
        $project = Project::factory()->create();

        $url = route('projects.update', $project->getRouteKey());

        $response = $this->putJson($url);

        $this->assertDatabaseHas('projects', [
            'name' => $project->name
        ]);

        $response->assertStatus(401);
    }

    /** @test */
    public function an_authenticated_user_cannot_update_projects_thier_others()
    {
        $project = Project::factory()->create();

        $this->actingAs(User::factory()->create());

        $url = route('projects.update', $project->getRouteKey());

        $response = $this->putJson($url);

        $this->assertDatabaseHas('projects', [
            'name' => $project->name
        ]);

        $response->assertStatus(403);
    }

    /** @test */
    public function authenticated_users_can_update_thier_projects()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user);

        $url = route('projects.update', $project->getRouteKey());

        $response = $this->putJson($url, ['name' => 'primer proyecto'])->assertSuccessful();

        $this->assertDatabaseHas('projects', [
            'name' => 'primer proyecto'
        ]);
    }
}
