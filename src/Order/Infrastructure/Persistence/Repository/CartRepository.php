<?php

namespace App\Order\Infrastructure\Persistence\Repository;

use App\Order\Domain\Model\Cart;
use App\Order\Domain\Repository\CartRepositoryInterface;
use App\Order\Infrastructure\Mapper\CartMapperInterface;
use Sylius\Component\Core\Model\Order;
use Sylius\Component\Core\Repository\OrderRepositoryInterface as SyliusOrderRepositoryInterface;
use Sylius\Component\Order\Context\CartContextInterface;

class CartRepository implements CartRepositoryInterface
{
    public function __construct(
        private SyliusOrderRepositoryInterface $orderRepository,
        private CartContextInterface $cartContext,
        private CartMapperInterface $mapper,
    )
    {
    }

    public function current(): ?Cart
    {
        /** @var Order $data */
        $data = $this->cartContext->getCart();

        if ($data->getId() === null) {
            return null;
        }

        return $this->mapper->toDomain($data);
    }

    public function get(string $cartNumber): Cart
    {
        $cart = $this->find($cartNumber);

        if ($cart === null) {
            throw new \Exception();
        }

        return $cart;
    }

    public function find(string $cartNumber): ?Cart
    {
        $syliusCart = $this->orderRepository->findOneBy(['number' => $cartNumber]);

        if ($syliusCart === null) {
            return null;
        }

        return $this->mapper->toDomain($syliusCart);
    }

    public function add(Cart $cart): void
    {
        $syliusOrder = $this->mapper->toResource($cart);
        $this->orderRepository->add($syliusOrder);
    }

    public function create(): Cart
    {
        // TODO: Implement create() method.
    }
}
