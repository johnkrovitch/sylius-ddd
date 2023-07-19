<?php

namespace App\Order\Domain\Repository;

use App\Order\Domain\Model\Cart;

interface CartRepositoryInterface
{
    public function current(): ?Cart;

    public function get(string $cartNumber): Cart;

    public function find(string $cartNumber): ?Cart;

    public function add(Cart $cart): void;

    public function create(): Cart;
}
