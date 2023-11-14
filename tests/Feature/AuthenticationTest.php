<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    public function test_the_subscription_page_returns_a_successful_response()
    {
        $response = $this->get('/subscribe');

        $response->assertStatus(200);
    }
    public function test_the_subscription_verification_page_returns_a_successful_response()
    {
        $response = $this->get('/verify-subscription');

        $response->assertStatus(200);
    }
    public function test_the_login_page_returns_a_successful_response()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
    public function test_the_forget_password_page_returns_a_successful_response()
    {
        $response = $this->get('/forget-password');

        $response->assertStatus(200);
    }
}
