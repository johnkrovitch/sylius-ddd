<?php

namespace App\Core\Infrastructure\Bus;

use App\Core\Application\Bus\QueryBusInterface;
use App\Core\Application\Message\Query;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class QueryBus implements QueryBusInterface
{
    public function __construct(
        private MessageBusInterface $queryBus,
    ) {
    }

    public function dispatch(Query $query): mixed
    {
        $envelope = $this->queryBus->dispatch($query);
        /** @var HandledStamp|null $handledStamp */
        $handledStamp = $envelope->last(HandledStamp::class);

        if ($handledStamp === null) {
            throw new \Exception('Oups !');
        }

        return $handledStamp->getResult();
    }
}
