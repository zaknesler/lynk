<?php

use Lynk\Link;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LinkTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_creates_a_link_with_a_randomly_generated_code()
    {
        $this->json('POST', '/links', [
            'url' => 'https://example.com',
        ]);

        $this->seeStatusCode(200);

        $link = Link::where('url', 'https://example.com')->first();

        $this->assertNotNull($link->url);
        $this->assertNotNull($link->code);
        $this->assertFalse($link->has_custom_code);
    }

    /** @test */
    public function it_creates_a_link_with_a_custom_code()
    {
        $this->json('POST', '/links', [
            'url' => 'https://example.com',
            'code' => 'example',
        ]);

        $this->seeStatusCode(200);

        $link = Link::where('url', 'https://example.com')->first();

        $this->assertNotNull($link->url);
        $this->assertNotNull($link->code);
        $this->assertTrue($link->has_custom_code);
    }

    /** @test */
    public function it_creates_a_link_with_a_randomly_generated_code_from_a_code_that_is_just_spaces()
    {
        $this->json('POST', '/links', [
            'url' => 'https://example.com',
            'code' => '              ',
        ]);

        $this->seeStatusCode(200);

        $link = Link::where('url', 'https://example.com')->first();

        $this->assertNotNull($link->url);
        $this->assertNotNull($link->code);
        $this->assertFalse($link->has_custom_code);
    }

    /** @test */
    public function it_creates_a_link_with_a_randomly_generated_code_and_creates_another_with_the_same_url()
    {
        $this->json('POST', '/links', [
            'url' => 'https://example.com',
        ]);

        $this->seeStatusCode(200);

        $this->json('POST', '/links', [
            'url' => 'https://example.com',
        ]);

        $this->assertEquals(1, Link::count());
    }

    /** @test */
    public function it_creates_a_link_with_a_custom_code_that_already_exists()
    {
        $this->json('POST', '/links', [
            'url' => 'https://example.com',
            'code' => 'example',
        ]);

        $this->seeStatusCode(200);

        $this->json('POST', '/links', [
            'url' => 'https://example.com',
            'code' => 'example',
        ]);

        $this->seeStatusCode(422);

        $this->assertEquals(1, Link::count());
    }
}
