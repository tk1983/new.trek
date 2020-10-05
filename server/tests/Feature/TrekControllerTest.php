<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Trek;
use App\User;

class TrekControllerTest extends TestCase
{
    use RefreshDatabase;
    public function testTrekIndex()
    {
        $response = $this->get(route('detail.index'));
        $response->assertStatus(200)
            ->assertViewIs('detail');
    }
    public function testTrekDetail()
    {
        $trek = factory(Trek::class, 1)->create()->first();
        $id = $trek->id;

        $response = $this->get(route('detail.detail', ['id' => $id]));
        $response->assertStatus(200)
            ->assertViewIs('mountain');
    }
    public function testTrekEdit_nologin()
    {
        $trek = factory(Trek::class, 1)->create()->first();
        $id = $trek->id;
        factory(User::class, 1)->create();

        $response = $this->get(route('detail.edit', ['id' => $id]))
            ->assertRedirect('/login');
    }
    public function testTrekEdit_login()
    {
        $trek = factory(Trek::class, 1)->create()->first();
        $id = $trek->id;
        $user = factory(User::class, 1)->create()->first();

        $response = $this->actingAs($user)->get(route('detail.edit', ['id' => $id]));
        $response->assertStatus(200)
            ->assertViewIs('edit');
    }
    public function testTrekCreate_nologin()
    {
        $response = $this->get(route('detail.new'));

        $response->assertStatus(302)
            ->assertRedirect('/login');
    }
    public function testTrekCreate_login()
    {
        $user = factory(User::class, 1)->create()->first();

        $response = $this->actingAs($user)->get(route('detail.new'));
        $response->assertStatus(200)
            ->assertViewIs('new');
    }

    public function testRootRedirect()
    {
        $response = $this->get('/');

        $response->assertRedirect(route('detail.index'));
    }
}
