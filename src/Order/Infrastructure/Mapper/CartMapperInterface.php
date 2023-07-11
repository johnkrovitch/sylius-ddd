<?php

namespace App\Order\Infrastructure\Mapper;

use App\Order\Domain\Model\Cart;
use Sylius\Component\Core\Model\OrderInterface as SyliusOrderInterface;

interface CartMapperInterface
{
    public function map(SyliusOrderInterface $order): Cart;
}
