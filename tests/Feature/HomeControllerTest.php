<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Artisan;

class HomeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('optimize:clear');
        Artisan::call('route:clear');
    }
    public function testHome()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(302)
            ->assertRedirect('/login');
    }
    public function testLogin()
    {
        $response = $this->get('/login');

        $response->assertStatus(200)
            ->assertViewIs('auth.login');
    }
    public function testRegister()
    {
        $response = $this->get('/register');

        $response->assertStatus(200)
            ->assertViewIs('auth.register');
    }
}
