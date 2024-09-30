<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TemplateControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_home_view()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('pages.home');
    }

    public function test_index1_returns_about_view()
    {
        $response = $this->get('/about');

        $response->assertStatus(200);
        $response->assertViewIs('pages.about');
    }

    public function test_index2_returns_service_view()
    {
        $response = $this->get('/service');

        $response->assertStatus(200);
        $response->assertViewIs('pages.service');
    }

    public function test_index3_returns_contact_view()
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);
        $response->assertViewIs('pages.contact');
    }

    public function test_index4_returns_products_view()
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertViewIs('pages.products');
    }
}
