<?php

namespace App\Product\Infrastructure\Sylius\Mapper;

use App\Product\Domain\Model\Product;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\ProductVariant;

class ProductMapper implements ProductMapperInterface
{

    public function map(ProductInterface $product): Product
    {
        /** @var ProductVariant $variant */
        $variant = $product->getVariants()->first();

        return new Product(
            code: $product->getCode(),
            name: $product->getName(),
            $variant->getChannelPricings()->first(),
        );
    }
}
