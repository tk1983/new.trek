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
        $user = factory(User::class, 1)->create()->first();
        $user_id = $user->id;

        $response = $this->get(route('users.show', ['user_id' => $user_id]));

        $response->assertStatus(200)
            ->assertViewIs('users.index');
    }
}
