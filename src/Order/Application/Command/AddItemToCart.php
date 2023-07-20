<?php

namespace App\Order\Application\Command;

use App\Core\Application\Message\Command;

class AddItemToCart implements Command
{
    public function __construct(
        public readonly string $reference,
        public readonly string $productName,
        public readonly int $unitPrice,
        public readonly int $quantity,
    ) {
    }
}
