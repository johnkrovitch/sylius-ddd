<?php

namespace App\Order\Infrastructure\Mapper;

use App\Order\Domain\Model\Cart;
use Sylius\Component\Core\Model\OrderInterface as SyliusOrderInterface;

interface CartMapperInterface
{
    public function toDomain(SyliusOrderInterface $syliusCart): Cart;

    public function toResource(Cart $cart): SyliusOrderInterface;
}
