<?php

namespace RajNishad\Assignment1\Logger;

use Magento\Framework\Logger\Handler\Base;

use Monolog\Logger;

class Handler extends Base
{
    protected $fileName = '/var/log/custom.log';
    protected $loggerType = Logger::DEBUG;
}
