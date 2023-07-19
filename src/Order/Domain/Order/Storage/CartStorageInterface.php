<?php

namespace App\Order\Domain\Order\Storage;

use App\Channel\Domain\Model\Channel;
use App\Order\Domain\Model\Cart;

interface CartStorageInterface
{
    public function add(Cart $cart): void;

    public function get(Channel $channel): Cart;

    public function has(Channel $channel): bool;
}
