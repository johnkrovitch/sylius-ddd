<?php

namespace App\Order\Application\View\Factory;

use App\Order\Application\View\CartView;
use App\Order\Domain\Model\Cart;

interface CartViewFactoryInterface
{
    public function create(Cart $cart): CartView;
}
