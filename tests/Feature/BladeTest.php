<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Trek;
use App\User;
use Illuminate\Support\Facades\Auth;

class BladeTest extends TestCase
{
    public function testTrekIndex()
    {
        $response = $this->get(route('detail.index'));

        $response->assertStatus(200)
            ->assertViewIs('detail');
    }
    public function testTrekDetail()
    {
        factory(Trek::class, 1)->create();

        $response = $this->get('/mountain/1');

        $response->assertStatus(200)
            ->assertViewIs('mountain');
    }
    public function testTrekCreate()
    {
        $response = $this->get(route('detail.new'));

        $response->assertStatus(302)
            ->assertRedirect('/login');
    }
    public function testHome()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(302)
            ->assertRedirect('/login');
    }
    /**
     *public function testLogin()
     *{
     *    factory(User::class, 1)->create();
     *
     *    $response = $this->get('/login');
     *
     *    $response->assertStatus(200)
     *        ->assertViewIs('auth.login');
     *}
     */
    public function testRegister()
    {
        $response = $this->get('/register');

        $response->assertStatus(200)
            ->assertViewIs('auth.register');
    }
    public function testRootRedirect()
    {
        $response = $this->get('/');

        $response->assertRedirect(route('detail.index'));
    }
}
