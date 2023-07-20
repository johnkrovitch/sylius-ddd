<?php

namespace App\Order\Infrastructure\Order\Number;

use App\Order\Domain\Order\Number\OrderNumberGeneratorInterface;
use Sylius\Bundle\OrderBundle\NumberGenerator\OrderNumberGeneratorInterface as SyliusOrderNumberGeneratorInterface;
use Sylius\Component\Core\Model\Order;

class OrderNumberGenerator implements OrderNumberGeneratorInterface
{
    public function __construct(
        private SyliusOrderNumberGeneratorInterface $numberGenerator,
    )
    {
    }

    public function generate(): string
    {
        return $this->numberGenerator->generate(new Order());
    }
}
