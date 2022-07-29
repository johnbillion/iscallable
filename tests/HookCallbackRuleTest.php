<?php

declare(strict_types=1);

namespace SzepeViktor\PHPStan\WordPress\Tests;

use SzepeViktor\PHPStan\WordPress\HookCallbackRule;

class HookCallbackRuleTest extends \PHPStan\Testing\RuleTestCase
{
	protected function getRule(): \PHPStan\Rules\Rule
	{
		return new HookCallbackRule();
	}

	public function testRule(): void
	{
		$this->analyse(
			[
				__DIR__ . '/data/hook-callback.php',
			],
			[
				[
					'Callback is ok',
					10,
				],
				[
					'Callback is ok',
					13,
				],
				[
					'Callback is ok',
					16,
				],
				[
					'Callback is ok',
					25,
				],
				[
					'Callback is ok',
					28,
				],
				[
					'Callback is ok',
					31,
				],
			]
		);
	}
}
