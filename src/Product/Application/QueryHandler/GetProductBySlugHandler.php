<?php

namespace App\Product\Application\QueryHandler;

use App\Product\Application\Query\GetProductBySlug;
use App\Product\Domain\Model\Product;
use App\Product\Domain\Repository\ProductRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetProductBySlugHandler
{
    public function __construct(
        private ProductRepositoryInterface $repository,
    ) {
    }

    public function __invoke(GetProductBySlug $query): Product
    {
        return $this->repository->getProductBySlug($query->slug);
    }
}
