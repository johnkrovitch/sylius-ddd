<?php

namespace App\Product\Infrastructure\Mapper;

use App\Product\Domain\Model\Product;
use Sylius\Component\Core\Model\ProductInterface;

interface ProductMapperInterface
{
    public function map(ProductInterface $product): Product;
}
