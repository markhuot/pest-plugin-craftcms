<?php

declare(strict_types=1);

namespace Pest\CraftCms;

use Pest\Plugin;

Plugin::uses(TestCase::class, Http::class);


function get($uri = null): TestableResponse
{
    return test()->get($uri);
}

