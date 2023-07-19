<?php

namespace App\Channel\Application\Query;

use App\Core\Application\Message\Query;

class GetChannel implements Query
{
    public function __construct(
        public readonly string $channelCode,
    )
    {
    }
}
