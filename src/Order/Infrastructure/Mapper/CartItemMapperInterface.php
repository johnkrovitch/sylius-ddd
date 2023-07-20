<?php

namespace App\Order\Infrastructure\Mapper;

use App\Order\Domain\Model\CartItem;
use Sylius\Component\Core\Model\OrderInterface as SyliusOrderInterface;
use Sylius\Component\Core\Model\OrderItemInterface as SyliusOrderItemInterface;

interface CartItemMapperInterface
{
    public function toDomain(SyliusOrderItemInterface $syliusOrderItem): CartItem;

    public function toResource(CartItem $item, SyliusOrderInterface $syliusOrder): SyliusOrderItemInterface;
}
