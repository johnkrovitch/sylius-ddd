<?php

namespace App\Product\Domain\Model;

class Product
{
    public function __construct(
        private string $code,
        private string $name,
        private int $price,
    ) {
    }
}
