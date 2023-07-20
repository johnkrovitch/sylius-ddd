<?php

namespace App\Channel\Domain\Model;

class Channel
{
    public function __construct(
        private string $code,
    )
    {
    }

    public function code(): string
    {
        return $this->code;
    }
}
