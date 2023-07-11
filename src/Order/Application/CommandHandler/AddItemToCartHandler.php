<?php

namespace App\Order\Application\CommandHandler;

use App\Core\Application\Bus\QueryBusInterface;
use App\Order\Application\Command\AddItemToCart;
use App\Order\Application\Query\GetCurrentCart;
use App\Order\Domain\Model\Cart;
use App\Order\Domain\Repository\CartRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class AddItemToCartHandler
{
    public function __construct(
        private QueryBusInterface $queryBus,
        private CartRepositoryInterface $repository,
    )
    {
    }

    public function __invoke(AddItemToCart $command): void
    {
        $cart = $this->queryBus->dispatch(new GetCurrentCart());
        assert($cart instanceof Cart);

        $cart->addToCart(
            $command->reference,
            $command->productName,
            $command->unitPrice,
            $command->quantity,
        );

        $this->repository->add($cart);
    }
}
