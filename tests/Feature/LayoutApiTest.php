<?php

namespace Tests\Feature;

use Tests\TestCase;

class LayoutApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_list_layouts(): void
    {
        $response = $this->getJson('/api/cms/layouts');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'container' => [
                        'name',
                        'template',
                    ],
                    'full-width',
                ],
            ]);

        $this->assertArrayHasKey('container', $response->json('data'));
        $this->assertIsString($response->json('data.container.name'));
        $this->assertEquals('blade-ui::layouts.container', $response->json('data.container.template'));
    }
}

