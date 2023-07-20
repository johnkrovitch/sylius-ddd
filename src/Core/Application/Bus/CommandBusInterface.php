<?php

namespace App\Core\Application\Bus;

use App\Core\Application\Message\Command;

interface CommandBusInterface
{
    public function dispatch(Command $command): mixed;
}
