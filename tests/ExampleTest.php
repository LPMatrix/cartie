<?php

namespace Lpmatrix\Cartie\Tests;

use Orchestra\Testbench\TestCase;
use Lpmatrix\Cartie\CartieServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [CartieServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
