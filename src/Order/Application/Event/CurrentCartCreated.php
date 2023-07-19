<?php

namespace App\Order\Application\Event;

class CurrentCartCreated
{
    public function __construct(
        public string $number,
    ) {
    }
}
