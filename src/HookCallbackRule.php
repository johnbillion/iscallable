<?php

declare(strict_types=1);

namespace SzepeViktor\PHPStan\WordPress;

use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @implements \PHPStan\Rules\Rule<\PhpParser\Node\Expr\FuncCall>
 */
class HookCallbackRule implements \PHPStan\Rules\Rule
{
	public function getNodeType(): string
	{
		return FuncCall::class;
	}

	/**
	 * @param \PhpParser\Node\Expr\FuncCall $node
	 * @param \PHPStan\Analyser\Scope       $scope
	 * @return array<int, \PHPStan\Rules\RuleError>
	 */
	public function processNode(Node $node, Scope $scope): array
	{
		if (!($node->name instanceof \PhpParser\Node\Name)) {
			return [];
		}

		$callbackType = $scope->getType($node->getArgs()[1]->value);
		$isCallable = $callbackType->isCallable()->yes();

		if (! $isCallable) {
			return [RuleErrorBuilder::message('Callback is not ok')->build()];
		}

		return [RuleErrorBuilder::message('Callback is ok')->build()];
	}
}
