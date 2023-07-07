<?php

namespace App\Product\Infrastructure\View\Factory;

use App\Core\Application\Mapper\ImageMapperInterface;
use App\Product\Application\View\Factory\ProductViewFactoryInterface;
use App\Product\Application\View\ProductView;
use App\Product\Domain\Model\Product;

class ProductViewFactory implements ProductViewFactoryInterface
{
    public function __construct(
        private ImageMapperInterface $imageMapper,
    )
    {
    }

    public function map(Product $product): ProductView
    {
        return new ProductView(
            code: $product->code(),
            name: $product->name(),
            slug: $product->slug(),
            price: $product->price(),
            image: $this->imageMapper->map($product->image()),
        );
    }
}
