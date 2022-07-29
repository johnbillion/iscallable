<?php

declare(strict_types=1);

namespace SzepeViktor\PHPStan\WordPress\Tests;

function my_callback( $value ) {}

// Closure works ok
\add_filter('filter', function() {});

// Namespaced procedural function does not work
\add_filter('filter', __NAMESPACE__ . '\\my_callback');

// Global function works ok
\add_filter('filter', 'intval');

class foo {
	public function bar() {}
}

$foo = new foo();

// Class method does not work
\add_filter('filter', [$foo, 'bar']);

// Class method does not work
\add_filter('filter', [new foo(), 'bar']);

// Arrow function works ok
\add_filter('filter', fn() => 'Hello');
