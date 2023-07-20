<?php

namespace App\Order\Application\Query;

use App\Core\Application\Message\Query;

class GetCart implements Query
{
    public function __construct(
        public readonly string $cartNumber,
    )
    {
    }
}
