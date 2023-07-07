<?php

namespace App\Product\Domain\Repository;

use App\Product\Domain\Model\Product;
use Doctrine\Common\Collections\Collection;

interface ProductRepositoryInterface
{
    /** @return Collection<int, Product> */
    public function getProducts(): Collection;

    public function getProductBySlug(string $slug): Product;
}
