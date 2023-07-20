<?php

namespace App\Product\Application\View;

use App\Core\Application\View\ImageView;

class ProductView
{
    public function __construct(
        public string $code,
        public string $name,
        public string $slug,
        public int $price,
        public ImageView $image,
    ) {
    }
}
