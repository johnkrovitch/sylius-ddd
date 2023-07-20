<?php

namespace App\Product\Application\Controller;

use App\Core\Application\Bus\QueryBusInterface;
use App\Product\Application\Query\GetProductCollection;
use App\Product\Application\View\Factory\ProductViewFactoryInterface;
use App\Product\Domain\Model\Product;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ListProductCollection
{
    public function __construct(
        private QueryBusInterface $queryBus,
        private Environment $environment,
        private ProductViewFactoryInterface $mapper,
    )
    {
    }

    public function __invoke(Request $request): Response
    {
        /** @var Collection<int, Product> $products */
        $products = $this->queryBus->dispatch(new GetProductCollection());
        $productViews = $products->map(fn (Product $product) => $this->mapper->map($product));

        return new Response($this->environment->render('products/index.html.twig', [
            'products' => $productViews,
        ]));
    }
}
