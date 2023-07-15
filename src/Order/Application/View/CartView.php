<?php

namespace App\Order\Application\View;

use Doctrine\Common\Collections\Collection;

class CartView
{
    public function __construct(
        public string $number,
        public readonly Collection $items,
    ) {
    }
}
