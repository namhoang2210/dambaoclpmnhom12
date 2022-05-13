<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    /**
     * Test User can view login.
     *
     * @return void
     */
    public function testUserCanViewLogin()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertViewIs('auth.login')->assertSee('HVCNBCVT - Đăng nhập');
    }
 /**
     * Test User can view reset password.
     *
     * @return void
     */
    public function testUserCanViewPassWordReset()
    {
        $response = $this->get('/password/reset');
        $response->assertStatus(200);
        $response->assertViewIs('auth.passwords.email')->assertSee('HVCNBCVT - Quên mật khẩu');
    }

     /**
     * Test User can login.
     *
     * @return void
     */
    public function testCanLogin()
    {
        $this->assertGuest();
        $user = factory(User::class)->make();
    
        $this->actingAs($user)
            ->post('/login', ['email' => $user->email, 'password' => $user->password, 'name' => $user->name])
            ->assertStatus(302)
            ->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }
}    
