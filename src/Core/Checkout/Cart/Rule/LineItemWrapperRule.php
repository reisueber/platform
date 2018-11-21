<?php declare(strict_types=1);

namespace Shopware\Core\Checkout\Cart\Rule;

use Shopware\Core\Checkout\CheckoutRuleScope;
use Shopware\Core\Framework\Rule\Container\Container;
use Shopware\Core\Framework\Rule\Match;
use Shopware\Core\Framework\Rule\Rule;
use Shopware\Core\Framework\Rule\RuleScope;

class LineItemWrapperRule extends Rule
{
    /**
     * @var Container
     */
    protected $container;

    public function match(RuleScope $scope): Match
    {
        if (!$scope instanceof CheckoutRuleScope) {
            return new Match(false, ['No checkout scope']);
        }
        if ($scope instanceof LineItemScope) {
            return $this->container->match($scope);
        }

        if (!$scope instanceof CartRuleScope) {
            return new Match(false, ['Invalid match context. CartRuleScope required.']);
        }

        foreach ($scope->getCart()->getLineItems() as $lineItem) {
            $context = new LineItemScope($lineItem, $scope->getCheckoutContext());
            $match = $this->container->match($context);
            if ($match->matches()) {
                return $match;
            }
        }

        return new Match(false, ['No line item found']);
    }
}
