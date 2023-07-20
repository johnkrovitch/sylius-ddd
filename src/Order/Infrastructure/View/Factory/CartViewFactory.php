<?php

namespace App\Order\Infrastructure\View\Factory;

use App\Order\Application\View\CartView;
use App\Order\Application\View\Factory\CartItemViewFactoryInterface;
use App\Order\Application\View\Factory\CartViewFactoryInterface;
use App\Order\Domain\Model\Cart;
use App\Order\Domain\Model\CartItem;

class CartViewFactory implements CartViewFactoryInterface
{
    public function __construct(
        private CartItemViewFactoryInterface $cartItemViewFactory,
    )
    {
    }

    public function create(Cart $cart): CartView
    {
        return new CartView(
            $cart->number(),
            $cart->items()->map(fn(CartItem $item) => $this->cartItemViewFactory->create($item)),
            $cart->itemsTotal(),
            $cart->taxTotal(),
            $cart->total(),
        );
    }
}
