<?php

namespace Tests\Feature\Profile;

use App\Models\Profile;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdadateProfileTest extends TestCase
{

    use RefreshDatabase;


    /** @test */
    public function a_guest_cannot_update_their_profile()
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create([
            'user_id' => $user->id
        ]);

        $url = route('update.profile', $profile->getRouteKey());

        $response = $this->putJson($url, ['description' => 'hola este es mi nuevo perfil']);

        $this->assertDatabaseMissing('profiles', [
            'description' => 'hola este es mi nuevo perfil'
        ]);

        $response->assertStatus(401);
    }

    /** @test */
    public function an_authenticated_user_cannot_update_anothers_profile()
    {
        $profile = Profile::factory()->create();

        $this->actingAs(User::factory()->create());

        $url = route('update.profile', $profile->getRouteKey());

        $response = $this->putJson($url, ['description' => 'hola este es mi nuevo perfil']);

        $this->assertDatabaseMissing('profiles', [
            'description' => 'hola este es mi nuevo perfil'
        ]);

        $response->assertStatus(403);
    }

    /** @test */
    public function an_authenticated_user_can_only_update_their_profile()
    {
        $user = User::factory()->create();
        $profile = Profile::factory()->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user);

        $url = route('update.profile', $profile->getRouteKey());

        $response = $this->putJson($url, [
            'name' => 'Jonathan Peraza',
            'description' => 'hola este es mi nuevo perfil'
        ])->assertSuccessful();

        $this->assertDatabaseHas('profiles', [
            'name' => 'Jonathan Peraza',
            'description' => 'hola este es mi nuevo perfil'
        ]);
    }
}
