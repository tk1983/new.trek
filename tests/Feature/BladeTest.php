<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BladeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testIndex1()
    {
        $response = $this->get(route('detail.index'));

        $response->assertStatus(200)
            ->assertViewIs('detail');
    }
    public function testIndex2()
    {
        $response = $this->get('/login');

        $response->assertStatus(200)
            ->assertViewIs('auth.login');
    }
    public function testIndex3()
    {
        $response = $this->get(route('detail.new'));

        $response->assertStatus(302)
            ->assertRedirect('/login');
    }
}
