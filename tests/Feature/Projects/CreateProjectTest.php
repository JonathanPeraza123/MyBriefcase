<?php

namespace Tests\Feature\Projects;

use App\Models\Profile;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_users_can_not_create_project()
    {

        $response = $this->post(route('project.store'), [
            'name' => 'Mi primer projecto',
            'description' => 'Esta es una descripcion corta de mi proyecto'
        ]);

        $response->assertRedirect('login');
    }

    /** @test */
    public function an_authenticated_user_can_created_projects()
    {
        // $this->withExceptionHandling();
        $user = User::factory()->create();

        Profile::factory()->create([
            'user_id' => $user
        ]);

        $this->actingAs($user);

        $url = route('project.store');

        $response = $this->postJson($url, [
            'name' => 'Mi primer projecto',
            'description' => 'Esta es una descripcion corta de mi proyecto'
        ])->assertCreated();

        $response->assertJsonFragment([
            'name' => 'Mi primer projecto',
            'description' => 'Esta es una descripcion corta de mi proyecto'
        ]);


        $this->assertDatabaseHas('projects', [
            'user_id' => $user->id,
            'name' => 'Mi primer projecto'
        ]);
    }
}
