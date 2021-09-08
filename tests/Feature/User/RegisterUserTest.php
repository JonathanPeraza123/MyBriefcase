<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function users_can_register()
    {
        $userData = [
            'username' => 'JonathanPeraza',
            'name' => 'Jonathan Peraza',
            'email' => 'jonathan@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $this->post(route('register'), $userData);

        $this->assertDatabaseHas('users', [
            'username' => 'JonathanPeraza',
            'email' => 'jonathan@gmail.com',
        ]);

        $this->assertDatabaseHas('profiles', [
            'name' => 'Jonathan Peraza',
        ]);
    }
}
