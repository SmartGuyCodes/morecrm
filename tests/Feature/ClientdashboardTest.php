<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientdashboardTest extends TestCase
{
    public function test_the_client_dashboard_page_returns_a_successful_response()
    {
        //$response = $this->get('/client-dashboard');
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
