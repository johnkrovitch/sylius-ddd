<?php

namespace App\Product\Infrastructure\Mapper;

use App\Core\Domain\Model\Image;
use App\Product\Domain\Model\Product;
use Sylius\Component\Core\Model\ChannelPricingInterface;
use Sylius\Component\Core\Model\ImageInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\ProductVariantInterface;

class ProductMapper implements ProductMapperInterface
{

    public function map(ProductInterface $product): Product
    {
        /** @var ProductVariantInterface $variant */
        $variant = $product->getVariants()->first();
        /** @var ChannelPricingInterface $channelPricing */
        $channelPricing = $variant->getChannelPricings()->first();
        /** @var ImageInterface $image */
        $image = $product->getImages()->first();

        return new Product(
            code: $product->getCode(),
            name: $product->getName(),
            slug: $product->getSlug(),
            price: $channelPricing->getPrice(),
            image: new Image($image->getPath(), $image->getType()),
        );
    }
}
