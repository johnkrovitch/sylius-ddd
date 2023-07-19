<?php

namespace App\Order\Infrastructure\Order\Storage;

use App\Channel\Application\Mapper\ChannelMapperInterface;
use App\Channel\Domain\Model\Channel;
use App\Order\Domain\Model\Cart;
use App\Order\Domain\Order\Storage\CartStorageInterface;
use App\Order\Infrastructure\Mapper\CartMapperInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Storage\CartStorageInterface as SyliusCartStorageInterface;

class CartStorage implements CartStorageInterface
{
    public function __construct(
        private SyliusCartStorageInterface $cartStorage,
        private CartMapperInterface $cartMapper,
        private ChannelMapperInterface $channelMapper,
    )
    {
    }

    public function add(Cart $cart): void
    {
        $syliusCart = $this->cartMapper->toResource($cart);
        $this->cartStorage->setForChannel($syliusCart->getChannel(), $syliusCart);
    }

    public function get(Channel $channel): Cart
    {
        $syliusCart = $this->cartStorage->getForChannel($this->channelMapper->toResource($channel));
        assert($syliusCart instanceof OrderInterface);

        return $this->cartMapper->toDomain($syliusCart);
    }

    public function has(Channel $channel): bool
    {
        $syliusChannel = $this->channelMapper->toResource($channel);

        return $this->cartStorage->hasForChannel($syliusChannel);
    }
}
