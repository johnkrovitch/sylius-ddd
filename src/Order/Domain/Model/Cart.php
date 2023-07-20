<?php

namespace App\Order\Domain\Model;

use App\Channel\Domain\Model\Channel;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Cart
{
    /** @var Collection<int, CartItem> */
    private Collection $items;

    public function __construct(
        private string $number,
        private Channel $channel,
        iterable $items = []
    )
    {
        $this->items = new ArrayCollection();

        foreach ($items as $item) {
            if (!$item instanceof CartItem) {
                throw new \Exception();
            }
            $this->items->add($item);
        }
    }

    public function number(): string
    {
        return $this->number;
    }

    /** @return Collection<int, CartItem> */
    public function items(): Collection
    {
        return $this->items;
    }

    public function addToCart(
        string $reference,
        string $productName,
        int $unitPrice,
        int $quantity = 1,
    ): void {
        $this->items->add(new CartItem(
            $reference,
            $productName,
            $unitPrice,
            $quantity
        ));
    }

    public function itemsTotal(): int
    {
        return array_sum($this->items->map(fn(CartItem $item) => $item->total())->toArray());
    }

    public function taxTotal(): int
    {
        return 0;
    }

    public function total(): int
    {
        return $this->itemsTotal() + $this->taxTotal();
    }

    public function channel(): Channel
    {
        return $this->channel;
    }
}
