<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    public function testUsers()
    {
        $response = $this->get('/users/1');

        $response->assertStatus(200)
            ->assertViewIs('users.index');
    }
}
