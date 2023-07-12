<?php

namespace App\Order\Infrastructure\EventListener;

use App\Core\Application\Bus\CommandBusInterface;
use App\Core\Application\Bus\QueryBusInterface;
use App\Order\Application\Query\FindCurrentCart;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\RequestEvent;

#[AsEventListener(event: RequestEvent::class)]
class CreateCartListener
{
    public function __construct(
        private QueryBusInterface $queryBus,
        private CommandBusInterface $commandBus,
    )
    {
    }

    public function __invoke(RequestEvent $event): void
    {
        $cart = $this->queryBus->dispatch(new FindCurrentCart());

        if ($cart === null) {
            $this->commandBus->dispatch();
        }
        dd($event);
    }
}
