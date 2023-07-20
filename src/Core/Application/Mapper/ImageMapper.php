<?php

namespace App\Core\Application\Mapper;

use App\Core\Application\View\ImageView;
use App\Core\Domain\Model\Image;

class ImageMapper implements ImageMapperInterface
{

    public function map(Image $image): ImageView
    {
        return new ImageView(
            url: $image->url(),
            type: $image->type(),
        );
    }
}
