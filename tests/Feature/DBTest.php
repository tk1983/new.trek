<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Schema;
use Artisan;

class DBTest extends TestCase
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
    public function testTreksDB()
    {
        $this->assertTrue(
            Schema::hasColumns('treks', [
                'id', 'name', 'area', 'difficulty', 'address', 'days', 'comment', 'user_id', 'image_url', 'created_at', "updated_at"
            ]),
            1
        );
    }
    public function testUsersDB()
    {
        $this->assertTrue(
            Schema::hasColumns('users', [
                'id', 'name', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', "updated_at"
            ]),
            1
        );
    }
    public function testLikesDB()
    {
        $this->assertTrue(
            Schema::hasColumns('likes', [
                'id', 'user_id', 'trek_id', 'created_at', "updated_at"
            ]),
            1
        );
    }
    public function testCommentsDB()
    {
        $this->assertTrue(
            Schema::hasColumns('comments', [
                'id', 'trek_id', 'comment', 'user_id', 'created_at', "updated_at"
            ]),
            1
        );
    }
}
