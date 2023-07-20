<?php

namespace App\Order\Infrastructure\View\Factory;

use App\Order\Application\View\CartItemView;
use App\Order\Application\View\Factory\CartItemViewFactoryInterface;
use App\Order\Domain\Model\CartItem;

class CartItemViewFactory implements CartItemViewFactoryInterface
{
    public function create(CartItem $item): CartItemView
    {
        return new CartItemView(
            $item->reference(),
            $item->productName(),
            $item->unitPrice(),
            $item->quantity(),
        );
    }
}
