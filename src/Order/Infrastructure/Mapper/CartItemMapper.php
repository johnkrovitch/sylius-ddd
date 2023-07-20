<?php

namespace App\Order\Infrastructure\Mapper;

use App\Order\Domain\Model\CartItem;
use Sylius\Component\Core\Model\OrderInterface as SyliusOrderInterface;
use Sylius\Component\Core\Model\OrderItem;
use Sylius\Component\Core\Model\OrderItemInterface as SyliusOrderItemInterface;
use Sylius\Component\Core\Model\OrderItemUnit;
use Sylius\Component\Core\Model\ProductVariantInterface;
use Sylius\Component\Core\Repository\ProductRepositoryInterface;
use Sylius\Component\Core\Repository\ProductVariantRepositoryInterface as SyliusProductVariantRepositoryInterface;
use Webmozart\Assert\Assert;

class CartItemMapper implements CartItemMapperInterface
{
    public function __construct(
        private SyliusProductVariantRepositoryInterface $productVariantRepository,
        private ProductRepositoryInterface $productRepository,
    )
    {
    }

    public function toDomain(SyliusOrderItemInterface $syliusOrderItem): CartItem
    {
        return new CartItem(
            $syliusOrderItem->getVariant()->getCode(),
            $syliusOrderItem->getProductName(),
            $syliusOrderItem->getQuantity(),
            $syliusOrderItem->getUnitPrice(),
        );
    }

    public function toResource(CartItem $item, SyliusOrderInterface $syliusOrder): SyliusOrderItemInterface
    {
        $syliusOrderItem = $syliusOrder
            ->getItems()
            ->filter(fn (SyliusOrderItemInterface $syliusOrderItem) => $syliusOrderItem->getVariant()?->getCode() === $item->reference())
            ->first()
        ;

        if ($syliusOrderItem === false) {
            $syliusOrderItem = new OrderItem();
        }
        $product = $this->productRepository->findOneByCode($item->reference());
        $productVariant = $product->getVariants()->first();
        Assert::isInstanceOf($productVariant, ProductVariantInterface::class);

        $syliusOrderItem->setOrder($syliusOrder);
        $syliusOrderItem->setProductName($item->productName());
        $syliusOrderItem->setVariant($productVariant);
        $syliusOrderItem->setVariantName($item->productName());
        $syliusOrderItem->setUnitPrice($item->unitPrice());
        $syliusOrderItem->addUnit(new OrderItemUnit($syliusOrderItem));

        return $syliusOrderItem;
    }
}
