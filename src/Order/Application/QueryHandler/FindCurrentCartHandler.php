<?php

namespace App\Order\Application\QueryHandler;

use App\Order\Application\Query\FindCurrentCart;
use App\Order\Application\Query\GetCurrentCart;
use App\Order\Domain\Model\Cart;
use App\Order\Domain\Repository\CartRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class FindCurrentCartHandler
{
    public function __construct(
        private CartRepositoryInterface $repository,
    ) {
    }

    public function __invoke(FindCurrentCart $query): ?Cart
    {
        return $this->repository->current();
    }
}
