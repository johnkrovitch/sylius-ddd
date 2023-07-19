<?php

namespace App\Channel\Application\QueryHandler;

use App\Channel\Application\Query\GetChannel;
use App\Channel\Domain\Model\Channel;
use App\Channel\Domain\Repository\ChannelRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetChannelHandler
{
    public function __construct(
        private ChannelRepositoryInterface $repository,
    )
    {
    }

    public function __invoke(GetChannel $query): Channel
    {
        return $this->repository->get($query->channelCode);
    }
}
