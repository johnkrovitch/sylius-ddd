<?php

namespace App\Order\Application\CommandHandler;

use App\Order\Application\Command\CreateCurrentCart;
use App\Order\Domain\Model\Cart;
use App\Order\Domain\Order\Number\OrderNumberGeneratorInterface;
use App\Order\Domain\Repository\CartRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateCurrentCartHandler
{
    public function __construct(
        private OrderNumberGeneratorInterface $numberGenerator,
        private CartRepositoryInterface $repository,
    )
    {
    }

    public function __invoke(CreateCurrentCart $command): string
    {
        $cartNumber = $this->numberGenerator->generate();
        $cart = new Cart($cartNumber);
        $this->repository->add($cart);

        return $cartNumber;
    }
}
