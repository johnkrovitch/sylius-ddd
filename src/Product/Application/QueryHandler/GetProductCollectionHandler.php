<?php

namespace App\Product\Application\QueryHandler;

use App\Product\Application\Query\GetProductCollection;
use App\Product\Domain\Repository\ProductRepositoryInterface;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetProductCollectionHandler
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
    )
    {
    }

    public function __invoke(GetProductCollection $query): Collection
    {
        $products = $this->productRepository->getProducts();


        return $products;
    }
}
