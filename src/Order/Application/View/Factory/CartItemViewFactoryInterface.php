<?php

namespace App\Order\Application\View\Factory;

use App\Order\Application\View\CartItemView;
use App\Order\Domain\Model\CartItem;

interface CartItemViewFactoryInterface
{
    public function create(CartItem $item): CartItemView;
}
