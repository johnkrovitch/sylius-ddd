<?php

namespace App\Product\Domain\Model;

use App\Core\Domain\Model\Image;

class Product
{
    public function __construct(
        private string $code,
        private string $name,
        private string $slug,
        private int $price,
        private Image $image,
    ) {
    }

    public function code(): string
    {
        return $this->code;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function slug(): string
    {
        return $this->slug;
    }

    public function price(): int
    {
        return $this->price;
    }

    public function image(): Image
    {
        return $this->image;
    }
}
