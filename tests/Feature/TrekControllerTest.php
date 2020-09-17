<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Trek;
use App\User;
use Illuminate\Support\Facades\Auth;

class TrekControllerTest extends TestCase
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
    public function testTrekEdit()
    {
        factory(User::class, 1)->create();

        $response = $this->get('/mountain/edit/1');

        $response->assertStatus(302)
            ->assertRedirect('/login');
    }
    public function testTrekCreate()
    {
        $response = $this->get(route('detail.new'));

        $response->assertStatus(302)
            ->assertRedirect('/login');
    }
    public function testRootRedirect()
    {
        $response = $this->get('/');

        $response->assertRedirect(route('detail.index'));
    }
}
