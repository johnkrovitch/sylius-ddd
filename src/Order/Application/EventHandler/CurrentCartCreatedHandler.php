<?php

namespace App\Order\Application\EventHandler;

use App\Core\Application\Bus\QueryBusInterface;
use App\Order\Application\Event\CurrentCartCreated;
use App\Order\Application\Query\GetCart;
use App\Order\Domain\Order\Storage\CartStorageInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: CurrentCartCreated::class)]
class CurrentCartCreatedHandler
{
    public function __construct(
        private CartStorageInterface $cartStorage,
        private QueryBusInterface $queryBus,
    )
    {
    }

    public function __invoke(CurrentCartCreated $event): void
    {
        $cart = $this->queryBus->dispatch(new GetCart($event->number));
        $this->cartStorage->add($cart);
    }
}
