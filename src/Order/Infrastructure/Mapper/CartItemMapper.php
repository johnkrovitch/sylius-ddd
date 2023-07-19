<?php

namespace App\Order\Infrastructure\Mapper;

use App\Order\Domain\Model\CartItem;
use Sylius\Component\Core\Model\OrderInterface as SyliusOrderInterface;
use Sylius\Component\Core\Model\OrderItem;
use Sylius\Component\Core\Model\OrderItemInterface as SyliusOrderItemInterface;
use Sylius\Component\Core\Model\ProductVariantInterface;
use Sylius\Component\Core\Repository\ProductVariantRepositoryInterface as SyliusProductVariantRepositoryInterface;

class CartItemMapper implements CartItemMapperInterface
{
    public function __construct(
        private SyliusProductVariantRepositoryInterface $productVariantRepository,
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
            ->filter(fn (SyliusOrderItemInterface $syliusOrderItem) => $syliusOrderItem->getVariant()->getCode() === $item->reference())
            ->first()
        ;

        if ($syliusOrderItem === false) {
            $syliusOrderItem = new OrderItem();
        }
        $productVariant = $this->productVariantRepository->findOneBy(['code' => $item->reference()]);
        assert($productVariant instanceof ProductVariantInterface);

        $syliusOrderItem->setOrder($syliusOrder);
        $syliusOrderItem->setProductName($item->productName());
        $syliusOrderItem->setVariant($productVariant);
        $syliusOrderItem->setUnitPrice($item->unitPrice());

        return $syliusOrderItem;
    }
}
