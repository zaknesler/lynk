<?php

namespace Tests\Feature;

use App\Link;
use Tests\TestCase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LinkTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_url_can_be_shortened_without_a_code()
    {
        $response = $this->post('/api/links', [
            'url' => 'https://example.com',
        ]);

        $response->assertSuccessful();
        $response->assertJsonStructure([
            'code',
            'original_url',
            'shortened_url',
        ]);

        $link = Link::first();
        $this->assertEquals(1, Link::count());
        $this->assertNotNull($link->code);
        $this->assertEquals('https://example.com', $link->url);
        $this->assertFalse($link->has_custom_code);
        $this->assertTrue(Cache::has('link.' . $link->code));
    }

    /** @test */
    function shortened_url_without_custom_code_redirects_to_original_url()
    {
        $response = $this->post('/api/links', [
            'url' => 'https://example.com',
        ]);

        $response->assertSuccessful();

        $response = $this->get('/' . Link::first()->code);

        $response->assertStatus(302);
        $response->assertRedirect('https://example.com');
    }

    /** @test */
    function a_url_can_be_shortened_with_a_code()
    {
        $response = $this->post('/api/links', [
            'url' => 'https://example.com',
            'code' => 'example',
        ]);

        $response->assertSuccessful();
        $response->assertJsonStructure([
            'code',
            'original_url',
            'shortened_url',
        ]);

        $link = Link::first();
        $this->assertEquals(1, Link::count());
        $this->assertNotNull($link->code);
        $this->assertEquals('https://example.com', $link->url);
        $this->assertTrue($link->has_custom_code);
        $this->assertTrue(Cache::has('link.' . $link->code));
    }

    /** @test */
    function shortened_url_with_custom_code_redirects_to_original_url()
    {
        $response = $this->post('/api/links', [
            'url' => 'https://example.com',
            'code' => 'example',
        ]);

        $response->assertSuccessful();

        $response = $this->get('/example');

        $response->assertStatus(302);
        $response->assertRedirect('https://example.com');
    }

    /** @test */
    function a_code_cannot_be_used_more_than_once()
    {
        $response = $this->post('/api/links', [
            'url' => 'https://example.com',
            'code' => 'example',
        ]);

        $response->assertSuccessful();
        $this->assertEquals(1, Link::count());

        $response = $this->post('/api/links', [
            'url' => 'https://another-url.com',
            'code' => 'example',
        ]);

        $response->assertSessionHasErrors([
            'code',
        ]);

        $this->assertEquals(1, Link::count());
    }

    /** @test */
    function url_must_be_valid()
    {
        $response = $this->post('/api/links', [
            'url' => 'invalid-url',
        ]);

        $response->assertSessionHasErrors([
            'url',
        ]);

        $this->assertEquals(0, Link::count());
    }
}
