<?php

namespace App\Product\Application\Controller;

use App\Core\Application\Bus\QueryBusInterface;
use App\Order\Application\Form\Type\CartItemType;
use App\Order\Application\View\CartItemView;
use App\Product\Application\Query\GetProductBySlug;
use App\Product\Application\View\Factory\ProductViewFactoryInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ShowProduct
{
    public function __construct(
        private QueryBusInterface $queryBus,
        private ProductViewFactoryInterface $mapper,
        private FormFactoryInterface $formFactory,
        private Environment $environment,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $model = $this->queryBus->dispatch(new GetProductBySlug($request->attributes->getString('slug')));
        $product = $this->mapper->map($model);
        $form = $this->formFactory->create(CartItemType::class, new CartItemView(
            $product->slug,
            $product->name,
            $product->price,
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

        }

        return new Response($this->environment->render('products/show.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]));
    }
}
