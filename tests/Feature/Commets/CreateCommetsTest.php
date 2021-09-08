<?php

namespace Tests\Feature\Commets;

use App\Models\Comment;
use App\Models\Profile;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateCommetsTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function users_can_see_all_comments()
    {
        $project = Project::factory()->create();
        Profile::factory()->create([
            'user_id' => $project->user_id
        ]);
        $coment1 = Comment::factory()->create([
            'project_id' => $project->id,
        ]);
        $coment2 = Comment::factory()->create([
            'project_id' => $project->id,
        ]);

        $project2 = Project::factory()->create();

        $coment3 = Comment::factory()->create([
            'project_id' => $project2->id,
        ]);

        $url = route('projects.comments.index', ['project' => $project->getRouteKey()]);

        $response = $this->getJson($url)
            ->assertSee([
                'body' => $coment1->body,
            ])->assertSee([
                'body' => $coment2->body,
            ])->assertDontSee([
                'body' => $coment3->body,
            ]);
    }





    /** @test */
    public function guest_users_cannot_create_comment_projects()
    {
        $project = Project::factory()->create();

        Profile::factory()->create([
            'user_id' => $project->user_id
        ]);

        $user = User::factory()->create();

        $url = route('projects.comments.store', ['project' => $project->getRouteKey()]);

        $response = $this->postJson($url, ['body' => 'Mi primer comentario'])->assertStatus(401);

        $this->assertDatabaseMissing('comments', [
            'user_id' => $user->id,
            'project_id' => $project->id,
            'body' => 'Mi primer comentario',
        ]);
    }

    /** @test */
    public function authenticated_users_can_comment_projects()
    {
        $project = Project::factory()->create();

        Profile::factory()->create([
            'user_id' => $project->user_id
        ]);

        $user = User::factory()->create();

        $this->actingAs($user);

        $url = route('projects.comments.store', ['project' => $project->getRouteKey()]);

        $response = $this->postJson($url, ['body' => 'Mi primer comentario']);

        $response->assertJsonFragment([
            'body' => 'Mi primer comentario',
        ]);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'project_id' => $project->id,
            'body' => 'Mi primer comentario',
        ]);
    }
}
