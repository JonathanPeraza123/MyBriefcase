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
            'description' => 'Esta es una descripcion corta de mi proyecto',
            'slug' => 'mi-primer-proyecto',
            'repository' => 'https://github.com/JonathanPeraza123/MyBriefcase',
            'link' => 'https://github.com/JonathanPeraza123/MyBriefcase'
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
            'description' => 'Esta es una descripcion corta de mi proyecto',
            'slug' => 'mi-primer-proyecto',
            'repository' => 'https://github.com/JonathanPeraza123/MyBriefcase',
            'link' => 'https://github.com/JonathanPeraza123/MyBriefcase'
        ])->assertCreated();

        $response->assertJsonFragment([
            'name' => 'Mi primer projecto',
            'description' => 'Esta es una descripcion corta de mi proyecto',
            'slug' => 'mi-primer-proyecto',
            'repository' => 'https://github.com/JonathanPeraza123/MyBriefcase',
            'live_action' => 'https://github.com/JonathanPeraza123/MyBriefcase'
        ]);


        $this->assertDatabaseHas('projects', [
            'user_id' => $user->id,
            'name' => 'Mi primer projecto',
            'slug' => 'mi-primer-proyecto',
            'repository' => 'https://github.com/JonathanPeraza123/MyBriefcase',
            'link' => 'https://github.com/JonathanPeraza123/MyBriefcase'
        ]);
    }

    /** @test */
    public function slug_has_to_be_well_written()
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
            'description' => 'Esta es una descripcion corta de mi proyecto',
            'slug' => 'mi-primer-proyecto',
            'repository' => 'https://github.com/JonathanPeraza123/MyBriefcase',
            'link' => 'https://github.com/JonathanPeraza123/MyBriefcase'
        ])->assertCreated();

        $response->assertJsonFragment([
            'name' => 'Mi primer projecto',
            'description' => 'Esta es una descripcion corta de mi proyecto',
            'slug' => 'mi-primer-proyecto',
            'repository' => 'https://github.com/JonathanPeraza123/MyBriefcase',
            'live_action' => 'https://github.com/JonathanPeraza123/MyBriefcase'
        ]);


        $this->assertDatabaseHas('projects', [
            'user_id' => $user->id,
            'name' => 'Mi primer projecto',
            'slug' => 'mi-primer-proyecto',
            'repository' => 'https://github.com/JonathanPeraza123/MyBriefcase',
            'link' => 'https://github.com/JonathanPeraza123/MyBriefcase'
        ]);
    }
}
