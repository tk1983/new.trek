<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Trek;
use App\User;
use App\Like;

class LikeTest extends TestCase
{
    public function testLikedByNull()
    {
        factory(User::class, 1)->create();

        $Trek = factory(Trek::class)->create();
        $result = $Trek->LikedBy(null);

        $this->assertFalse($result);
    }
}
