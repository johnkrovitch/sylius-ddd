<?php

namespace App\Order\Application\Controller;

use App\Core\Application\Bus\QueryBusInterface;
use App\Order\Application\Form\Type\CartType;
use App\Order\Application\Query\GetCurrentCart;
use App\Order\Application\View\Factory\CartViewFactoryInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ShowCart
{
    public function __construct(
        private QueryBusInterface $queryBus,
        private FormFactoryInterface $formFactory,
        private CartViewFactoryInterface $cartViewFactory,
        private Environment $environment,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $cart = $this->queryBus->dispatch(new GetCurrentCart());
        $cartView = $this->cartViewFactory->create($cart);
        $cartForm = $this->formFactory->create(CartType::class, $cartView);

        return new Response($this->environment->render('cart/show.html.twig', [
            'cart' => $cartView,
            'cartForm' => $cartForm->createView(),
        ]));
    }
}
