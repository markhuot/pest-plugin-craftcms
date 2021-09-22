<?php

declare(strict_types=1);

namespace Pest\CraftCms;

use Pest\Plugin;

Plugin::uses(TestCase::class, Http::class);

function setUpRequest($uri) {
    test()->setUri($uri);
}

function get($uri=null) {
    return test()->get($uri);
}

function setUri($uri) {
    return test()->setUri($uri);
}

function querySelector($selector) {
    return test()->get()->querySelector($selector);
}
