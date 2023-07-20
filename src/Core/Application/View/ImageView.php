<?php

namespace App\Core\Application\View;

class ImageView
{
    public function __construct(
        public readonly string $url,
        public readonly string $type,
    )
    {
    }
}
