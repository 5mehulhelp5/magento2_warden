<?php

namespace RajNishad\Assignment1\Logger;

class Logger extends \Monolog\Logger
{
    public function __construct(array $handlers = [], array $processors = [])
    {
        parent::__construct('custom', $handlers, $processors);
    }
}
