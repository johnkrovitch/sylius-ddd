<?php

namespace App\Order\Domain\Order\Number;

interface OrderNumberGeneratorInterface
{
    public function generate(): string;
}
