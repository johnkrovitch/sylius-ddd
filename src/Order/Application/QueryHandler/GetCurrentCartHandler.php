<?php

namespace App\Order\Application\QueryHandler;

use App\Order\Application\Query\GetCurrentCart;
use App\Order\Domain\Model\Cart;
use App\Order\Domain\Repository\CartRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetCurrentCartHandler
{
    public function __construct(
        private CartRepositoryInterface $repository,
    ) {
    }

    public function __invoke(GetCurrentCart $query): Cart
    {
        $cart = $this->repository->current();

        if ($cart === null) {
            throw new \Exception();
        }

        return $cart;
    }
}
