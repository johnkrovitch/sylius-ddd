<?php

namespace App\Order\Infrastructure\Mapper;

use App\Order\Domain\Model\Cart;
use App\Order\Domain\Model\CartItem;
use Doctrine\Common\Collections\ArrayCollection;
use Sylius\Component\Core\Model\Order as SyliusOrder;
use Sylius\Component\Core\Model\OrderInterface as SyliusOrderInterface;
use Sylius\Component\Core\Model\OrderItem;
use Sylius\Component\Core\Model\OrderItemInterface as SyliusOrderItemInterface;
use Sylius\Component\Core\Repository\OrderRepositoryInterface as SyliusOrderRepositoryInterface;

class CartMapper implements CartMapperInterface
{
    public function __construct(
        private SyliusOrderRepositoryInterface $orderRepository,
        private CartItemMapperInterface $cartItemMapper,
    )
    {
    }

    public function toDomain(SyliusOrderInterface $syliusCart): Cart
    {
        $items = new ArrayCollection();

        foreach ($syliusCart->getItems() as $syliusOrderItem) {
            $items->add($this->cartItemMapper->toDomain($syliusOrderItem));
        }

        return new Cart(
            $syliusCart->getId(),
            $items,
        );
    }

    public function toResource(Cart $cart): SyliusOrderInterface
    {
        $syliusOrder = $this->orderRepository->findOneBy(['number' => $cart->number()]);

        if ($syliusOrder === null) {
            $syliusOrder = new SyliusOrder();
            $syliusOrder->setNumber($cart->number());
        }
        $syliusOrder->setCurrencyCode('EUR');
        $syliusOrder->setLocaleCode('en');

        foreach ($cart->items() as $item) {
            $syliusOrderItem = $this->cartItemMapper->toResource($item, $syliusOrder);

            if (!$syliusOrder->getItems()->contains($syliusOrderItem)) {
                $syliusOrder->addItem($syliusOrderItem);
            }
        }

        return $syliusOrder;
    }
}
