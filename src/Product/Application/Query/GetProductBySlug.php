<?php

namespace App\Product\Application\Query;

use App\Core\Application\Message\Query;

class GetProductBySlug implements Query
{
    public function __construct(
        public readonly string $slug
    ) {
    }
}
