<?php

namespace App\Core\Application\Bus;

use App\Core\Application\Message\Query;

interface QueryBusInterface
{
    public function dispatch(Query $query): mixed;
}
