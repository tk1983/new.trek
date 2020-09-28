<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Trek;
use App\User;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    public function testUsers()
    {
        factory(Trek::class, 1)->create();
        factory(User::class, 1)->create();

        $response = $this->get('/users/1');

        $response->assertStatus(200)
            ->assertViewIs('users.index');
    }
}
