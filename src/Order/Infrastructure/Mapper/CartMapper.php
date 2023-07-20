<?php

namespace App\Order\Infrastructure\Mapper;

use App\Channel\Infrastructure\Mapper\ChannelMapperInterface;
use App\Order\Domain\Model\Cart;
use Doctrine\Common\Collections\ArrayCollection;
use Sylius\Component\Core\Model\Order as SyliusOrder;
use Sylius\Component\Core\Model\OrderInterface as SyliusOrderInterface;
use Sylius\Component\Core\Repository\OrderRepositoryInterface as SyliusOrderRepositoryInterface;

class CartMapper implements CartMapperInterface
{
    public function __construct(
        private SyliusOrderRepositoryInterface $orderRepository,
        private CartItemMapperInterface $cartItemMapper,
        private ChannelMapperInterface $channelMapper,
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
            $syliusCart->getNumber(),
            $this->channelMapper->toDomain($syliusCart->getChannel()),
            $items,
        );
    }

    public function toResource(Cart $cart): SyliusOrderInterface
    {
        $syliusOrder = $this->orderRepository->findOneBy(['number' => $cart->number()]);
        $syliusChannel = $this->channelMapper->toResource($cart->channel());

        if ($syliusOrder === null) {
            $syliusOrder = new SyliusOrder();
            $syliusOrder->setNumber($cart->number());
        }
        $syliusOrder->setCurrencyCode('EUR');
        $syliusOrder->setLocaleCode('en');
        $syliusOrder->setChannel($syliusChannel);

        foreach ($cart->items() as $item) {
            $syliusOrderItem = $this->cartItemMapper->toResource($item, $syliusOrder);

            if (!$syliusOrder->getItems()->contains($syliusOrderItem)) {
                $syliusOrder->addItem($syliusOrderItem);
            }
        }

        return $syliusOrder;
    }
}
