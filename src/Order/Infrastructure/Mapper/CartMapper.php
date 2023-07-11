<?php

namespace App\Order\Infrastructure\Mapper;

use App\Order\Domain\Model\Cart;
use App\Order\Domain\Model\CartItem;
use Doctrine\Common\Collections\ArrayCollection;
use Sylius\Component\Core\Model\OrderInterface as SyliusOrderInterface;

class CartMapper implements CartMapperInterface
{
    public function map(SyliusOrderInterface $order): Cart
    {
        $items = new ArrayCollection();

        foreach ($order->getItems() as $item) {
            $items->add(new CartItem(
                $item->getVariant()->getCode(),
                $item->getProductName(),
                $item->getQuantity(),
                $item->getUnitPrice(),
            ));
        }

        return new Cart(
            $order->getId(),
        );
    }
}
