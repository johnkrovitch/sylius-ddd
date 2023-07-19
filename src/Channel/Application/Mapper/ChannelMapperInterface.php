<?php

namespace App\Channel\Application\Mapper;

use App\Channel\Domain\Model\Channel;
use Sylius\Component\Core\Model\ChannelInterface as SyliusChannelInterface;

interface ChannelMapperInterface
{
    public function toDomain(SyliusChannelInterface $channel): Channel;

    public function toResource(Channel $channel): SyliusChannelInterface;
}
