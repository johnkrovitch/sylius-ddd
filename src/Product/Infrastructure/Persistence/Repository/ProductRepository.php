<?php

namespace App\Product\Infrastructure\Persistence\Repository;

use App\Product\Domain\Model\Product;
use App\Product\Domain\Repository\ProductRepositoryInterface;
use App\Product\Infrastructure\Mapper\ProductMapperInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Channel\Repository\ChannelRepositoryInterface as SyliusChannelRepository;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Repository\ProductRepositoryInterface as SyliusProductRepository;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        private SyliusProductRepository $productRepository,
        private SyliusChannelRepository $channelRepository,
        private ProductMapperInterface $mapper,
    ) {
    }

    public function getProducts(): Collection
    {
        $data = $this->productRepository->findAll();

        return (new ArrayCollection($data))->map(fn (ProductInterface $product) => $this->mapper->map($product));
    }

    public function getProductBySlug(string $slug): Product
    {
        $channels = $this->channelRepository->findAll();
        $data = $this->productRepository->findOneByChannelAndSlug($channels[0],  'en', $slug);

        return $this->mapper->map($data);
    }
}
