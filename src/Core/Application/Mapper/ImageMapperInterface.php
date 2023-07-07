<?php

namespace App\Core\Application\Mapper;

use App\Core\Application\View\ImageView;
use App\Core\Domain\Model\Image;

interface ImageMapperInterface
{
    public function map(Image $image): ImageView;
}
