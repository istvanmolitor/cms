<?php

namespace Molitor\Cms\Tests\Feature;

use Molitor\Cms\Providers\CmsServiceProvider;
use Tests\TestCase;

class PackageSmokeTest extends TestCase
{
    public function test_service_provider_is_loaded(): void
    {
        $this->assertTrue(class_exists(CmsServiceProvider::class));
        $this->assertTrue($this->app->providerIsLoaded(CmsServiceProvider::class));
    }
}

