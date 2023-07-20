<?php

namespace App\Channel\Infrastructure\Mapper;

use App\Channel\Domain\Model\Channel;
use Sylius\Component\Channel\Repository\ChannelRepositoryInterface as SyliusChannelRepositoryInterface;
use Sylius\Component\Core\Model\ChannelInterface as SyliusChannelInterface;

class ChannelMapper implements ChannelMapperInterface
{
    public function __construct(
        private SyliusChannelRepositoryInterface $channelRepository,
    )
    {
    }

    public function toDomain(SyliusChannelInterface $channel): Channel
    {
        return new Channel(
            $channel->getCode(),
        );
    }

    public function toResource(Channel $channel): SyliusChannelInterface
    {
        $syliusChannel = $this->channelRepository->findOneByCode($channel->code());

        if ($syliusChannel === null) {
            throw new \Exception();
        }

        return $syliusChannel;
    }
}
