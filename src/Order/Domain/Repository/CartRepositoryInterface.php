<?php

namespace App\Order\Domain\Repository;

use App\Order\Domain\Model\Cart;

interface CartRepositoryInterface
{
    public function current(): ?Cart;

    public function get(string $identifier): Cart;

    public function add(Cart $cart): void;

    public function create(): Cart;
}
