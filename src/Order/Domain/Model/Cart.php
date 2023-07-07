<?php

namespace App\Order\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Cart
{
    /** @var Collection<int, CartItem> */
    private Collection $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function orderProduct(
        string $productName,
        int $quantity = 1,
    ) {
        $this->items->add(new CartItem($productName, $quantity));
    }
}
