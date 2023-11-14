<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InventoryTest extends TestCase
{
    public function test_the_category_listing_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_the_suppliers_listing_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_the_items_listing_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_the_receivings_listing_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
