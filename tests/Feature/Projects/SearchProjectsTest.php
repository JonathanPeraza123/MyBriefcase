<?php

namespace Tests\Feature\Projects;

use Tests\TestCase;
use App\Models\User;
use App\Models\Profile;
use App\Models\Project;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchProjectsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_search_projects_by_name()
    {
        $this->withExceptionHandling();

        $user = User::factory()->create();
        Profile::factory()->create([
            'user_id' => $user->id,
        ]);

        Project::factory()->create([
            'name' => 'Laravel',
            'user_id' => $user->id
        ]);
        Project::factory()->create([
            'name' => 'Other name',
            'user_id' => $user->id
        ]);
        Project::factory()->create([
            'name' => 'Laravel 2',
            'user_id' => $user->id
        ]);


        $url = route('projects.index', ['search' => 'laravel']);
        $response = $this->getJson($url)
            ->assertSee('Laravel')
            ->assertSee('Laravel 2')
            ->assertDontSee('Other name');

        $response->assertJsonCount(2, 'data');
    }

    /** @test */
    public function can_search_articles_by_name_whit_multiple_terms()
    {
        $this->withExceptionHandling();

        $user = User::factory()->create();
        Profile::factory()->create([
            'user_id' => $user->id,
        ]);

        Project::factory()->create([
            'name' => 'Laravel Project',
            'user_id' => $user->id
        ]);
        Project::factory()->create([
            'name' => 'Other name',
            'user_id' => $user->id
        ]);
        Project::factory()->create([
            'name' => 'Laravel project whit vue js',
            'user_id' => $user->id
        ]);


        $url = route('projects.index', ['search' => 'laravel']);
        $response = $this->getJson($url)
            ->assertSee('Laravel Project')
            ->assertSee('Laravel project whit vue js')
            ->assertDontSee('Other name');

        $response->assertJsonCount(2, 'data');
    }
}
