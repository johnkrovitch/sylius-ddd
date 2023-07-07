<?php

namespace App\Order\Application\View;

class CartItemView
{
    public function __construct(
        public string $reference,
        public string $productName,
        public int $unitPrice,
        public int $quantity = 1,
    ) {
    }
}
