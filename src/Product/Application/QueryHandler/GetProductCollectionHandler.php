<?php

namespace App\Product\Application\QueryHandler;

use App\Product\Application\Query\GetProductCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetProductCollectionHandler
{
    public function __invoke(GetProductCollection $query): Collection
    {

    }
}
