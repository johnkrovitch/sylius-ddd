<?php

namespace App\Channel\Domain\Repository;

use App\Channel\Domain\Model\Channel;

interface ChannelRepositoryInterface
{
    public function get(string $channelCode): Channel;
}
