<?php

namespace App\Product\Application\View\Factory;

use App\Product\Application\View\ProductView;
use App\Product\Domain\Model\Product;

interface ProductViewFactoryInterface
{
    public function map(Product $product): ProductView;
}
