<?php

namespace App\Product\Infrastructure\Persistence\Repository;

use App\Product\Domain\Repository\ProductRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Repository\ProductRepositoryInterface as SyliusProductRepository;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        private SyliusProductRepository $productRepository,
    )
    {
    }

    public function getProducts(): Collection
    {
        $data = $this->productRepository->findAll();

        return (new ArrayCollection($data))->map();
    }
}
