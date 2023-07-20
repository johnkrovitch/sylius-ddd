<?php

namespace App\Order\Application\CommandHandler;

use App\Channel\Domain\Model\Channel;
use App\Order\Application\Command\CreateCurrentCart;
use App\Order\Application\Event\CurrentCartCreated;
use App\Order\Domain\Model\Cart;
use App\Order\Domain\Order\Number\OrderNumberGeneratorInterface;
use App\Order\Domain\Repository\CartRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateCurrentCartHandler
{
    public function __construct(
        private OrderNumberGeneratorInterface $numberGenerator,
        private CartRepositoryInterface $repository,
        private EventDispatcherInterface $eventDispatcher,
    )
    {
    }

    public function __invoke(CreateCurrentCart $command): string
    {
        $cart = new Cart($this->numberGenerator->generate(), new Channel('FASHION_WEB'));
        $this->repository->add($cart);

        $this->eventDispatcher->dispatch(new CurrentCartCreated($cart->number()));

        return $cart->number();
    }
}
