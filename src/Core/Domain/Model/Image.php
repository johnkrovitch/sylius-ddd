<?php

namespace App\Core\Domain\Model;

class Image
{
    public function __construct(
        private string $url,
        private string $type,
    ) {
    }

    public function url(): string
    {
        return $this->url;
    }

    public function type(): string
    {
        return $this->type;
    }
}
