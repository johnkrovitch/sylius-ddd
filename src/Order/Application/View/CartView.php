<?php

namespace App\Order\Application\View;

use Doctrine\Common\Collections\Collection;

class CartView
{
    public function __construct(
        public readonly string $number,
        public readonly Collection $items,
        public readonly int $itemsTotal = 0,
        public readonly int $taxTotal = 0,
        public readonly int $total = 0,
    ) {
    }
}
