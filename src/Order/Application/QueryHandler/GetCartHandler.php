<?php

namespace App\Order\Application\QueryHandler;

use App\Order\Application\Query\GetCart;
use App\Order\Domain\Model\Cart;
use App\Order\Domain\Repository\CartRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetCartHandler
{
    public function __construct(
        private CartRepositoryInterface $repository,
    )
    {
    }

    public function __invoke(GetCart $query): Cart
    {
        return $this->repository->get($query->cartNumber);
    }
}
