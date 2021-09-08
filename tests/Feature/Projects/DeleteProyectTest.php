<?php

namespace Tests\Feature\Projects;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteProyectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_users_can_not_delete_project()
    {
        $project = Project::factory()->create();

        $url = route('projects.delete', $project->getRouteKey());
        // dd($url);

        $response = $this->deleteJson($url);

        $this->assertDatabaseHas('projects', [
            'name' => $project->name
        ]);

        $response->assertStatus(401);
    }

    /** @test */
    public function an_authenticated_user_cannot_delete_projects_thier_others()
    {
        $project = Project::factory()->create();

        $this->actingAs(User::factory()->create());

        $url = route('projects.delete', $project->getRouteKey());

        $response = $this->deleteJson($url);

        $this->assertDatabaseHas('projects', [
            'name' => $project->name
        ]);

        $response->assertStatus(403);
    }

    /** @test */
    public function authenticated_users_can_delete_thier_projects()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user);

        $url = route('projects.delete', $project->getRouteKey());

        $response = $this->deleteJson($url)->assertSuccessful();

        $this->assertDatabaseMissing('projects', [
            'name' => $project->name
        ]);
    }
}
