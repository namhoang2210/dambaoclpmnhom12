<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * Test user can view register subject, schedule, exam schedule, profile, feedback.
     *
     * @return void
     */
    public function testUserCanViewOtherFunction()
    {
        $response = $this->get('/commingsoon');
        $response->assertStatus(200);
        $response->assertViewIs('pages.commingsoon')->assertSee('HVCNBCVT');
    }
}
