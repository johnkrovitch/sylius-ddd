<?php

namespace App\Channel\Infrastructure\Persistence\Repository;

use App\Channel\Domain\Model\Channel;
use App\Channel\Domain\Repository\ChannelRepositoryInterface;
use App\Channel\Infrastructure\Mapper\ChannelMapperInterface;
use Sylius\Component\Channel\Repository\ChannelRepositoryInterface as SyliusChannelRepositoryInterface;

class ChannelRepository implements ChannelRepositoryInterface
{
    public function __construct(
        private SyliusChannelRepositoryInterface $channelRepository,
        private ChannelMapperInterface $channelMapper,
    )
    {
    }

    public function get(string $channelCode): Channel
    {
        $syliusChannel = $this->channelRepository->findOneByCode($channelCode);

        if ($syliusChannel === null) {
            throw new \Exception();
        }

        return $this->channelMapper->toDomain($syliusChannel);
    }
}
