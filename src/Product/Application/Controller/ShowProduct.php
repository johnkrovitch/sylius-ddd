<?php

namespace App\Product\Application\Controller;

use App\Core\Application\Bus\CommandBusInterface;
use App\Core\Application\Bus\QueryBusInterface;
use App\Order\Application\Command\AddItemToCart;
use App\Order\Application\Form\Type\AddCartItemType;
use App\Order\Application\View\CartItemView;
use App\Order\Application\View\Factory\CartItemViewFactoryInterface;
use App\Product\Application\Query\GetProductBySlug;
use App\Product\Application\View\Factory\ProductViewFactoryInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

class ShowProduct
{
    public function __construct(
        private QueryBusInterface $queryBus,
        private CommandBusInterface $commandBus,
        private ProductViewFactoryInterface $mapper,
        private FormFactoryInterface $formFactory,
        private Environment $environment,
        private RouterInterface $router,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $model = $this->queryBus->dispatch(new GetProductBySlug($request->attributes->getString('slug')));
        $product = $this->mapper->map($model);
        $form = $this->formFactory->create(AddCartItemType::class, new CartItemView(
            $product->code,
            $product->name,
            $product->price,
            $product->price,
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            assert($data instanceof CartItemView);
            $this->commandBus->dispatch(new AddItemToCart(
                $data->reference,
                $data->productName,
                $data->unitPrice,
                $data->quantity,
            ));

            return new RedirectResponse($this->router->generate('cart_show'));
        }

        return new Response($this->environment->render('products/show.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]));
    }
}
