<?php

namespace App\Order\Domain\Model;

class CartItem
{
    public function __construct(
        private string $reference,
        private string $productName,
        private int $quantity,
        private int $unitPrice,
    ) {
    }

    public function reference(): string
    {
        return $this->reference;
    }

    public function productName(): string
    {
        return $this->productName;
    }

    public function quantity(): int
    {
        return $this->quantity;
    }

    public function unitPrice(): int
    {
        return $this->unitPrice;
    }

    public function total(): int
    {
        return $this->unitPrice * $this->quantity;
    }
}
