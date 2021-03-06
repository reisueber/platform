<?php declare(strict_types=1);

namespace Shopware\Core\Checkout\Cart\Event;

use Shopware\Core\Checkout\Cart\Cart;
use Shopware\Core\Checkout\Cart\LineItem\LineItem;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * @deprecated tag:v6.4.0 - Will implement Shopware\Core\Framework\Event\ShopwareSalesChannelEvent
 */
class LineItemAddedEvent extends Event /*implements ShopwareSalesChannelEvent*/
{
    /**
     * @var LineItem
     */
    protected $lineItem;

    /**
     * @var Cart
     */
    protected $cart;

    /**
     * @var SalesChannelContext
     */
    protected $context;

    /**
     * @var bool
     */
    protected $merged;

    public function __construct(LineItem $lineItem, Cart $cart, SalesChannelContext $context, bool $merged = false)
    {
        $this->lineItem = $lineItem;
        $this->cart = $cart;
        $this->context = $context;
        $this->merged = $merged;
    }

    public function getLineItem(): LineItem
    {
        return $this->lineItem;
    }

    public function getCart(): Cart
    {
        return $this->cart;
    }

    /**
     * @deprecated tag:v6.4.0 - Will return Shopware\Core\Framework\Context instead
     */
    public function getContext(): SalesChannelContext
    {
        return $this->context;
    }

    public function getSalesChannelContext(): SalesChannelContext
    {
        return $this->context;
    }

    public function isMerged(): bool
    {
        return $this->merged;
    }
}
