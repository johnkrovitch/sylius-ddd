<?php

namespace App\Core\Infrastructure\Bus;

use App\Core\Application\Bus\CommandBusInterface;
use App\Core\Application\Message\Command;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class CommandBus implements CommandBusInterface
{
    public function __construct(
        private MessageBusInterface $commandBus,
    ) {
    }

    public function dispatch(Command $command): mixed
    {
        $envelope = $this->commandBus->dispatch($command);
        /** @var HandledStamp|null $handledStamp */
        $handledStamp = $envelope->last(HandledStamp::class);

        if ($handledStamp === null) {
            throw new \Exception('Oups !');
        }

        return $handledStamp->getResult();
    }
}
